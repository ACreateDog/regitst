<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/5/8
 * Time: 17:42
 */

namespace Admin\Model;

class IndexModel
{
    private $oid = 0;    // 机构id
    public function __construct()
    {
        $this->oid = session('oid');
    }

    /**
     * 得到 机构名称
     */
    public function get_org_name(){
        $result = M('organ')->field('name')->find($this->oid);
        return $result['name'];
    }

    /**
     * 得到  机构管辖内统筹生的数量
     */
    public function get_overall_num(){
        $oids = $this->get_belong_class();
        if(empty($oids)){
            return 0;
        }
        $result = M('student')
            ->field('count(*) as count')
            ->where(array('origin' => 1, 'status' => 1,'oid' => $oids))
            ->select();
        return $result[0]['count'];
    }

    /**
     * 得到  机构管辖内学区生的数量
     */
    public function get_district_num(){
        $oids = $this->get_belong_class();
        if(empty($oids)){
            return 0;
        }
        $result = M('student')
            ->field('count(*) as count')
            ->where(array('origin' => 0, 'status' => 1, 'oid' => $oids))
            ->select();
        return $result[0]['count'];
    }

    /**
     * 得到系统时间
     */
    public function get_enter_time(){
        $result = M('setting')->field('register_end_time')->find();
        return $result['register_end_time'];
    }

    /**
     * 得到  机构管辖录取的数据
     */
    public function get_enter_data(){
        $where = array('student.status' => 1);
        $where['student.oid'] = $this->get_belong_class();
        $field = 'count(*) as count';
        $join = 'right join student on register.sid = student.id and register.status <> 1';
        if(empty( $where['student.oid'])){
            return array('pub' => 0, 'civil' => 0, 'all' => 0);
        }
        $m = M('register');
        $all = $m
            ->field($field)
            ->join($join)
            ->where($where)
            ->select();
        $map = $where;
        $where['_string'] = '(pub_release = 1 and pub_status= 1) or register.status = 3';
        $pub = $m
            ->field($field)
            ->join($join)
            ->where($where)
            ->select();
        $map['lot_release'] = 1;
        $map['civil_release'] = 1;
        $map['civil_status'] = 2;
        $civil = $m
            ->field($field)
            ->join($join)
            ->where($map)
            ->select();
        return array('pub' => $pub[0]['count'], 'civil' => $civil[0]['count'], 'all' => $all[0]['count']);
    }

    /**
     * 得到属于机构的学生的 oid
     * @return array|int|mixed  [id,...]
     */
    private function get_belong_class(){
        if($this->oids){
            return $this->oids;
        }
        $rank = (int)session('rank');
        $oids = [];
        if(CITY_RANK == $rank){
            $oids = ['GT',0];
        }elseif(AREA_RANK == $rank){
            $result = M('organ as a')
                ->field('group_concat(c.id) as ids')
                ->join('organ as b on b.pid = a.id')
                ->join('organ as c on c.pid = b.id')
                ->where(array('a.id' => $this->oid, 'b.rank' => PRIMARY_RANK, 'c.rank' => CLASS_RANK, 'a.status' => 0, 'b.status' => 0, 'c.status' => 0))
                ->select();
            if(!empty($result[0]['ids'])){
                $oids = ['in',$result[0]['ids'].','. $this->oid];   // 加上机构自己的填报的
            }
        }elseif(PRIMARY_RANK == $rank){
            $result = M('organ as a')
                ->field('group_concat(c.id) as ids')
                ->join('organ as c on c.pid = a.id')
                ->where(array('a.id' => $this->oid, 'c.rank' => CLASS_RANK, 'a.status' => 0, 'c.status' => 0))
                ->select();
            if(!empty($result[0]['ids'])){
                $oids = ['in',$result[0]['ids']];
            }
        }elseif(CLASS_RANK == $rank){
            $oids = $this->oid;
        }
        $this->oids = $oids;
        return $this->oids;
    }

    /**
     * @return string 得到机构的简介
     */
    public function get_org_introduction(){
        $result = M('organ')->field('introduction')->where(array('id' => $this->oid))->find();
        if(empty($result)){
            return '';
        }
        return $result['introduction'];
    }

}