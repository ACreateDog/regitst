<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东
 * Date: 2016/5/23
 * Time: 12:06
 */

namespace Admin\Model;
use Think\Model;

class RejectModel extends Model{

    /**
     * 获取某个学生被拒绝的理由
     * @param $register_id 志愿id
     * @param $school_id 学校id
     * @return mixed 志愿学校的拒绝理由
     * @author 杨亚东
     */
    public function get_refuse_info($register_id,$school_id){
        $table = M("reject");
        $where['register_id'] = $register_id;
        $where['school_id'] = $school_id;
        $res = $table->field('reason')->where($where)->order('updatetime desc')->find();
        return $res;
    }

    public function get_student_refuse_info($student_id){
        $reject_table = M('reject as  re');
        $res = $reject_table
            -> field('re.register_id,re.school_id,re.reason')
            -> join('register as r on r.id=re.register_id')
            -> where("r.sid=".$student_id)
            -> select();
        return $res;
    }

}