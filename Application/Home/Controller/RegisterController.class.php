<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 11:27
 */
namespace Home\Controller;
use Think\Controller;

class RegisterController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
    }

    /*录取状态*/
    public function register() {

        $studentId = cookie("studentId");  //得到学生的 ID
        $where['register.status'] = array('neq', 1);
        $where['student.id'] = array('eq', $studentId);
        $where['student.status'] = array('neq', 2);

        $pubOrgan = null;
        $civilOrgan = null;
        $resultOrgan = null;
        $resultOrganPub = null;
        $resultOrganCivil = null;
        $organModel = M("organ");
        $model = M("student");

        $result = $model
            ->field('student.*, register.*, student.status, register.status as register_status, register.id as register_id')
            ->where($where)
            ->join('register on student.id = register.sid')
            ->select();

//        var_dump($result);
//        exit();
        if (count($result) > 0 and $result[0]['status'] == 1) {  // 学生状态等于1，信息已提交

            // 初中ID等于0时，表示没有报考学校；反之，则报考学校
            if ($result[0]['civil_junior'] == 0 and $result[0]['pub_junior'] != 0) {  //没报考民办学校，报考公办学校

                $organWhere['id'] = array('eq', $result[0]['pub_junior']);
                $organWhere['status'] = array('eq', 0);
                $resultOrgan = $organModel->where($organWhere)->select();

                $result[0]['civil_junior'] = '无';
                if (count($resultOrgan) > 0) {

                    // rank=6 时，机构为班级，所以要匹配这个班级属于哪个学校
                    if ($resultOrgan[0]['rank'] == 6) {
                        $pubOrganWhere['id'] = array('eq', $resultOrgan[0]['pid']);
                        $pubOrganName = $organModel->where($pubOrganWhere)->select();
                        $result[0]['pub_junior'] = $pubOrganName[0]['name'];
                    } else {
                        $result[0]['pub_junior'] = $resultOrgan[0]['name'];
                    }

                    if ($result[0]['pub_release'] == 1) {  //判断公办初中是否发布信息
                        $result[0]['civil_status'] = '未报名';
                        switch ($result[0]['pub_status']) {
                            case 0:
                                $result[0]['pub_state'] = "0";  //用于判断是否被拒绝
                                $result[0]['pub_status'] = '等待';
                                break;
                            case 1:
                                $result[0]['pub_state'] = "1";
                                $result[0]['pub_status'] = '录取';
                                break;
                            case 2:  // 被拒绝，需要再分配
                                $result[0]['pub_state'] = "2";

                                $reasonWhere['register_id'] = array('eq', $result[0]['register_id']);
                                $reasonWhere['school_id'] = array('eq', $resultOrgan[0]['id']);
                                // 得到拒绝理由
//                                $reason = M("reject")->where(array("school_id"=>$resultOrgan[0]['id']))->select();
                                $reason = M("reject")->where($reasonWhere)->select();
//                                var_dump($reason);
//                                exit();
                                if (count($reason) > 0) {
                                    $result[0]['pub_status'] = '未录取，理由：'.$reason[0]['reason'];
                                } else {
                                    $result[0]['pub_status'] = '未录取';
                                }
                                // 判断学生是否为统筹生，只有统筹生才会被再分配
                                if ($result[0]['origin'] == 1) {
                                    if ($result[0]['register_status'] == 0) {
                                        $result[0]['state'] = "等待分配";
                                        $result[0]['organ_name'] = "无";
                                    } elseif ($result[0]['register_status'] == 2) {
                                        $result[0]['state'] = "等待分配";
                                        $result[0]['organ_name'] = "无";
                                    } else {
                                        $result[0]['state'] = "已分配";
                                        $stateWhere['id'] = array('eq', $result[0]['assign_junior']);
                                        $stateOrgan = $organModel->field('name')->where($stateWhere)->select();
                                        if (count($stateOrgan) > 0) {
                                            $result[0]['organ_name'] = $stateOrgan[0]['name'];
                                        } else {
                                            $result[0]['organ_name'] = "未指定被分配到的学校，请耐心等待。";
                                        }
                                    }
                                } else {
                                    $result[0]['pub_state'] = "0";
                                }
                                break;
                            default:
                                $result[0]['pub_status'] = '未知，请等待';
                        }
                    } else {
                        $result[0]['civil_status'] = '未报名';
                        $result[0]['pub_status'] = '等待';
                    }
                } else {
                    $resultOrgan[0]['noSchool'] = 0;
                }
            }else {  //报考民办学校，报考公办学校

                $organPubWhere['id'] = array('eq', $result[0]['pub_junior']);
                $organPubWhere['status'] = array('eq', 0);
                $organCivilWhere['id'] = array('eq', $result[0]['civil_junior']);
                $organCivilWhere['status'] = array('eq', 0);

                $resultOrganPub = $organModel->where($organPubWhere)->select();  // 公办机构
                $resultOrganCivil = $organModel->where($organCivilWhere)->select();  // 民办机构

                //判断所属机构是否为班级，如果为班级，则机构名为直接上一级机构
                if ($resultOrganPub[0]['rank'] == 6) {
                    $pubOrganNameWhere['id'] = array('eq', $resultOrganPub[0]['pid']);
                    $pubOrganName = $organModel->where($pubOrganNameWhere)->select();
                    $result[0]['pub_junior'] = $pubOrganName[0]['name'];
                } else {
                    $result[0]['pub_junior'] = $resultOrganPub[0]['name'];
                }

                if ($resultOrganPub[0]['rank'] == 6) {
                    $CivilOrganNameWhere['id'] = array('eq', $resultOrganCivil[0]['pid']);
                    $CivilOrganName = $organModel->where($CivilOrganNameWhere)->select();
                    $result[0]['civil_junior'] = $CivilOrganName[0]['name'];
                } else {
                    $result[0]['civil_junior'] = $resultOrganCivil[0]['name'];
                }

                if (count($resultOrganPub) > 0 and count($resultOrganCivil) > 0) {

                    // $result[0]['lot_release'] == 0，表示民办摇号未发布，此时状态全部为等待
                    if ($result[0]['lot_release'] == 0) {
                        $result[0]['civil_status'] = '等待';
                        $result[0]['pub_status'] = '等待';
                    } else {
                        // $result[0]['civil_release'] == 0，表示民办未发布，此时状态全部为等待
                        if ($result[0]['civil_release'] == 0) {
                            $result[0]['civil_status'] = '等待';
                            $result[0]['pub_status'] = '等待';
                        } else {
                            switch ($result[0]['civil_status']) {
                                case 0:
                                    $result[0]['civil_status'] = '等待';
                                    $result[0]['pub_status'] = '等待';
                                    break;
                                case 1:
                                    $result[0]['civil_status'] = '等待';
                                    $result[0]['pub_status'] = '等待';
                                    break;
                                case 2:
                                    $result[0]['civil_status'] = '录取';
                                    $result[0]['pub_status'] = '未录取';
                                    break;
                                case 3:
                                    $result[0]['civil_status'] = '未录取';
                                    // 得到拒绝理由
                                    $reason = M("reject")->where(array("school_id"=>$resultOrganCivil[0]['id']))->select();
                                    if (count($reason) > 0) {
                                        $result[0]['civil_status'] = '未录取，理由：'.$reason[0]['reason'];
                                    } else {
                                        $result[0]['civil_status'] = '未录取';
                                    }
                                    // 到此，以确定民办未录取，开始判断公办学校情况
                                    if ($result[0]['pub_release'] == 0) {
                                        $result[0]['pub_status'] = '等待';
                                    } else {
                                        switch ($result[0]['pub_status']) {
                                            case 0:
                                                $result[0]['pub_state'] = "0";  //用于判断是否被拒绝
                                                $result[0]['pub_status'] = '等待';
                                                break;
                                            case 1:
                                                $result[0]['pub_state'] = "1";
                                                $result[0]['pub_status'] = '录取';
                                                break;
                                            case 2:
                                                $result[0]['pub_state'] = "2";
                                                $result[0]['pub_status'] = '未录取';
                                                // 得到理由
                                                $reasonWhere['register_id'] = array('eq', $result[0]['register_id']);
                                                $reasonWhere['school_id'] = array('eq', $resultOrganPub[0]['id']);
                                                // 得到拒绝理由
                                                $reason = M("reject")->where($reasonWhere)->select();
                                                if (count($reason) > 0) {
                                                    $result[0]['pub_status'] = '未录取，理由：'.$reason[0]['reason'];
                                                } else {
                                                    $result[0]['pub_status'] = '未录取';
                                                }
                                                // 判断学生是否为统筹生，只有统筹生才会被再分配
                                                if ($result[0]['origin'] == 1) {
                                                    if ($result[0]['register_status'] == 0) {
                                                        $result[0]['state'] = "等待分配";
                                                        $result[0]['organ_name'] = "无";
                                                    } elseif ($result[0]['register_status'] == 2) {
                                                        $result[0]['state'] = "等待分配";
                                                        $result[0]['organ_name'] = "无";
                                                    } else {
                                                        $result[0]['state'] = "已分配";
                                                        $result[0]['organ_name'] = "无";
                                                        $stateWhere['id'] = array('eq', $result[0]['assign_junior']);
                                                        $stateOrgan = $organModel->field('name')->where($stateWhere)->select();
                                                        if (count($stateOrgan) > 0) {
                                                            $result[0]['organ_name'] = $stateOrgan[0]['name'];
                                                        } else {
                                                            $result[0]['organ_name'] = "未指定被分配到的学校，请耐心等待。";
                                                        }
                                                    }
                                                } else {
                                                    $result[0]['pub_state'] = "0";
                                                }
                                                break;
                                            default;
                                        }
                                    }
                                    break;
                                case 4:
                                    $result[0]['civil_status'] = '未派中';
                                    $result[0]['pub_status'] = '等待';
                                    break;
                                default:
                                    $result[0]['pub_status'] = '未知，请等待';
                            }
                        }
                    }

                    /*if ($result[0]['lot_release'] == 0 and $result[0]['civil_release'] == 0 and $result[0]['civil_status'] == 0) {  //民办未摇中，
                        $result[0]['civil_status'] = '未录取';
                        $result[0]['pub_status'] = '等待';
                    } elseif ($result[0]['lot_release'] == 1 and $result[0]['civil_release'] == 0 and $result[0]['civil_status'] == 1) {  //民办摇中，但未发布，状态为面试
                        $result[0]['civil_status'] = '面试';
                        $result[0]['pub_status'] = '等待';
                    } elseif ($result[0]['lot_release'] == 1 and $result[0]['civil_release'] == 1 and $result[0]['civil_status'] == 4) {  //民办未派中
                        $result[0]['civil_status'] = '未派中';
                        $result[0]['pub_status'] = '等待';
                    } elseif ($result[0]['lot_release'] == 1 and $result[0]['civil_release'] == 1 and $result[0]['civil_status'] == 2) {  //民办摇中，且以发布，状态为录取
                        $result[0]['civil_status'] = '录取';
                        $result[0]['pub_status'] = '未录取';
                    } elseif ($result[0]['lot_release'] == 1 and $result[0]['civil_release'] == 1 and $result[0]['civil_status'] == 3) {  //民办摇中，且以发布，状态为退回
                        $reason = M("reject")->where(array("school_id"=>$resultOrganCivil[0]['id']))->select();
                        if (count($reason) > 0) {
                            $result[0]['civil_status'] = '未录取，理由：'.$reason[0]['reason'];
                        } else {
                            $result[0]['civil_status'] = '未录取';
                        }
                        if ($result[0]['pub_release'] == 1) {  //判断公办是否发布
                            switch ($result[0]['pub_status']) {
                                case 0:
                                    $result[0]['pub_state'] = "0";  //用于判断是否被拒绝
                                    $result[0]['pub_status'] = '等待';
                                    break;
                                case 1:
                                    $result[0]['pub_state'] = "1";
                                    $result[0]['pub_status'] = '录取';
                                    break;
                                case 2:
                                    $result[0]['pub_state'] = "2";
                                    $reasonWhere['register_id'] = array('eq', $result[0]['register_id']);
                                    $reasonWhere['school_id'] = array('eq', $resultOrganPub[0]['id']);
                                    // 得到拒绝理由
                                    $reason = M("reject")->where($reasonWhere)->select();
//                                    var_dump($reason);
//                                    exit();
//
//                                    $reason = M("reject")->where(array("school_id"=>$resultOrganPub[0]['id']))->select();
                                    if (count($reason) > 0) {
                                        $result[0]['pub_status'] = '拒绝，理由：'.$reason[0]['reason'];
                                    } else {
                                        $result[0]['pub_status'] = '拒绝';
                                    }
                                    // 判断学生是否为统筹生，只有统筹生才会被再分配
                                    if ($result[0]['origin'] == 1) {
                                        if ($result[0]['register_status'] == 0) {
                                            $result[0]['state'] = "等待分配";
                                            $result[0]['organ_name'] = "无";
                                        } elseif ($result[0]['register_status'] == 2) {
                                            $result[0]['state'] = "等待分配";
                                            $result[0]['organ_name'] = "无";
                                        } else {
                                            $result[0]['state'] = "已分配";
                                            $result[0]['organ_name'] = "无";
                                            $stateWhere['id'] = array('eq', $result[0]['assign_junior']);
                                            $stateOrgan = $organModel->field('name')->where($stateWhere)->select();
                                            if (count($stateOrgan) > 0) {
                                                $result[0]['organ_name'] = $stateOrgan[0]['name'];
                                            } else {
                                                $result[0]['organ_name'] = "未指定被分配到的学校，请耐心等待。";
                                            }
                                        }
                                    } else {
                                        $result[0]['pub_state'] = "0";
                                    }
                                    break;
                                default:
                                    $result[0]['pub_status'] = '未知，请等待';
                            }
                        } else {
                            $result[0]['pub_status'] = '等待';
                        }
                    } else {  //情况未知
                        $resultOrgan = 0;
                    }*/
                } else {
                    $resultOrgan = 0;
                }
            }
        } else {
            //未报名，一会要记得改
            $result = 0;
        }

        $type = "报考学校及录取状态";

        cookie("register_info", json_encode($result));
        cookie("type_info", $type);

        $this->assign("studentInfo", $result);
        $this->assign("organ", $resultOrgan);
        $this->assign("organ", $resultOrganPub);
        $this->assign("organ", $resultOrganCivil);
        $this->assign("type", $type);
        $this->display();
    }

    /*学生信息*/
    public function student_info() {

        $studentId = cookie("studentId");
        $organ_status = ["status"=>"0"];
        $where['student.id'] = array('eq', $studentId);
        $where['student.status'] = array('neq', 2);

        $model = M("student");
        $result = $model
            ->field('organ.name as organName,organ.pid,organ.rank,student.*')
            ->where($where)
            ->where('organ.status='.$organ_status['status'])
            ->join('organ on student.oid = organ.id')
            ->select();

        if ($result[0]['rank'] == 6) {
            $organId['id'] = array('eq', $result[0]['pid']);
            $organResult = M("organ")->where($organId)->select();
            $result[0]['organname'] = $organResult[0]['name'];
        }

        if (count($result) > 0) {
            if ($result[0]['sex'] == '0') {
                $result[0]['sex'] = '男';
            } else {
                $result[0]['sex'] = '女';
            }
            if ($result[0]['origin'] == '0') {
                $result[0]['origin'] = '学区生';
            } else {
                $result[0]['origin'] = '统筹生';
            }
            if ($result[0]['picture'] == null) {
                $result[0]['picture'] = '一个默认的地址';
            }
        } else {
            $result = 0;
        }

        $type = "学生信息 ";
        cookie("exportStudent", json_encode($result));
        cookie("exportStudentTitle", $type);
        $this->assign("student_info", $result);
        $this->assign("type", $type);
        $this->display();
    }

    /*父母信息*/
    public function parent_info() {

        $type = "父母及监护人信息 ";
        $student_id = cookie("studentId");
        $where['student_id'] = $student_id;
        $guardian = M("guardian");
        $info = $guardian->where($where)->select();

        if (count($info) > 0) {
            $count = 0;  //用于累计学生对应的父母信息的个数
        } else {
            $count = 4;
        }
        if (count($info) > 0) {  //表示父亲、母亲、监护人中最少有一个
            foreach ($info as $key => $value) {  //确定查出了几条记录
                $count++;
            }
            switch ($count) {  //判断查出了几条记录
                case 1:
                    switch ($info[0]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[0]['relations'] = '父亲';
                            $info[0]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[0]['relations'] = '母亲';
                            $info[0]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[0]['status'] = 2;  //2：表示监护人
                    }
                    break;
                case 2:
                    switch ($info[0]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[0]['relations'] = '父亲';
                            $info[0]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[0]['relations'] = '母亲';
                            $info[0]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[0]['status'] = 2;  //2：表示监护人
                    }
                    switch ($info[1]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[1]['relations'] = '父亲';
                            $info[1]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[1]['relations'] = '母亲';
                            $info[1]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[1]['status'] = 2;  //2：表示监护人
                    }
                    break;
                case 3:
                    switch ($info[0]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[0]['relations'] = '父亲';
                            $info[0]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[0]['relations'] = '母亲';
                            $info[0]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[0]['status'] = 2;  //2：表示监护人
                    }
                    switch ($info[1]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[1]['relations'] = '父亲';
                            $info[1]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[1]['relations'] = '母亲';
                            $info[1]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[1]['status'] = 2;  //2：表示监护人
                    }
                    switch ($info[2]['relations']) {  //识别是父亲、母亲或监护人
                        case '0':
                            $info[2]['relations'] = '父亲';
                            $info[2]['status'] = 0;  //0：表示父亲
                            break;
                        case '1':
                            $info[2]['relations'] = '母亲';
                            $info[2]['status'] = 1;  //1：表示母亲
                            break;
                        default:
                            $info[2]['status'] = 2;  //2：表示监护人
                    }
                    break;
                default:
                    $info = 0;  //表示没有信息
            }
        } else {
            $info = 0;  //表示没有信息
        }

        cookie("count", $count);
        cookie("parent_info", json_encode($info));
        cookie("pdf_name_parent", $type);
        $this->assign("info", $info);
        $this->assign("count", $count);
        $this->assign("type", $type);
        $this->display();
    }

    //导出报考学校录取状态
    public function get_export_data_register() {
        $registerInfo = json_decode(cookie("register_info"));
        $registerTitle = cookie("type_info");
        $newRegisterInfo = null;

        if ($registerInfo == 0) {
            $newRegisterInfo = null;
        } else {
            foreach ($registerInfo as $k => $v) {
                $newRegisterInfo[0][0] = '公办学校';
                $newRegisterInfo[0][1] = '报考学校：'.$registerInfo[0]->pub_junior;
                $newRegisterInfo[0][2] = '录取状态：'.$registerInfo[0]->pub_status;
                $newRegisterInfo[0][3] = null;
                $newRegisterInfo[0][4] = '民办学校：';
                $newRegisterInfo[0][5] = '报考学校：'.$registerInfo[0]->civil_junior;
                $newRegisterInfo[0][6] = '录取状态：'.$registerInfo[0]->civil_status;
                $newRegisterInfo[0][7] = null;
                $newRegisterInfo[0][8] = '分配情况：';
                $newRegisterInfo[0][9] = '分配状态：'.$registerInfo[0]->state;
                $newRegisterInfo[0][10] = '被分配到学校：'.$registerInfo[0]->organ_name;
            }
        }
        $this->export_pdf($newRegisterInfo, $registerTitle);
    }

    //导出学生信息
    public function get_export_data_student() {
        $exportStudent = json_decode(cookie("exportStudent"));
        $exportStudentTitle = cookie("exportStudentTitle");
        $newExportStudent = null;
        $studentPicture = null;
        $picturePath = '/Uploads/';
        if ($exportStudent == 0) {
            $newExportStudent = null;
        } else {
            foreach ($exportStudent as $k => $v) {
                $newExportStudent[$k][0] = '姓名：'.'                                 '.$exportStudent[$k]->name;
                $newExportStudent[$k][1] = '性别：'.'                                 '.$exportStudent[$k]->sex;
                $newExportStudent[$k][2] = '出生日期：'.'                          '.$exportStudent[$k]->birthday;
                $newExportStudent[$k][3] = '原就读学校：'.'                      '.$exportStudent[$k]->organname;
                $newExportStudent[$k][4] = '身份证号：'.'                          '.$exportStudent[$k]->id_num;
                $newExportStudent[$k][5] = '学籍号：'.'                              '.$exportStudent[$k]->sid_num;
                $newExportStudent[$k][6] = '民族：'.'                                  '.$exportStudent[$k]->nation;
                $newExportStudent[$k][7] = '户口所在地：'.'                      '.$exportStudent[$k]->account;
                $newExportStudent[$k][8] = '家庭住址：'.'                          '.$exportStudent[$k]->address;
                $newExportStudent[$k][9] = '电话：'.'                                  '.$exportStudent[$k]->phone;
                $newExportStudent[$k][10] = '邮箱：'.'                                  '.$exportStudent[$k]->email;
                $newExportStudent[$k][11] = '生源类型：'.'                          '.$exportStudent[$k]->origin;
                $newExportStudent[$k][12] = '房产证编号：'.'                       '.$exportStudent[$k]->house;
                $newExportStudent[$k][13] = '房产地址：'.'                           '.$exportStudent[$k]->house_address;
                $newExportStudent[$k][14] = '房产所有人及共有人：'.'        '.$exportStudent[$k]->house_owners;
                $newExportStudent[$k][15] = '户主与孩子的关系：'.'            '.$exportStudent[$k]->house_relations;
            }
            $studentPicture = __ROOT__.$picturePath.$exportStudent[0]->picture;

        }
        $this->export_pdf($newExportStudent, $exportStudentTitle, $studentPicture);
    }

    //导出父母及监护人的信息
    public function get_export_data_parent() {

        $parentInfo = json_decode(cookie("parent_info"));
        $count = (int)cookie("count");
        $exportDate = null;
        $exportName = null;
        if ($parentInfo == 0) {
            $exportDate = null;
        } else {
            if ($count == 1) {
                switch ($parentInfo[0]->status) {
                    case 0:  //父亲信息
                        $exportName = "父亲信息";
                        $exportDate[0][0] = '父亲姓名：'.$parentInfo[0]->name;
                        $exportDate[0][1] = '身份证号：'.$parentInfo[0]->id_num;
                        $exportDate[0][2] = '工作单位：'.$parentInfo[0]->workunit;
                        $exportDate[0][3] = '职业：'.$parentInfo[0]->occupation;
                        $exportDate[0][4] = '手机号码：'.$parentInfo[0]->phone;
                        break;
                    case 1:  //母亲信息
                        $exportName = "母亲信息";
                        $exportDate[0][0] = '母亲姓名：'.$parentInfo[0]->name;
                        $exportDate[0][1] = '身份证号：'.$parentInfo[0]->id_num;
                        $exportDate[0][2] = '工作单位：'.$parentInfo[0]->workunit;
                        $exportDate[0][3] = '职业：'.$parentInfo[0]->occupation;
                        $exportDate[0][4] = '手机号码：'.$parentInfo[0]->phone;
                        break;
                    case 2:  //监护人信息
                        $exportName = "监护人信息";
                        $exportDate[0][0] = '监护人姓名：'.$parentInfo[0]->name;
                        $exportDate[0][1] = '身份证号：'.$parentInfo[0]->id_num;
                        $exportDate[0][2] = '工作单位：'.$parentInfo[0]->workunit;
                        $exportDate[0][3] = '职业：'.$parentInfo[0]->occupation;
                        $exportDate[0][4] = '手机号码：'.$parentInfo[0]->phone;
                        $exportDate[0][5] = '与学生关系：'.$parentInfo[0]->relations;
                        break;
                    default:
                        $exportDate = null;
                }
            } elseif ($count == 2) {
                $exportName = "监护人及父母信息";
                foreach ($parentInfo as $k => $v) {
                    if ($parentInfo[$k]->status == 0) {
                        $exportDate[$k][0] = '父亲姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                    } elseif ($parentInfo[$k]->status == 1) {
                        $exportDate[$k][0] = '母亲姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                    } elseif ($parentInfo[$k]->status == 2) {
                        $exportDate[$k][0] = '监护人姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                        $exportDate[$k][5] = '与学生关系：'.$parentInfo[$k]->relations;
                    } else {
                        $exportDate = null;
                    }
                }
            } elseif ($count == 3) {
                $exportName = "监护人及父母信息";
                foreach ($parentInfo as $k => $v) {
                    if ($parentInfo[$k]->status == 0) {
                        $exportDate[$k][0] = '父亲姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                    } elseif ($parentInfo[$k]->status == 1) {
                        $exportDate[$k][0] = '母亲姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                    } elseif ($parentInfo[$k]->status == 2) {
                        $exportDate[$k][0] = '监护人姓名：'.$parentInfo[$k]->name;
                        $exportDate[$k][1] = '身份证号：'.$parentInfo[$k]->id_num;
                        $exportDate[$k][2] = '工作单位：'.$parentInfo[$k]->workunit;
                        $exportDate[$k][3] = '职业：'.$parentInfo[$k]->occupation;
                        $exportDate[$k][4] = '手机号码：'.$parentInfo[$k]->phone;
                        $exportDate[$k][5] = '与学生关系：'.$parentInfo[$k]->relations;
                    } else {
                        $exportDate = null;
                    }
                }
            } else {
                $exportDate = null;
            }
        }
        $this->export_pdf($exportDate, $exportName);
    }

    //公共方法：导出 pdf 文件
    public function export_pdf($data, $title, $image, $fileName='exportFile'){
        if(empty($fileName) || empty($title) || empty($data)) $this->error("导出的数据为空！");
        vendor("tcpdf.tcpdf");
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);//新建pdf文件
        //设置文件信息
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Author");
        $pdf->SetTitle("$fileName");
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //设置页眉页脚
        $pdf->SetHeaderData('', 0, '','',array(66,66,66), array(0,0,0));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //去掉页眉页脚
//        $pdf->setPrintHeader(false);
//        $pdf->setPrintFooter(false);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);//设置默认等宽字体
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);//设置页面边幅
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);//设置自动分页符
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray('$l');
        }

        $pdf->SetFont('droidsansfallback', '');
        $pdf->AddPage();
        $pdf->writeHTML("<div><h1>$title</h1></div>", true, false, false, false, 'C');

        if ($image == null) {
            foreach($data as $list) {
                foreach($list as $key=>$row){
                    $pdf->Write(8, $row, '', 0, 'L', true, 0, false, false, 0);
                }
                $pdf->writeHTML("<br />");
            }
        } else {
            $pdf->Image($image, '130', '57', 35, 35);
            foreach($data as $list) {
                foreach($list as $key=>$row){
                    $pdf->Write(8, $row, '', 0, 'L', true, 0, false, false, 0);
                }
                $pdf->writeHTML("<br />");
            }
        }

        $showType= 'D';//PDF输出的方式。I，在浏览器中打开；D，以文件形式下载；F，保存到服务器中；S，以字符串形式输出；E：以邮件的附件输出。
//        $pdf->Output("{$fileName}.pdf", $showType);
        $pdf->Output(date('Y-m-d', time()).".pdf", $showType);
        exit;
    }

}