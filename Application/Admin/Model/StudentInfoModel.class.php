<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东1
 * Date: 2016/5/2
 * Time: 11:02
 */

namespace Admin\Model;
use Think\Model;

class StudentInfoModel extends Model{

    protected $tableName = 'student';
    Protected $autoCheckFields = false;

    /**
     * 自动验证
     * @var array
     * @author 杨亚东
     */
    protected $_validate = array(
        array('name','require','学生姓名为必填项！'), 
        array('nation','require','学生民族为必填项！'), 
        array('id_num','/^\d{17}([0-9]|X|x)$/','学生身份证号填写有误！'),
//        array('sid_num','/^[G|L|J]\d{17}([0-9]|X|x)$/','学生学籍号填写有误！'),
        array('sid_num','require','学生学籍号为必填项！'),
//        array('sid_num','','该学生已报过名！',0,'unique',1),
        array('account','require','户口所在地为必填项！'), 
        array('address','require','家庭住址为必填项！'), 
        array('phone','/^1[3|4|5|7|8]\d{9}$/','电话未填写或填写有误！',0,'regex'), 
        array('sex',array(1,0),'性别填写有误！',2,'in'), 
        array('birthday','require','学生生日为必填项！'), 
//        array('email','/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/','邮箱未填写或填写有误！',0,'regex'),  
//        array('house','require','房产证编号为必填项！'),
//        array('house_address','require','房产地址为必填项！'),
//        array('house_owners','require','房产所有人及共有人为必填项！'),
//        array('house_relations','require','房产证户主与孩子关系为必填项！'),
//        array('civil_junior','require','民办学校未选择！'), 
    );

    /**
     * 学生填报（操作）
     * @param $student_info 学生信息
     * @return mixed|string
     * @author 杨亚东
     */
    public function add_student_info($student_info){
        $now_time = time();
        $student_table = M("student");
        $student_info['basis_info']['creattime']=$student_info['basis_info']['updatetime']=$now_time;
        $student_info['basis_info']['oid'] = session('oid');
//        $student_info['basis_info']['oid'] = 1;
        $student_sid_num['sid_num'] = $student_info['basis_info']['sid_num'];
        if($student_table->where($student_sid_num)->find()){
            A('Admin/Base')->json_response(['code'=>'2','msg'=>'警告','data'=>'该生已报过名！']);
        }
        $student_table -> startTrans();
        $student_res = $student_table->add($student_info['basis_info']);
        if($student_res){
            $student_info['volunteer']['sid'] = $student_res;
            $student_info['volunteer']['creattime']=$student_info['volunteer']['updatetime']=$now_time;
            $register_table = M('register');
            $register_res = $register_table -> add($student_info['volunteer']);
            if($register_res) {
                foreach ($student_info['duty_info'] as $value) {
                    $value['student_id'] = $student_res;
                    $value['creattime']=$now_time;
                    $dataList[] = $value;
                }
                $guardian_table = M('guardian');
                $guardian_res = $guardian_table->addAll($dataList);
                if ($guardian_res) {
                    $user_table = M('user');
                    $user_data['account'] = $student_info['basis_info']['sid_num'];
                    $user_data['pass'] = md5(substr($student_info['basis_info']['id_num'],12));
                    $user_data['creattime'] = $user_data['updatetime'] = $now_time;
                    $user_res = $user_table -> add($user_data);
                    if(!empty($user_res)){
                        $student_table->commit();
                        return $student_res;
                    }else{
                        $student_table->rollback();
                    }
                } else {
                    $student_table->rollback();
                }
            }else{
                $student_table->rollback();
            }
        }
        return 'false';
    }

    /**
     * 学生信息修改
     * @param $student 学生id
     * @param $student_info 学生信息
     * @return bool
     * @author 杨亚东
     */
    public function save_student_info($student,$sid_num,$student_info){
        $now_time = time();
        $student_table = M("student");
        $student_info['basis_info']['updatetime']=$now_time;
        $student_where['id'] = $student;
        $student_table -> startTrans();
        //修改基本信息
        $student_res = $student_table->where($student_where)->save($student_info['basis_info']);
        if($student_res){//修改志愿信息
            $register_table = M('register');
            $register_where['sid'] = $student;
            $register_where['status'] = 0;
            $student_info['volunteer']['updatetime']=$now_time;
            $register_res = $register_table -> where($register_where) ->save($student_info['volunteer']);
            if(!empty($register_res)) {//修改监护人信息
                $guardian_table = M('guardian');
                $guardian_where['student_id'] = $student;
                $delete_res = $guardian_table -> where($guardian_where) -> delete();
                if($delete_res){
                    foreach ($student_info['duty_info'] as $value) {
                        $value['student_id'] = $student;
                        $value['creattime']=$now_time;
                        $dataList[] = $value;
                    }
                    $guardian_res = $guardian_table->addAll($dataList);
                    if ($guardian_res) {
                        $user_table = M('user');
                        $user_where['account'] = $sid_num;
                        $user_data['account'] = $student_info['basis_info']['sid_num'];
                        $user_data['updatetime'] = $now_time;
                        $user_res = $user_table -> where($user_where) -> save($user_data);
                        if(!empty($user_res)){
                            $student_table->commit();
                            return $student;
                        }else{
                            $student_table->rollback();
                        }
                    } else {
                        $student_table->rollback();
                    }
                }else{
                    $student_table->rollback();
                }
            }else{
                $student_table->rollback();
            }
        }else{
            $student_table->rollback();
        }
        return false;
    }
}