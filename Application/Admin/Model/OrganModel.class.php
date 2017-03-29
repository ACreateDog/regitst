<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东1
 * Date: 2016/5/2
 * Time: 17:21
 */

namespace Admin\Model;
use Think\Model;

class OrganModel extends Model{

    private $primary_school = array();

    /**
     * 获取中学并分类（公办/民办）
     * @return $secondary_school【二维数组】
     * @author 杨亚东
     */
    public function get_secondary_school(){
        $where['status'] = 0;
        $where['rank'] = array('in',[3,4]);
        $get_secondary_school = M('organ')
            -> field('id,name,rank')
            -> where($where)
            -> select();
        $pub_secondary_school = array();
        $civil_secondary_school = array();
        foreach($get_secondary_school as $key => $value){
            if($value['rank']==3){
                $pub_secondary_school[$key] = $value;
            }else{
                $civil_secondary_school[$key] = $value;
            }
        }
        $secondary_school['pub_secondary_school'] = $pub_secondary_school;
        $secondary_school['civil_secondary_school'] = $civil_secondary_school;
        return $secondary_school;
    }

    /**
     * 获取所属班级并划分（[区]->[小学]->班级）
     * @param int $organ_id 机构id
     * @param int $organ_rank 等级
     * @return array
     */
    public function get_primary_school($organ_id=1,$organ_rank=1){
        $organ_table = M('organ');
        $where['status'] = 0;
        $where['rank'] = array('GT',$organ_rank);
        $map['_complex'] = $where;
        $map['rank']  = array('NOT IN',[3,4]);
        $organ_data = $organ_table
            -> field('id,rank,name,pid')
            -> where($map)
            -> select();
        $this -> dispose_under_organ($organ_data,$organ_id,$organ_rank);
        return $this->primary_school;
    }

    /**
     * 所辖机构整理
     * @param $organ_data 机构信息
     * @param $superior_id 当前机构id
     * @param $rank
     */
    public function dispose_under_organ($organ_data,$superior_id,$rank){
        if($rank != 6){
            foreach($organ_data as $value){
                if($value['pid']==$superior_id){
                    if($value['rank'] == 6){
                        $this -> primary_school['class'][$superior_id][$value['id']] = $value['name'];
                    }elseif($value['rank'] == 5){
                        $this -> primary_school['primary_school'][$superior_id][$value['id']] = $value['name'];
                    }elseif($value['rank'] == 2){
                        $this -> primary_school['school_district'][$value['id']] = $value['name'];
                    }
                    $this -> dispose_under_organ($organ_data,$value['id'],$value['rank']);
                }
            }
        }
    }

}