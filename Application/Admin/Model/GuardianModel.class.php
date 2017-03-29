<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东1
 * Date: 2016/5/2
 * Time: 16:07
 */

namespace Admin\Model;
use Think\Model;

class GuardianModel extends Model{

    /**
     * 自动验证监护人或父母的信息
     * @var array
     * @author 杨亚东
     */
    protected $_validate = array(
        array('name','require','监护人或父母姓名为必填项！'), 
//        array('id_num','/^\d{17}([0-9]|X|x)$/','监护人或父母身份证号填写有误！'),
        array('phone','/^1[3|4|5|7|8]\d{9}$/','监护人或父母电话未填写或填写有误！',0,'regex'), 
//        array('pub_junior','require','公办学校未选择！'), 
//        array('workunit','require','监护人或父母工作单位为必填项！'),
//        array('occupation','require','监护人或父母职业为必填项！'),
    );

    /**
     * 获得某学生的监护人或父母的信息
     * @param $student 学生id
     * @return array $duty_info 监护人或父母的信息
     * @author 杨亚东
     */
    public function get_student_duty_info($student){
        $duty_info = array();
        $res = M('guardian')->where('student_id='.$student)->select();
        foreach($res as $value){
            if($value['relations'] == '0'){
                $duty_info['father_info'] = $value;
            }elseif($value['relations'] == '1'){
                $duty_info['mother_info'] = $value;
            }else{
                $duty_info['guardian_info'] = $value;
            }
        }
        return $duty_info;
    }

}