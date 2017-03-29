<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东
 * Date: 2016/5/2
 * Time: 10:27
 */

namespace Admin\Model;
use Think\Model;

class StudentModel extends Model{

    /**
     * 获取某个学生基本信息
     * @param $student 学生id
     * @return mixed 学生基本信息
     * @author 杨亚东
     */
    public function get_stundent_basis_info($student){
        $where['s.id']=$student;
//        $where['oid'] = session('oid');
//        $where['oid'] = 1;
        $where['s.status'] = array('neq',2);
        $student_table = M('student as s');
        $student_info = $student_table
            ->field("s.*,o2.name as school")
            ->join("left join organ as o1 on o1.id=s.oid")
            ->join("left join organ as o2 on o2.id=o1.pid")
            ->where($where)
            ->find();
        return $student_info;
    }

    /**
     * 获取所属全部学生部分信息
     * @param $type 查询条件【3：全部，1：已录取，2：已拒绝，0：未提交】或其他
     * @param bool|false $rank 是否为领导（默认不是）
     * @param int $student_type 生源类型【全部：2，学区生：0，统筹生1】
     * @param int $lottery 摇中状态【默认全部：2，未摇中：0，摇中：1，等待摇号：-1】
     * @param int $civil_junior 民办志愿【-1：不查找】
     * @param int $pub_junior 公办志愿【-1：不查找】
     * @return mixed
     */
    public function get_student_all($type,$rank=false,$student_type=2,$lottery=2,$civil_junior=-1,$pub_junior=-1){
        $where = $this->get_where($student_type,$lottery,$type,$rank,$civil_junior,$pub_junior);
        if(empty($where)){
            return false;
        }
        $student_info = M('student as s')
            -> field('a.name as class,a.rank as crank,b.rank as srank,b.name as school,s.original_school,s.id,s.sex,s.name,s.sid_num,s.origin,s.account,s.address,s.status as s_status,s.phone,s.updatetime as s_updatetime,r.updatetime as r_updatetime,r.pub_junior,r.civil_junior,r.pub_status,r.pub_release,r.civil_status,r.civil_release,r.lot_release,r.assign_junior,r.status,r.id as register_id')
            -> join("left join organ as a on s.oid=a.id")
            -> join("left join organ as b on a.pid=b.id")
            -> join('register as r on r.sid=s.id')
            -> where($where)
            -> select();
        return $student_info;
    }

    /**
     * 获取所属全部学生部分信息~~~~查询条件拼接组合
     * @param $student_type 生源类型【全部：2，学区生：0，统筹生1】
     * @param $lottery 摇中状态【默认全部：2，未摇中：0，摇中：1，等待摇号：-1】
     * @param $type 查询条件【3：全部，1：已录取，2：已拒绝，0：未提交】【分配情况：已分配：0，未分配：1】或其他
     * @param $rank 是否为领导（默认不是）
     * @param int $civil_junior 民办志愿
     * @param int $pub_junior 公办志愿
     * @return bool|string
     * @author 杨亚东
     */
    public function get_where($student_type,$lottery,$type,$rank,$civil_junior,$pub_junior){
        if($rank=="lead") {//判断是否是领导（领导）查看所属学生(已提交的)
            $where = 'r.status!=1 and s.status=1 and s.oid in(' . $type . ')';
            if($civil_junior!=-1){
                $where = $where." and r.civil_junior=".$civil_junior;
            }
            if($pub_junior!=-1){
                $where = $where." and r.pub_junior=".$pub_junior;
            }
            if ($student_type != 2) {//学生类型  2（全部），1（统筹生），0（学区生）
                $where = $where . ' and s.origin=' . $student_type;
            }
//            if ($lottery != 2) {//摇中状态  2（全部），0（未摇中），1（摇中），-1（等待摇号）
//                $where = $where . ' and r.lot_release=' . $lottery;
//            }
            if($lottery!=2){//摇中状态  2（全部），0（未摇中），1（摇中），-1（等待摇号）
                $where = $where.' and r.civil_junior!=0';
                if($lottery==1){
                    $where = $where.' and r.lot_release=1 and r.civil_status!=4';
                }elseif($lottery==0){
                    $where = $where.' and r.lot_release=1 and r.civil_release=1 and r.civil_status=4';
                }elseif($lottery==-1){
                    $where = $where.' and r.lot_release=0';
                }
            }
        }elseif($rank=='assign'){//查看学生再分配情况
            $where = 's.status=1';
            if($type == 1){
                $where = $where.' and r.assign_junior!=0 and r.status=3';
            }elseif($type == 0){
                $where = $where.' and r.status=2';
            }else{
                return false;
            }
        }else{//我填报的学生
            $where = 'r.status!=1 and s.status!=2 and s.oid='.session('oid');
//            $where = 'r.status!=2 and s.oid=1';
            if($type == 0){
                $where = $where.' and s.status=0';
            }elseif($type == 1){
                $where = $where.' and ((r.civil_status=2 and r.lot_release=1 and r.civil_release=1) or (r.pub_status=1 and r.pub_release=1) or r.status = 3)';
            }elseif($type == 2){
                $where = $where.' and (r.pub_status=2 and r.pub_release=1 and r.status=0)';
            }elseif($type != 3){
                return false;
            }
        }
        return $where;
    }

}