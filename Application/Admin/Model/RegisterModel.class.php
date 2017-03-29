<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东1
 * Date: 2016/5/2
 * Time: 16:14
 */

namespace Admin\Model;
use Think\Model;

class RegisterModel extends Model{

    /**
     * 获取某学生的报名志愿信息
     * @param $student 学生id
     * @return mixed $res 报名志愿信息
     * @author 杨亚东
     */
    public function get_student_volunteer_info($student){
        $res = M('register as r')
            ->field('r.civil_junior,o.name as civil_junior_name,r.pub_junior,o1.name as pub_junior_name')
            ->join('left join organ as o on o.id=r.civil_junior')
            ->join('left join organ as o1 on o1.id=r.pub_junior')
            ->where('r.sid='.$student)
            ->find();
        return $res;
    }

    /**
     * 修改某学生的志愿信息
     * @param $student 学生id
     * @param $volunteer 志愿信息
     * @param $status 操作类型
     * @return bool
     * @author 杨亚东
     */
    public function save_volunteer($student,$volunteer,$status){
        $now_time = time();
        $register_table = M('register');
        $register_where['sid'] = array('in',$student);
        if($status=='assign'){
            $register_where['status'] = 2;
            $register_save_res = $register_table -> where($register_where) -> setField('assign_junior',$volunteer);
            return $register_save_res;
        }else{
            $register_where['status'] = 0;
            $register_table->startTrans();
            $register_save_res = $register_table -> where($register_where) -> setField('status','1');
            if(!empty($register_save_res)){
                $student_info['sid'] = $student;
                $student_info['creattime']=$student_info['updatetime']=$now_time;
                $student_info['pub_junior']=$volunteer;
                $register_res = $register_table -> add($student_info);
                if($register_res){
                    $register_table->commit();
                    return true;
                }
            }
            $register_table->rollback();
            return false;
        }

    }

    /**
     * 获得某学生的报名信息
     * @param $student 学生id
     * @return mixed 学生报名信息
     * @author 杨亚东
     */
    public function get_enroll_info($student){
        $register_table = M("register as r");
        $res = $register_table
            -> field('r.id,r.pub_status,r.civil_status,r.lot_release,r.civil_release,r.pub_release,r.civil_junior as civil_junior_id,r.pub_junior as pub_junior_id,r.status,o1.name as pub_junior,o2.name as civil_junior,o3.name as assign_junior')
            -> join("left join organ as o1 on r.pub_junior=o1.id")
            -> join("left join organ as o2 on r.civil_junior=o2.id")
            -> join("left join organ as o3 on r.assign_junior=o3.id")
            -> where("r.sid=".$student)
            -> order('r.updatetime asc')
            -> select();
        return $res;
    }

}