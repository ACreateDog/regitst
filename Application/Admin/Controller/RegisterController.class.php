<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 11:27
 */
namespace Admin\Controller;

use Org\Util\String;

class RegisterController extends BaseController
{

    // 权限控制  '方法名' => 'all' 所有权限都可访问
    // 权限控制  '方法名' => ['allow' => [权限列表] ]   允许某些权限访问
    // 权限控制  '方法名' => ['deny' => [权限列表] ]   拒绝某些权限访问
    public $route = [
        'student_info' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'add_student_info' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'save_student_info' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'save_student_volunteer' =>  [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'add_save' =>  [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'submit_info' =>  [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'student' => 'all',
        'look_student_info' => [ 'allow' =>  [CITY_RANK,AREA_RANK,PRIMARY_RANK] ],
        'reset_pass' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'uploadImg' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
        'export_excel' => 'all',
        'assign_junior'=>[ 'allow' =>  [CITY_RANK]],
        'issue' => [ 'allow' =>  [CITY_RANK]],
        'import_assign_junior' => [ 'allow' =>  [CITY_RANK]],
        'download_template' => [ 'allow' =>  [CITY_RANK]],
        'refuse_info' => [ 'allow' =>  [CITY_RANK,AREA_RANK,CLASS_RANK] ],
    ];

    /**
     * 查看所属学生信息(本人负责填报的学生)
     * @param int $type 查询参数默认【3：全部，1：已录取，2：已拒绝，0：信息未提交】
     * @author 杨亚东
     */
    public function student_info($type=3){
        $student_model = D("Student");
        $student_info = $student_model->get_student_all($type);
        $student_info = $this->dispose_student_info($student_info);
        $secondary_school = D('organ')->get_secondary_school();
        if($type==3){
            $reminder = "学生信息（全部）";
        }else if($type == 1){
            $reminder = "学生信息（已录取）";
        }else if($type==2){
            $reminder = "学生信息（已拒绝）";
        }else if($type==0){
            $reminder = "学生信息（未提交）";
        }else{
            $reminder = "查询有误";
        }
        $this->assign("title","我填报的");
        $this->assign("route","我填报的");
        $this->assign("student_info",$student_info);
        $this->assign("reminder",$reminder);
        $this->assign("where",$type);
        $this->assign("pub_secondary_school",$secondary_school['pub_secondary_school']);
        $this->display("student_info");
    }

    /**
     * 学生报名（界面）
     * $secondary_school中学信息【公办，民办】
     * $secondary_school['pub_secondary_school']（公办）
     * $secondary_school['civil_secondary_school']（民办）
     * @author 杨亚东
     */
    public function add_student_info(){
        $secondary_school = D('organ')->get_secondary_school();
        $this->assign("title","信息填报");
        $this->assign("route","信息填报");
        $this->assign("reminder","填写信息");
        $this->assign("secondary_school",$secondary_school);
        $this->assign("default","student_photo/default.jpg");//学生默认相片
        $this->display("add_info_save");
    }

    /**
     * 学生报名信息修改（界面）
     * $student_id 要修改学生id
     * $student_info 此学生基本信息
     * $secondary_school中学信息【公办，民办】
     * $secondary_school['pub_secondary_school']（公办）
     * $secondary_school['civil_secondary_school']（民办）
     * @author 杨亚东
     */
    public function save_student_info(){
        $student_id = I('get.student_id');
        $student_info = $this -> get_student_info($student_id);
//        if(empty($student_info)){
//
//        }
        $secondary_school = D('organ')->get_secondary_school();
        $this->assign("title","修改学生信息");
        $this->assign("route","修改学生信息");
        $this->assign("student_info",$student_info);
        $this->assign("secondary_school",$secondary_school);
        $this->assign("student",$student_id);
        $this->display("add_info_save");
    }

    /**
     * 学生志愿重填（操作）
     * @param int $student_id 需要修改信息的学生id
     * @param string $volunteer 新的志愿信息
     * @author 杨亚东
     */
    public function save_student_volunteer(){
        $student_id = I('post.student_id');
        $volunteer = I('post.volunteer');
        $status = I("post.status",false);
        $res = D('register')->save_volunteer($student_id,$volunteer,$status);
        if(empty($res)){
            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'操作失败']);
        }else{
            $this->json_response(['code'=>'0','msg'=>'成功','data'=>'操作成功']);
        }
    }

    /**
     * 学生报名信息的添加或修改（操作）
     * @param int $student 学生id【0：添加，'other（其他）'：修改】
     * @param array $student_info 学生信息
     * @return array code:0(成功)code：1（失败）
     * @author 杨亚东
     */
    public function add_save(){
        $time = M('setting')->find();
        if(date("m-d",$time['register_end_time'])<date('m-d')){
            $this->json_response(['code'=>'2','msg'=>'提示','data'=>'非报名时间']);
        }
        $student_info = I("post.student_info");
        $student = I("post.student",0);
        $sid_num = I("post.sid_num",0);
        $model = D("StudentInfo");
        if(!empty($student_info['basis_info']) && !$model->create($student_info['basis_info'])){
            $this->json_response(['code'=>'2','msg'=>'警告','data'=>$model->getError()]);
        }else{
            if(!empty($student_info['duty_info']['guardian_info']) && !D('guardian')->create($student_info['duty_info']['guardian_info'])){
                $this->json_response(['code'=>'2','msg'=>'警告','data'=>D("guardian")->getError()]);
            }else{
                if(!empty($student_info['duty_info']['mother_info']) && !D('guardian')->create($student_info['duty_info']['mother_info'])){
                    $this->json_response(['code'=>'2','msg'=>'警告','data'=>D("guardian")->getError()]);
                }else{
                    if(!empty($student_info['duty_info']['father_info']) && !D('guardian')->create($student_info['duty_info']['father_info'])){
                        $this->json_response(['code'=>'2','msg'=>'警告','data'=>D("guardian")->getError()]);
                    }else{
                        if($student == 0){
                            $res = $model -> add_student_info($student_info);
                        }else{
                            $res = $model -> save_student_info($student,$sid_num,$student_info);
                        }
                        if($res==false){
                            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'保存失败']);
                        }
                        $this->json_response(['code'=>'0','msg'=>'成功','data'=>$res]);
                    }
                }
            }
        }
    }

    /**
     * 提交某个学生的信息(操作)
     * 提交后无法修改
     * @param int $student_id 学生id
     * @author 杨亚东
     */
    public function submit_info(){
        $time = M('setting')->find();
        if(date("m-d",$time['register_end_time'])<date('m-d')){
            $this->json_response(['code'=>'2','msg'=>'提示','data'=>'非报名时间']);
        }
        $student_id = I("post.student");
        $data['status'] = 1;
        $data['updatetime'] = time();
        $res = M('student')->where('id in ('.$student_id.')')->save($data);
        if(empty($res)){
            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'提交失败']);
        }else{
            $this->json_response(['code'=>'0','msg'=>'成功','data'=>'提交成功']);
        }
    }

    /**
     * 修改本人负责填报的学生家长或监护人信息
     * @author 杨亚东
     */
    public function save_duty_info(){
        $data = I("post.");
        $data['creattime']=time();
        $res = M("guardian")->where("id=".$data['duty_info_id'])->save($data);
        if(empty($res)){
            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'修改失败']);
        }else{
            $this->json_response(['code'=>'0','msg'=>'成功','data'=>'修改成功']);
        }
    }

    /**
     * 查看学生的报名信息
     * @param int $student 学生id
     * @return array $student_info 学生基本信息
     * @author 杨亚东
     */
    public function student(){
        $student = I("get.student");
        $student_info = $this -> get_student_info($student);
//        $secondary_school = D('organ')->get_secondary_school();
//        foreach($secondary_school['pub_secondary_school'] as $value){
//            if($value['id'] == $student_info['volunteer']['pub_junior']){

//            }
//        }
//        foreach($secondary_school['civil_secondary_school'] as $value){
//            if($value['id'] == $student_info['volunteer']['civil_junior']){
//                $student_info['volunteer']['civil_junior'] = $value['name'];
//            }
//        }
        $this->assign("title","学生填报信息");
        $this->assign("route","学生填报信息");
        $this->assign("reminder","学生信息");
        $this->assign("student_info",$student_info);
        $this->assign("student",$student);
//        dump($student_info);
//        dump($student);
//        exit;
        $this->get_enroll_info($student);
        $this->display("student");
    }

    /**
     * 获取学生的录取详情
     * @param $student 学生id
     * @author 杨亚东
     */
    public function get_enroll_info($student){
        $enroll_info = D("register")->get_enroll_info($student);
        $reason_info = D('reject')->get_student_refuse_info($student);
        $enroll_info_data = array();
        foreach($enroll_info as $key=>$value){
            $register_id = 0;
            if(!empty($value['civil_junior'])){
                if($value['lot_release']==0/*&&$value['civil_status']==0&&$value['civil_release']==0*/){
                    $status = '等待摇号';
                    $remark = '';
                    $register_id = 3;
                }elseif($value['civil_release']==0){
                    $status = '派中';
                    $remark = '等待报名';
                    $register_id = 3;
                }elseif($value['civil_status']==2){
                    $status = '派中已录取';
                    $remark = $value['civil_junior'].'已录取';
                    $register_id = 1;
                }elseif($value['civil_status']==3){
                    $status = '派中未录取';
                    $remark = '';
                    foreach($reason_info as $k=>$val){
                        if($value['civil_junior_id']==$val['school_id']&&$value['id']==$val['register_id']){
                            $remark = $val['reason'];
                            break;
                        }
                    }
                    $register_id = 2;
                }elseif($value['civil_status']==4){
                    $status = '未派中';
                    $remark = '';
                    $register_id = 2;
                }
                $data = array ( "school" =>$value['civil_junior'],'type'=>'民办','status'=>$status,'remark'=>$remark);
                array_push($enroll_info_data,$data);
            }
            //公办学校信息处理
            if($value['pub_release']==0){
                if($register_id==0||$register_id==2){
                    $status = '审核中';
                    $remark = '——';
                }elseif($register_id==1){
                    $status = '——';
                    $remark = '——';
                }elseif($register_id==3){
                    $status = '等待中';
                    $remark = '——';
                }
            }elseif($value['pub_status']==1){
                $status = '已录取';
                $remark = $value['pub_junior'].'已录取';
            }elseif($value['pub_status']==2){
                $status = '未录取';
                $remark = '';
                foreach($reason_info as $k=>$val){
                    if($value['pub_junior_id']==$val['school_id']&&$value['id']==$val['register_id']){
                        $remark = $val['reason'];
                        break;
                    }
                }
            }
            $data = array ( "school" =>$value['pub_junior'],'type'=>'公办','status'=>$status,'remark'=>$remark);
            array_push($enroll_info_data,$data);
            if($value['status']!=0&&$value['status']!=1){
                if($value['status']==2){
                    $school = '';
                    $status = '等待分配';
                    $remark = '';
                }elseif($value['status']==3){
                    $school = $value['assign_junior'];
                    $status = '已调剂';
                    $remark = '调剂到'.$value['assign_junior'];
                }
                $data = array ( "school" =>$school,'type'=>'公办','status'=>$status,'remark'=>$remark);
                array_push($enroll_info_data,$data);
            }
        }
        $this->assign("enroll_info",$enroll_info_data);
    }

    /**
     * 获得并整合某个学生信息
     * @param int $student_id 学生id
     * @return mixed $student_info
     * @author 杨亚东
     */
    public function get_student_info($student_id){
        $student_info = false;
        $student_basis_info = D('student') -> get_stundent_basis_info($student_id);
        if(!empty($student_basis_info)){
            $student_volunteer_info = D('register') -> get_student_volunteer_info($student_id);
            if(!empty($student_volunteer_info)){
                $student_duty_info = D('guardian') -> get_student_duty_info($student_id);
                if(!empty($student_duty_info)){
                    $student_info['basis_info'] = $student_basis_info;
                    $student_info['volunteer'] = $student_volunteer_info;
                    $student_info['duty_info'] = $student_duty_info;
                }
            }
        }
//        dump($student_info);
//        exit;
        return $student_info;
    }

    /**
     * 查看所辖地域的学生报名情况
     * @param int $student_type 生源类型【默认全部：2，学区生：0，统筹生1】
     * @param int $lottery 摇中状态【默认全部：2，未摇中：0，摇中：1，等待摇号：-1】
     * @param int $school_district 所属学区【默认全部】
     * @param int $school【默认全部】
     * @param int $class_id【默认全部】
     * @param int $civil_junior【默认全部】
     * @param int $pub_junior【默认全部】
     * @author 杨亚东
     */
    public function look_student_info($student_type=2,$lottery=2,$school_district=0,$school=0,$class_id=0,$civil_junior=-1,$pub_junior=-1){
//        $area = D('organ')->get_primary_school(1,1);//获取所辖区域的小学信息
        $area = D('organ')->get_primary_school(session('oid'),session('rank'));
        $type = $this -> look_student_info_where($area,$school_district,$school,$class_id);//处理查询条件
        $student_model = D("student");
        $student_info = $student_model->get_student_all($type,'lead',$student_type,$lottery,$civil_junior,$pub_junior);
        $student_info = $this->dispose_student_info($student_info);
        $this->assign("student_info",$student_info);
        $this->assign("area",$area);
        $this->assign("organization",json_encode($area));
        $this->assign("title","我管辖的");
        $this->assign("route","我管辖的");
        $this->assign("reminder","报名信息");
        $this->assign("where",[$student_type,$lottery,$school_district,$school,$class_id,$civil_junior,$pub_junior]);
        $secondary_school = D('organ')->get_secondary_school();
        $this->assign("secondary_school",$secondary_school);
        $this->display('look_student_info');
    }

    /**
     * 学生经手人重置学生密码
     * 密码为身份证号后六位
     * @author 杨亚东
     */
    public function reset_pass(){
        $student = I("post.student");
        $pass = I("post.pass");
        $user_table = M('user');
        $user_where['account'] = $student;
        $user_data['updatetime'] = time();
        $user_data['pass'] = md5(substr($pass,12));
        $user_res = $user_table -> where($user_where) ->save($user_data);
        if(!empty($user_res)){
            $this->json_response(['code'=>'0','msg'=>'成功','data'=>'重置成功']);
        }else{
            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'重置失败']);
        }
    }

    /**
     * @param int $type 查询参数默认1：已分配，0：待分配】
     * @author 杨亚东
     */
    public function assign_junior($type=0){
        $student_model = D("Student");
        $student_info = $student_model->get_student_all($type,'assign');
        $student_info = $this->dispose_student_info($student_info);
        $secondary_school = D('organ')->get_secondary_school();
        if($type == 1){
            $reminder = "分配学校（已分配）";
        }else if($type == 0){
            $reminder = "分配学校（待分配）";
        }else{
            $reminder = "查询有误";
        }
        $this->assign("title","分配学校");
        $this->assign("route","分配学校");
        $this->assign("student_info",$student_info);
        $this->assign("reminder",$reminder);
        $this->assign("where",$type);
        $this->assign("pub_secondary_school",$secondary_school['pub_secondary_school']);
        $this->display("assign_junior");
    }

    /**
     * 发布分配结果【发布全部已分配的】
     * @author 杨亚东
     */
    public function issue(){
        $res = M("register")->where('status=2 and assign_junior!=0')->setField('status','3');
        if(!empty($res)){
            $this->json_response(['code'=>'0','msg'=>'成功','data'=>'已发布']);
        }else{
            $this->json_response(['code'=>'1','msg'=>'失败','data'=>'发布失败']);
        }
    }

    /**
     * 导入未分配或未发布的学生的分配信息
     * @author 杨亚东
     */
    public function import_assign_junior(){
        $info = A('Org')->upload();
        $file = './Uploads/'.$info['savepath'].$info['savename'];
        $sheetData = From_Excel($file);
        $highestRow = count($sheetData);           //取得总行数

        $secondary_school = D('organ')->get_secondary_school();
        for($row=2;$row<=$highestRow;$row++){                        //从第二行开始读取数据
            $data = false;
            foreach($secondary_school['pub_secondary_school'] as $value){
                if($sheetData[$row]['B']==$value['name']){
                    $data = $value['id'];
                    break;
                }
            }
            if(!empty($data)){
                $where['sid_num'] = $sheetData[$row]['A'];
                $student_id = M('student')->field('id')->where($where)->find();
                if(!empty($student_id)){
                    M('register')->where('status=2 and sid='.$student_id['id'])->setField('assign_junior',$data);
                }
            }
        }
        unlink($file);
        $this->json_response(['code'=>'0','msg'=>'成功','data'=>'导入成功']);
    }

    /**
     * 下载 excel导入模板
     */
    public function download_template(){
        $filename = '导入文件模板';
        $header_list = ['学籍号','分配学校(公办)'];
        To_Exel($filename,$header_list);
    }

    /**
     * 查看拒绝原因
     * @author 杨亚东
     */
    public function refuse_info(){
        $register_id = I("post.register_id");
        $school_id = I("post.school_id");
        $res = D('Reject')->get_refuse_info($register_id,$school_id);
        if(empty($res)){
//            $this->json_response(['code'=>'2','msg'=>'提示','data'=>'未查到数据！！！']);
            $this->json_response(['code'=>'0','msg'=>'提示','data'=>'教育局统一分配']);
        }else{
            $this->json_response(['code'=>'0','msg'=>'拒绝原因','data'=>$res['reason']]);
        }
    }

    /**
     * 所辖区域的学生报名信息的查找条件的处理
     * @param $area 机构信息
     * @param $school_district 学区
     * @param $school 小学
     * @param $class_id 班级
     * @return string $type
     * @author 杨亚东
     */
    public function look_student_info_where($area,$school_district,$school,$class_id){
        $type = '0';
        if(!empty($area['school_district']) && $school_district==0){
            $type=$type.','.session('oid');
            foreach($area['school_district'] as $key=>$value){
                $type=$type.','.$key;
            }
            foreach($area['class'] as $key=>$value){
                foreach($value as $k=>$val){
                    $type=$type.','.$k;
                }
            }
        }elseif(!empty($area['school_district']) && $school_district != 0){
            $type=$type.','.$school_district;
            if($school!=0){
                if($class_id!=0){
                    $type=$type.','.$class_id;
                }else if($class_id==0){
                    foreach($area['class'][$school] as $key=>$value){
                        $type=$type.','.$key;
                    }
                }
            }else if($school==0){
                foreach($area['primary_school'][$school_district] as $key=>$value){
                    $type=$type.','.$key;
                    foreach($area['class'][$key] as $k=>$val){
                        $type=$type.','.$k;
                    }
                }
            }
        }elseif(!empty($area['primary_school']) && $school==0){
            $type=$type.','.session('oid');
            foreach($area['class'] as $key=>$value){
                foreach($value as $k=>$val){
                    $type=$type.','.$k;
                }
            }
        }elseif(!empty($area['primary_school']) && $school != 0){
            if($class_id!=0){
                $type=$type.','.$class_id;
            }else if($class_id==0){
                foreach($area['class'][$school] as $key=>$value){
                    $type=$type.','.$key;
                }
            }
        }elseif(!empty($area['class']) && $class_id == 0){
            foreach($area['class'] as $key=>$value){
                foreach($value as $k=>$val){
                    $type=$type.','.$k;
                }
            }
        }elseif(!empty($area['class']) && $class_id != 0){
            $type=$type.','.$class_id;
        }
        return $type;
    }

    /**
     * 上传图片
     * @return  string    0（失败）---or---详细地址（成功）
     * @author 杨亚东
     */
    public function uploadImg(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      'student_photo/'; // 设置附件上传（子）目录

        // 上传文件
        $info   =   $upload->uploadOne($_FILES['photo_image']);
        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            echo 0;
        }else{// 上传成功 获取上传文件信息
            //$this->display('templateList');
            echo $info['savepath'].$info['savename'];
        }
    }

    /**
     * 前台显示学生数据预处理
     * @param $student_info 学生数据
     * @return mixed $student_info（处理后的学生数据）【并缓存用于下载】
     * @author 杨亚东
     */
    public function dispose_student_info($student_info){
        $secondary_school = D('organ')->get_secondary_school();
        foreach($student_info as $key=>$student_info_val){
            //处理再分配信息
            if($student_info_val['assign_junior']!=0 && $student_info_val['status']==3){
                $student_info[$key]['assign_junior_status'] = "已发布";
                $student_info[$key]['assign_junior_operation'] = "已发布";
            }elseif($student_info_val['assign_junior']!=0 && $student_info_val['status']==2){
                $student_info[$key]['assign_junior_status'] = "未发布";
                $student_info[$key]['assign_junior_operation'] = '<a student_id="'.$student_info[$key]['id'].'" class="again_junior issue_y btn btn-info btn-xs"><i class="fa fa-edit"></i> 重新分配</a>';
            }elseif($student_info_val['assign_junior']==0){
                $student_info[$key]['assign_junior_status'] = "未分配";
                $student_info[$key]['assign_junior_operation'] = '<a student_id="'.$student_info[$key]['id'].'" class="again_junior btn btn-info btn-xs"><i class="fa fa-edit"></i> 分配学校</a>';
            }
            //公办【志愿or分配】学校对应
            $pub_junior = $assign_junior = false;
            foreach($secondary_school['pub_secondary_school'] as $value){
                if($value['id'] == $student_info_val['pub_junior']){
                    $student_info[$key]['pub_junior'] = $value['name'];
                    $pub_junior=true;
                }
                    if($value['id'] == $student_info_val['assign_junior']){
                        $student_info[$key]['assign_junior'] = $value['name'];
                        $assign_junior=true;
                    }
                if($pub_junior&&$assign_junior){
                    break;
                }
            }
            if(empty($student_info[$key]['assign_junior'])){
                $student_info[$key]['assign_junior'] = "无";
            }
            if($student_info_val['civil_junior'] != 0){
                foreach($secondary_school['civil_secondary_school'] as $value){
                    if($value['id'] == $student_info_val['civil_junior']){
                        $student_info[$key]['civil_junior'] = $value['name'];
                        break;
                    }
                }
            }else{
                $student_info[$key]['civil_junior']='无';
            }
            $lot_release = $student_info_val['lot_release'];//摇号发布状态
            $civil_status = $student_info_val['civil_status'];//民办操作状态
            $civil_release = $student_info_val['civil_release'];//民办发布状态
            $pub_status = $student_info_val['pub_status'];//公办操作状态
            $pub_release = $student_info_val['pub_release'];//公办发布状态

            //状态匹配数据
            $student_info[$key]['assign_status'] = "无";
            $student_info[$key]['operation'] = '——';
            $student_info[$key]['result'] = '——';//学生最终去向
            if($student_info_val['civil_junior']==0){//未报民办初中
//                $student_info[$key]['operation'] = "审核中（公办）";
                $student_info[$key]['civil_status'] = '无';
                if($pub_release == 0){
                    $student_info[$key]['pub_status'] = '审核中';
//                    $student_info[$key]['operation'] = "审核中（公办）";
                }elseif($pub_status==1){
                    $student_info[$key]['pub_status'] = '已录取';
                    $student_info[$key]['result'] = $student_info[$key]['pub_junior'];
//                    $student_info[$key]['operation'] = $student_info[$key]['pub_junior']."已录取";
                }elseif($pub_status==2){
                    $student_info[$key]['pub_status'] = '<a href="javascript:void(0);" register_id="'.$student_info[$key]['register_id'].'" school_id="'.$student_info_val['pub_junior'].'" class="look_info">被拒绝</a>';
                    $student_info[$key]['pub_status_excel'] = '被拒绝';
                    if($student_info[$key]['status']==2) {//未分配或分配未发布
//                        $student_info[$key]['operation'] = $student_info[$key]['assign_status'] = "等待分配中";
                        $student_info[$key]['assign_status'] = "等待分配中";
                    }elseif($student_info[$key]['status']==3){//分配并已发布
//                        $student_info[$key]['operation'] = $student_info[$key]['assign_status'] = "调剂到".$student_info[$key]['assign_junior'];
                        $student_info[$key]['assign_status'] = "调剂到".$student_info[$key]['assign_junior'];
                        $student_info[$key]['result'] = $student_info[$key]['assign_junior'];
                    }elseif($student_info[$key]['status']==0){//被拒绝
                        $student_info[$key]['operation'] = '<a student_id="'.$student_info[$key]['id'].'" class="again_write_btn"><i class="fa fa-edit"></i> 重选学校</a>';
                    }
                }
            }else{//填报了民办初中
//                $student_info[$key]['operation'] = "审核中（民办）";
                if($lot_release==0/* && ($civil_status==0 || $civil_status==1 || $civil_status==4)*/){
                    $student_info[$key]['civil_status'] = '审核中';
                    $student_info[$key]['pub_status'] = '等待中';
                }elseif($lot_release==1 && $civil_release==1 && ($civil_status==3||$civil_status==4)){
                    if($civil_status==3){
                        $student_info[$key]['civil_status'] = '<a href="javascript:void(0);" register_id="'.$student_info[$key]['register_id'].'" school_id="'.$student_info_val['civil_junior'].'" class="look_info">被拒绝</a>';
                        $student_info[$key]['civil_status_excel'] = '被拒绝';
                    }else{
                        $student_info[$key]['civil_status'] = '未派中';
                    }


                    //公办学校信息处理
                    $student_info[$key]['pub_status'] = '审核中';
//                    $student_info[$key]['operation'] = "审核中（公办）";
                    if($pub_release == 0){
                        $student_info[$key]['pub_status'] = '审核中';
//                        $student_info[$key]['operation'] = "审核中（公办）";
                    }elseif($pub_status==1){
                        $student_info[$key]['pub_status'] = '已录取';
                        $student_info[$key]['result'] = $student_info[$key]['pub_junior'];
//                        $student_info[$key]['operation'] = $student_info[$key]['pub_junior']."已录取";
                    }elseif($pub_status==2){
                        $student_info[$key]['pub_status'] = '<a href="javascript:void(0);" register_id="'.$student_info[$key]['register_id'].'" school_id="'.$student_info_val['pub_junior'].'" class="look_info">被拒绝</a>';
                        $student_info[$key]['pub_status_excel'] = '被拒绝';
                        if($student_info[$key]['status']==2) {
//                            $student_info[$key]['operation'] = $student_info[$key]['assign_status'] = "等待分配中";
                            $student_info[$key]['assign_status'] = "等待分配中";
                        }elseif($student_info[$key]['status']==3){
//                            $student_info[$key]['operation'] = $student_info[$key]['assign_status'] = "调剂到".$student_info[$key]['assign_junior'];
                            $student_info[$key]['assign_status'] = "调剂到".$student_info[$key]['assign_junior'];
                            $student_info[$key]['result'] = $student_info[$key]['assign_junior'];
                        }else{
                            $student_info[$key]['operation'] = '<a student_id="'.$student_info[$key]['id'].'" class="again_write_btn"><i class="fa fa-edit"></i> 重选学校</a>';
                        }
                    }
                }elseif($lot_release==1 && $civil_release==1 && $civil_status==2){
                    $student_info[$key]['civil_status'] = '已录取';
                    $student_info[$key]['pub_status'] = '无';
                    $student_info[$key]['result'] = $student_info[$key]['civil_junior'];
//                    $student_info[$key]['operation'] = $student_info[$key]['civil_junior']."已录取";
//                }elseif($lot_release==1 && $civil_release==1 && $civil_status==4){
//                    $student_info[$key]['civil_status'] = '未派中';
//                    $student_info[$key]['pub_status'] = '审核中';
//                    $student_info[$key]['operation'] = "审核中（公办）";
                }elseif($lot_release==1 && $civil_status!=0){
                    $student_info[$key]['civil_status'] = '被派中';
                    $student_info[$key]['pub_status'] = '等待中';
//                    $student_info[$key]['operation'] = "等待新生报到";
                }
            }

            //信息未提交提示处理
            $student_info[$key]['real_name'] = $student_info[$key]['name'];
            $status = "";
            if(isset($student_info_val['s_status'])&&$student_info_val['s_status']==0){
                $status = "<i class='fa-fw fa fa-warning present_warning tooltip-warning' data-toggle='tooltip' data-placement='left' data-original-title='信息未提交'></i>";
            }
            $student_info[$key]['name'] = '<a href="'.U('Register/student',array('student'=>$student_info_val['id'])).'">'.$status.$student_info_val['name'].'</a>';
            $student_info[$key]['updatetime'] = date('Y-m-d',$student_info[$key]['updatetime']);
            //基本信息显示处理
            if($student_info[$key]['sex']==0){
                $student_info[$key]['sex'] = '男';
            }else{
                $student_info[$key]['sex'] = '女';
            }
            if($student_info[$key]['origin']==0){
                $student_info[$key]['origin'] = '学区生';
            }else{
                $student_info[$key]['origin'] = '统筹生';
            }
        }
        S('student',$student_info);//缓存用于导出表单
        return $student_info;
    }

    /**
     * 导出学生信息
     * @author 杨亚东
     */
    public function export_excel($type=false,$name){
        $student_info = S('student');
        $list_id = 1;
        foreach ($student_info as $k => $info) {
            $list[$k]["list_id"] = $list_id;
            $list[$k]["real_name"] = $info['real_name'];
            $list[$k]["sex"] = $info['sex'];
            $list[$k]["sid_num"] = $info['sid_num'];
            $list[$k]["origin"] = $info['origin'];
            if($type == 'lead'){
                if($info['srank']==5){
                    $list[$k]["school"] = $info['school'];
                }else{
                    $list[$k]["school"]=$info['original_school']?:"未知";
                }
                if($info['crank']==6){
                    $list[$k]["class"] = $info['class'];
                }else{
                    $list[$k]["class"]='未知';
                }
            }
            $list[$k]["pub_junior"] = $info['pub_junior'];
            $list[$k]["civil_junior"] = $info['civil_junior'];
            $list[$k]["assign_junior"] = $info['assign_junior'];
            $list[$k]["account"] = $info['account'];
            $list[$k]["address"] = $info['address'];
            if($type=='issue'){
                $list[$k]["pub_status"] = $info['pub_status_excel'];
                $list[$k]["civil_status"] = $info['civil_status_excel'];
                $list[$k]["assign_status"] = $info['assign_status'];
            }
            $list[$k]["result"] = $info['result'];
            $list[$k]["phone"] = $info['phone'];
            $list_id++;
        }

        foreach ($list as $field => $v) {
            if($field == 'list_id'){
                $headArr[] = '序号';
            }

            if($field == 'real_name'){
                $headArr[] = '学生姓名';
            }

            if ($field == 'sex') {
                $headArr[] = '性别';
            }

            if ($field == 'sid_num') {
                $headArr[] = '学籍号码（全国学籍系统）';
            }

            if ($field == 'origin') {
                $headArr[] = '生源类型';
            }

            if($type == 'lead'){
                if ($field == 'school') {
                    $headArr[] = '毕业小学';
                }

                if ($field == 'class') {
                    $headArr[] = '班级';
                }
            }

            if ($field == 'pub_junior') {
                $headArr[] = '公办初中志愿';
            }

            if ($field == 'civil_junior') {
                $headArr[] = '民办初中志愿';
            }

            if ($field == 'assign_junior') {
                $headArr[] = '二次分配去向';
            }

            if ($field == 'account') {
                $headArr[] = '户口所在地';
            }

            if ($field == 'address') {
                $headArr[] = '家庭常住地址';
            }

            if($type=='issue'){
                if ($field == 'pub_status') {
                    $headArr[] = '录取状态(公办)';
                }

                if ($field == 'civil_status') {
                    $headArr[] = '录取状态(民办)';
                }

                if ($field == 'assign_status') {
                    $headArr[] = '再分配情况';
                }
            }

            if ($field == 'result') {
                $headArr[] = '最终去向';
            }

            if ($field == 'phone') {
                $headArr[] = '联系手机号码';
            }

        }
        $filename = $name;
        To_Exel($filename, $headArr, $list);
    }
}