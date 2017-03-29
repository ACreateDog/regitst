<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/25
 * Time: 13:18
 */
namespace Admin\Model;
use Think\Model;
class EnterModel extends Model{
    Protected $autoCheckFields = false;
    Protected $school_id = null;
    public function _initialize(){
        $this->school_id = session('oid');
        $this->check_id($this->school_id);
    }
    public function check_id($school_id){
        if(empty($school_id)){
            return $this->erroe_msg['UgainId'];
        }
    }

    public function get_pub_indexinfo(){
        $data['fail'] = count($this->get_pubfail());
        $data['adopt'] = count($this->get_pub_adopt_student());
        $data['annals'] = count($this->get_pub_annals_student());
        $data['reginfo'] = count($this->get_pubreginfo());
        $data['schname'] = D('Index')->get_org_name();
        $data['introduction'] = D('Index')->get_org_introduction();
        $data['enter_time'] = D('Index')->get_enter_time();
        return $data;
    }

    protected function select_main($where, $field = ""){
        $field == "" ? $field = 'register.id as register_id,student.name as stu_name,sid,sex,sid_num,original_school,student.address,origin,account,a.name as civil_name,b.name as assign_name,d.name as oname,c.name as cname,d.rank as drank,student.phone as phone,lot_release,civil_status,civil_status,civil_release, pub_status,pub_release':$field;
        $data = M('register')->join('student on student.id = register.sid and student.status = 1')
            ->join('left join organ as a on civil_junior = a.id')
            ->join('left join organ as b on assign_junior = b.id')
            ->join('left join organ as c on student.oid = c.id')
            ->join('left join organ as d on c.pid = d.id')
            ->where($where)
            ->field($field)
            ->select();
        return $data;
    }
    public function get_pub_adopt_student(){
        //读取当前学校id,获取本校已录取学生S
        $where['_string'] = "(pub_junior = $this->school_id and pub_status = 1 and pub_release = 1) or (assign_junior = $this->school_id and register.status = 3)";
        return $this->select_main($where);
    }


    public function get_pub_annals_student(){
        //读取当前学校id,获取本校已拒绝学生
        $where['_string'] = "(pub_junior = $this->school_id and pub_status = 2 and pub_release = 1) or (pub_junior = $this->school_id and register.status = 1)";
        return $this->select_main($where);

    }

    public function get_pubreginfo($type){
        //读取当前学校id,获取所有填报本校的学生
        if($type != null){
            if($type != 2){
                $where['student.origin'] = $type;
            }else{
                $where['register.status'] = 3;
            }
        }
        $where['_string'] = "(`pub_junior` = $this->school_id) or (assign_junior = $this->school_id and register.status = 3)";
        return $this->select_main($where);
    }

    //得到未审批学生
    public function get_pubfail(){
        $where['student.status'] = 1;
        $where['pub_release'] = 0;
        $where['_string'] = "(pub_junior=$this->school_id and civil_release=1 and civil_status=3) or (civil_junior=0 and pub_junior=$this->school_id) or (pub_junior=$this->school_id and civil_release=1 and civil_status=4)";
        return $this->select_main($where);
    }

    //民办首页信息
    public function get_civil_indexinfo(){
        $data['fail'] = count($this->get_civilfail());
        $data['adopt'] = count($this->get_civil_adopt_student());
        $data['annals'] = count($this->get_cicil_annals_student());
        $data['reginfo'] = count($this->get_civilreginfo());
        $data['schname'] = D('Index')->get_org_name();
        $data['introduction'] = D('Index')->get_org_introduction();
        $data['enter_time'] = D('Index')->get_enter_time();
        return $data;
    }
    //返回民办已录学生
    public function get_civil_adopt_student(){
        $where['civil_release'] = 1;
        $where['lot_release'] = 1;
        $where['civil_status'] = 2;
        $where['civil_junior'] = $this->school_id;
        return $this->select_main($where);
    }
    //返回民办未录学生
    public function get_cicil_annals_student(){
        $where['civil_release'] = 1;
        $where['civil_status']= 3;
        $where['lot_release'] = 1;
        $where['civil_junior'] = $this->school_id;
        return $this->select_main($where);

    }

    //报名信息表
    public function get_civilreginfo($type){
        if($type != null){
            $where['student.origin'] = $type;
        }
        $where['civil_junior'] = $this->school_id;
        return $this->select_main($where);
    }

    //得到未审批学生
    public function get_civilfail(){
        $where['civil_junior'] = $this->school_id;
        $where['student.status'] = 1;
        $where['civil_release'] = 0;
        $where['lot_release'] = 1;
        $where['civil_status'] = array('IN',array(1,2,3));
        return $this->select_main($where);

    }
    //设置摇号摇中
    public function set_lot($reid){
        $data = M('register')->where(array('id'=>array('in',$reid)))->save(array('civil_status'=>1));
        if($data !== false){
            return $data;
        }else{
            $data;
        }
    }
    //教育局摇号信息
    public function get_lot_orginfo(){
        $data = M('student')->join('register on student.id = register.sid')
            ->join('organ on civil_junior = organ.id')
            ->where(array('civil_junior'=>array('NEQ','0'),'student.status'=>1))
            ->order('register.lot_release asc,civil_status')
            ->field('register.id as register_id, student.name as stu_name,sid,origin,sex,sid_num,organ.name as sch_name,original_school, student.phone as phone, civil_status, lot_release,civil_release,register.status')
            ->select();
        return $data;
    }
    //导入摇号信息
    function set_import_lot($data){
        $reid = M('student')->where(array('sid_num'=>array('IN',$data)))->field('id')->select();
        foreach($reid as $k=>$vlue){
            foreach($vlue as $v){
                $id[$k] = $v;
            }
        }
        $result = M('register')->where(array('sid'=>array('in',$id),'civil_junior'=>array('NEQ','0')))->save(array('civil_status'=>1));
        return $result;
    }
    //设置摇号未摇中
    public function set_Nlot($reid){
        $data = M('register')->where(array('id'=>array('in',$reid)))->save(array('civil_status'=>4));
        if($data !== false){
            return $data;
        }else{
            return false;
        }

    }
    //摇号信息发布
    public function set_cilil_issued_lot(){
        $model = M('register');
        $model->startTrans();
        $result1 = $model->where(array('civil_status'=>1))->save(array('lot_release'=>1));
        $result2 = $model->where(array('civil_status'=>4))->save(array('lot_release'=>1,'civil_release'=>1));
        if(false !== $result1 && false !== $result2){
            $model->commit();
            return $result1+$result2;
        }else{
            $model->rollback();
            return false;
        }
    }
    //民办录取信息发布
    public function set_civil_issued_admis(){
        $model = M('register');
        $result = $model->where(array('civil_junior'=>$this->school_id,'civil_status'=>array('in','2,3')))->save(array('civil_release'=>1));
        if(false !== $result){
            return $result;
        }else{
            return false;
        }
    }

    //公办录取信息发布
    public function set_pub_issued_admis(){
        $model = M('register');
        $result = $model->where(array('pub_junior'=>$this->school_id,'pub_status'=>array('in','1,2')))->save(array('pub_release'=>1));
        if(false !== $result){
            return $result;
        }else{
            return false;
        }
    }
    //录取
    public function set_civil_admis($reid){
        $model = M('register');
        $model->startTrans();
        M('reject')->where(array('register_id'=>array('in',$reid),'school_id'=>$this->school_id))->delete();
        $result = $model->where(array('id'=>array('in', $reid),'civil_junior'=>$this->school_id))->save(array('civil_status'=>2));
        if(false !== $result){
            $model->commit();
            return $result;
        }else{
            $model->rollback();
            return false;
        }
    }
    public function set_pub_admis($reid){
        $model = M('register');
        $model->startTrans();
        M('reject')->where(array('register_id'=>array('in',$reid),'school_id'=>$this->school_id))->delete();
        $result = $model->where(array('id'=>array('in', $reid),'pub_junior'=>$this->school_id))->save(array('pub_status'=>1));

        if(false !== $result){
            $model->commit();
            return $result;
        }else{
            $model->rollback();
            return false;
        }
    }

    protected function set_Nadmis($reid,$reject_conten,$where,$save){
        $model = M('register');
        $model->startTrans();
        $result = M('reject')->where(array('register_id'=>$reid,'school_id'=>$this->school_id))->delete();
        $result1 = $model->where($where)->save($save);
        $Reject = M("reject");
        $data['register_id'] = $reid;
        $data['school_id'] = $this->school_id;
        $data['reason'] = $reject_conten;
        $data['creattime'] = time();
        $data['updatetime'] = time();
        $result2 = $Reject->add($data);
        if(false !== $result1){
            $model->commit();
            return $result1;
        }else{
            $model->rollback();
            return false;
        }
    }
    //民办不录取
    public function set_civil_Nadmis($reid,$reject_conten){
        $where = array('civil_junior'=>$this->school_id,'id'=>array('in',$reid));
        $save = array('civil_status'=>3);
        return $this->set_Nadmis($reid,$reject_conten,$where,$save);
    }

    public function set_pub_Nadmis($reid,$reject_conten){
        $where = array('pub_junior'=>$this->school_id,'id'=>array('in',$reid));
        $save = array('pub_status'=>2);
        return $this->set_Nadmis($reid,$reject_conten,$where,$save);
    }

    public function set_pub_redistri($reid){
        $model = M('register');
        $model->startTrans();
        $result1 = $model->where(array('pub_junior'=>$this->school_id,'id'=>array('in',$reid)))->save(array('pub_release'=>1,'pub_status'=>2));
        $result2 = $model->where(array('pub_junior'=>$this->school_id,'id'=>array('in',$reid)))->save(array('status'=>2));
        if(false !== $result2 && false !== $result1){
            $model->commit();
            return $result1;
        }else{
            $model->rollback();
            return false;
        }
    }
}