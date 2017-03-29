<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/4/30
 * Time: 13:37
 */

namespace Admin\Model;
use Think\Model;

class OrgModel extends Model
{
    protected $tableName = 'organ';

    /**
     *市教育局信息
     * @param bool $flag 请求是否来自管理者
     * @return mixed
     */
    public function get_city($flag = false){
        if($flag){
            $result = $this->field('organ.id,name,handler,phone,user.account')
                ->join('user on user.oid = organ.id')
                ->where(array('organ.rank'=>1, 'organ.status' => 0, 'user.status' => 0))->find();
        }else{
            $result = $this->field('id,name,handler,phone,address')
                ->where(array('rank'=>1, 'status' => 0))->find();
        }
        return $result;
    }

    /**
     * 小学
     * @param bool $flag 请求是否来自管理者
     * @return mixed
     */
    public function get_primarys($flag = false){
        if($flag){
            $result = $this->alias('a')
                ->field('a.id, a.name, b.name as area, user.account')
                ->join('organ as b on a.pid = b.id')
                ->join('user on user.oid = a.id')
                ->where(array('a.rank' => 5, 'a.status' => 0, 'b.status' => 0, 'user.status' => 0))
                ->select();
        }else{
            $result = $this->alias('a')
                ->field('a.id, a.name, b.name as area, a.handler, a.phone, a.address')
                ->join('organ as b on a.pid = b.id')
                ->where(array('a.rank' => 5, 'a.status' => 0, 'b.status' => 0))
                ->select();
        }
        //$class = $this->field('pid,COUNT(*)')->where(array('rank' => 6, 'status' => 0))->group('pid');
        return $result;
    }

    /**
     * 初中
     * @param bool $flag 请求是否来自管理者
     * @return mixed
     */
    public function get_juniors($flag = false){
        if($flag){
            $result = $this->alias('a')
                ->field('a.id, a.name, b.name as area, a.rank, user.account')
                ->join('organ as b on a.pid = b.id')
                ->join('user on user.oid = a.id')
                ->where(array('a.rank' => array('between','3,4'), 'a.status' => 0, 'b.status' => 0, 'user.status' => 0))
                ->select();
        }else{
            $result = $this->alias('a')
                ->field('a.id, a.name, b.name as area, a.rank, a.handler, a.phone, a.address')
                ->join('organ as b on a.pid = b.id')
                ->where(array('a.rank' => array('between','3,4'), 'a.status' => 0, 'b.status' => 0))
                ->select();
        }
        return $result;
    }

    /**
     * 得到所有区教育局
     * @param bool $flag 请求是否来自管理者
     * @return mixed
     * [  ['id' => , 'name' =>], [] ]
     */
    public function get_areas($flag = false){
        if($flag){
            $result = $this->alias('a')
                ->field('id,name')
                ->where(array('a.rank' => 2, 'a.status' => 0))
                ->select();
        }else{
            $result = $this->alias('a')
                ->field('id,name,handler,phone,address')
                ->where(array('a.rank' => 2, 'a.status' => 0))
                ->select();
        }
        return $result;
    }

    /**
     * 得到所有班级
     * @return mixed
     */
    public function get_classes(){
        $result = $this->alias('a')
            ->field('a.id, a.handler, c.name as area, b.name as school, a.name as name, a.phone, user.account')
            ->join('organ as b on a.pid = b.id')
            ->join('organ as c on b.pid = c.id')
            ->join('user on user.oid = a.id')
            ->where(array('a.rank' => '6', 'a.status' => 0, 'b.status' => 0, 'c.status' => 0, 'user.status' => 0))
            ->select();
        return $result;
    }

    /**
     * 得到所有班级
     * @return mixed
     */
    public function get_primary_class($primary_id){
        $result = $this->alias('a')
            ->field('a.id, a.handler, a.name , a.phone, user.account')
            ->join('user on user.oid = a.id')
            ->where(array('a.rank' => '6', 'a.status' => 0, 'a.pid' => $primary_id, 'user.status' => 0))
            ->select();
        return $result;
    }

    /**
     * 得到本机构的信息
     */
    public function get_organ_info($oid){
        if(empty($oid)){
            $oid = session('oid');
        }

        $result = $this->alias('a')
            ->field('a.name, b.name as parent, a.rank ,a.address, a.handler, a.phone, a.introduction')
            ->join('left join organ as b on a.pid = b.id')
            ->where(array('a.status' => 0, 'a.id' => $oid))
            ->find();
//        echo $this->getLastSql();
        return $result;
    }

    /**
     * 修改本机构的信息
     * @param $data array  数据
     * @return bool 成功与否
     */
    public function update_organ_info($data){
        $data['id'] = session('oid');
        $result = $this->check_field($data);
        if(empty($result)){
            return false;
        }
        $result = $this->save($data);
        if($result === false){
            $this->alert_error('unknown');
            return false;
        }else{
            return true;
        }
    }

    /**
     * 添加区教育局
     * @param $name  机构名称
     * @return bool|mixed  false 失败   string 新id
     */
    public function insert_area($name){
        if(empty($name)){
            $this->error = '名称不合法';
            return  false;
        }
        $time = time();
        $pid = $this->field('id')->where(array('rank' => 1, 'status' => 0))->find();
        if(empty($pid)){
            $this->alert_error('unknown');
            return  false;
        }

        $result = $this->where(array('name' => $name, 'status' => 0, 'rank' => AREA_RANK))->find();
        if($result){
            $this->alert_error('name_exist');
            return false;
        }
        $data = array('name' => $name, 'creattime' =>  $time, 'updatetime' =>  $time, 'pid' => $pid['id'], 'rank' => 2);

        $result = $this->add($data);
        if(!$result){
            $this->error = '操作失败';
        }
        return $result;

    }

    /**
     * 修改教育局名称
     * @param $name  新名称
     * @param $id    机构id
     * @return bool  是否成功
     */
    public function update_area($name, $id){
        $where = array('id' => $id, 'rank' => 2, 'status' => 0);
        $flag = $this->field('id')->where($where)->find();
        if(empty($flag)){
            $this->error = '用户不存在';
            return false;
        }
        if(empty($name)){
            $this->error = '名称不合法';
            return  false;
        }
        $time = time();
        $data = array('name' => $name, 'updatetime' =>  $time);

        $result = $this->where($where)->save($data);
        if($result === false){
            $this->error('操作失败');
        }
        return $result;

    }

    /**
     * 删除一个区教育局
     * @param $id   机构id
     * @return bool 是否成功
     */
    public function delete_area($id){
        $where = array('id' => $id, 'rank' => 2, 'status' => 0);
        $flag = $this->field('id')->where($where)->find();
        if(empty($flag)){
            $this->error = '用户不存在';
            return false;
        }
        $time = time();
        $data = array('updatetime' =>  $time, 'status' => 1);
        $result = $this->where($where)->save($data);
        if($result === false){
            $this->error('操作失败');
        }
        return $result;

    }


    /**
     * 添加新一般机构
     * @param $data 数据
     * name  机构名称
     * pid   上级机构id
     * rank  机构权限
     * account  机构账号
     * @return bool|mixed  false 失败   string 新机构id
     */
    public function insert_org($data){
        $result = $this->check_field($data);
        if(!$result){
            return false;
        }

        $account = $result['account'];
        unset($result['account']);

        $time = time();
        $result['creattime'] = $time;
        $result['updatetime'] = $time;

        $m = M();
        $m->startTrans();
        $oid = $m->table('organ')->add($result);
        if(empty($oid)){
            $this->alert_error('unknown');
            //$this->error = '添加机构失败';
            $m->rollback();
            return  false;
        }
        $uid = $m->table('user')->add(array('account' => $account, 'pass' => getDefualtPass(), 'oid' => $oid, 'creattime' => $time, 'updatetime' => $time));
        if(empty($uid)){
            $this->alert_error('unknown');
           // $this->error = '创建账号失败';
            $m->rollback();
            return  false;
        }
        $m->commit();

        return $oid;
    }


    /**
     * 修改一般机构
     * @param $data
     * id  机构id
     * @return bool|mixed  false 失败   string 新机构id
     */
    public function update_org($data){
        $result = $this->check_field($data);
        if(!$result){
            return false;
        }
        $time = time();
        $account = $result['account'];
        unset($result['account']);

        $m = M();
        $m->startTrans();
        if(!empty($result)){
            $result['updatetime'] = $time;
            $flag = $m->table('organ')->where(array('id' => $data['id'], 'status' => 0))->save($result);
            if($flag === false){
                $this->alert_error('unknown');
                $m->rollback();
                return  false;
            }
        }
        if(!empty($account)){
            $flag = $m->table('user')
                ->where(array('oid' => $data['id'], 'status' => 0))
                ->save(array('account' => $account, 'updatetime' => $time));
            if($flag === false){
                $this->alert_error('unknown');
                $m->rollback();
                return  false;
            }
        }
        $m->commit();

        return true;
    }

    /**
     * 删除一般机构
     * @param $ids
     * @return bool|mixed  false 失败   string 新机构id
     */
    public function delete_org($ids){
        if(empty($ids)){
            $this->alert_error('id_error');
            return  false;
        }
        if(!is_array($ids)){
            $ids = explode(',',$ids);
        }
        $time = time();
        $m = M();
        $m->startTrans();

        $update['updatetime'] = $time;
        $update['status'] = 1;
        $flag = $m->table('organ')->where(array('id' => array('in',$ids), 'status' => 0))->save($update);
        if($flag === false){
            $this->alert_error('unknown');
            $m->rollback();
            return  false;
        }

        $flag = $m->table('user')
            ->where(array('oid' => array('in',$ids), 'status' => 0))
            ->save(array('status' => 1, 'updatetime' => $time));
        if($flag === false){
            $this->alert_error('unknown');
            $m->rollback();
            return  false;
        }

        $m->commit();

        return true;
    }


    /**
     * 批量导入
     * @param $data_list 数据
     * @return boolean 是否成功
     */
    public function import_org($data_list){
        $time = time();
        $count = count($data_list);
        $account_list = [];

        for($i = 0; $i <  $count; $i ++){     //遍历检测错误
            $this->check_field($data_list[$i]);
            if(!$this->check_field($data_list[$i])){
                $this->error['msg'] = ' 第'.($i+2).'行 : ' . $this->error['msg'];  //给出更具体的行错误
                return false;
            }
            $data_list[$i]['creattime'] = $time;
            $data_list[$i]['updatetime'] = $time;
            $account_list[] = array('account' => $data_list[$i]['account']);
            unset($data_list[$i]['account']);     //删除 account
        }
        $m = M();
        $m->startTrans();
        $result = $m->table('organ')->addAll($data_list);
        if(!$result){
            $m->rollback();
            $this->alert_error('unknown');
            return false;
        }

        $oid = $result;    //result为插入的第一条记录的id
        $pass = getDefualtPass();

        for($i = 0; $i <  $count; $i ++){
            $account_list[$i]['oid'] = $oid;
            $account_list[$i]['pass'] = $pass;
            $account_list[$i]['creattime'] = $time;
            $account_list[$i]['updatetime'] = $time;
            $oid ++;
        }

        $result = $m->table('user')->addAll($account_list);
        if(!$result){
            $m->rollback();
            $this->alert_error('unknown');
            return false;
        }
        $m->commit();
        return true;
    }

    //错误类型
    private $error_arr = [
        'empty_data' => ['code' => 0xD001, 'msg' => '没有数据'],
        'unknown' => ['code' => 0xD002, 'msg' => '未知错误'],
        'incomplete_data' => ['code' => 0xD003, 'msg' => '数据不完整'],

        'id_error' => ['code' => 0xD011, 'msg' => '机构不存在'],
        'org_undefined' => ['code' => 0xD012, 'msg' => '机构不存在'],
        'name_error' => ['code' => 0xD021, 'msg' => '名称为 1 - 30 个汉字字母或数字, '],
        'name_exist' => ['code' => 0xD022, 'msg' => '机构已存在'],
        'rank_error' => ['code' => 0xD031, 'msg' => '权限不合法'],
        'rank_beyond' => ['code' => 0xD031, 'msg' => '权限不合法'],
        'parent_rank_beyond' => ['code' => 0xD032, 'msg' => '上级权限不合法'],
        'parent_org_undefined' => ['code' => 0xD033, 'msg' => '上级机构不存在'],
        'account_error' => ['code' => 0xD041, 'msg' => '账号不合法, 4 - 12 位字母数字的组合'],
        'account_exist' => ['code' => 0xD042, 'msg' => '账号已存在'],
        'phone_error' => ['code' => 0xD051, 'msg' => '联系方式格式不正确'],
        'handler_error' => ['code' => 0xD061, 'msg' => '联系人错误'],
        'handler_length_error' => ['code' => 0xD062, 'msg' => '联系人过长 允许最大字符数为 6'],
        'address_length_error' => ['code' => 0xD071, 'msg' => '地址过长 允许最大字符数为 80'],
        'introduction_length_error'=> ['code' => 0xD081, 'msg' => '简介过长 允许最大字符数为 300'],
    ] ;

    /**
     * 检查字段合法性
     * @param $data  需要检查的数据
     * @return bool  是否正确
     */
    private function check_field($data){
        if(empty($data)){
            $this->alert_error('empty_data');
            return false;
        }
        $mark = false;
        $mdata=[];
        if(isset($data['id'])){
            if($data['id'] <= 0){
                $this->alert_error('id_error');
                return false;
            }
            $org = $this->field('id,rank,pid')->where(array('id' => $data['id'], 'status' => 0))->find();
            if(empty($org)){
                $this->alert_error('org_undefined');
                return false;
            }
            //$mdata['id'] = $data['id'];
        }else{   // 添加时必填字段
            if(empty($data['name']) || empty($data['account']) || empty($data['pid']) || empty($data['rank'])){
                $this->alert_error('incomplete_data');
                return false;
            }
        }
        if(isset($data['name'])){
            $mark = true;
            if(empty($data['name']) || !preg_match('/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{1,30}$/u', $data['name']) ){
                $this->alert_error('name_error');
                return false;
            }
            $par = $data['pid'] ? $data['pid'] : $org['pid'];
            $flag = $this->field('id')
                ->where(array('name' => $data['name'], 'pid' => $par ,'status' => 0))
                ->find();
            if(!empty($flag)){
                $this->alert_error('name_exist');
                return  false;
            }
            $mdata['name'] = $data['name'];
        }

        if(isset($data['pid'])){
            $mark = true;
            $parent_org = $this->field('id,rank')->where(array('id' => $data['pid'], 'status' => 0))->find();

            if(empty($parent_org)){
                $this->alert_error('parent_org_undefined');
                return  false;
            }
            if(isset($data['rank'])){   // 添加
                if( $data['rank'] <= 1 || $data['rank'] <=  $parent_org['rank']){
                    $this->alert_error('rank_beyond');
                    return  false;
                }
                $mdata['rank'] = $data['rank'];
            }else{  // 修改
                if( $org['rank'] <=  $parent_org['rank']){
                    $this->alert_error('parent_rank_beyond');
                    return  false;
                }
            }
            $mdata['pid'] = $data['pid'];
        }else{
            if(isset($data['rank'])){   // 公办民办转换
                $mark = true;
                if( $data['rank'] == 3 || $data['rank'] == 4){
                }else{
                    $this->alert_error('rank_error');
                    return  false;
                }
                $mdata['rank'] = $data['rank'];
            }
        }
        if(isset($data['account'])){
            $mark = true;
            if(empty($data['account']) || !preg_match('/^[a-zA-z0-9_]{4,12}$/', $data['account'])){
                $this->alert_error('account_error');
                return false;
            }
            $flag = M('user')->field('id')->where(array('account' => $data['account'], 'status' => 0))->find();
            if(!empty($flag)){
                $this->alert_error('account_exist');
                return  false;
            }
            $mdata['account'] = $data['account'];
        }
        if(isset($data['phone'])){   //可空字段
            $mark = true;
            if(!empty($data['phone'])){
                if(!preg_match('/^1[3|4|5|7|8]\d{9}$/', $data['phone'])){
                    $this->alert_error('phone_error');
                    return false;
                }
            }else{
                $data['phone'] = '';
            }
            $mdata['phone'] = $data['phone'];
        }
        if(isset($data['handler'])){ //可空字段
            $mark = true;
            if(!empty($data['handler'])){

                if(mb_strlen($data['handler'], 'utf8') > 6){
                    $this->alert_error('handler_length_error');
                    return false;
                }

            }else{
                $data['handler'] = '';
            }
            $mdata['handler'] = $data['handler'];
        }
        if(isset($data['address'])){ //可空字段
            $mark = true;
            if(!empty($data['address'])){

                if(mb_strlen($data['address'], 'utf8') > 80){
                    $this->alert_error('address_length_error');
                    return false;
                }

            }else{
                $data['address'] = '';
            }
            $mdata['address'] = $data['address'];
        }

        if(isset($data['introduction'])){ //可空字段
            $mark = true;
            if(!empty($data['introduction'])){

                if(mb_strlen($data['address'], 'utf8') > 3000){
                    $this->alert_error('introduction_length_error');
                    return false;
                }

            }else{
                $data['introduction'] = '';
            }
            $mdata['introduction'] = $data['introduction'];
        }

        if(!$mark){
            $this->alert_error('empty_data');
            return false;
        }

        return $mdata;
    }

    /**
     * 记录错误信息 并计入日志
     * @param $error_type 错误类型
     */
    protected function alert_error($error_type){
        $this->error = $this->error_arr[$error_type];
       // blog($this->error['code'], $this->error['msg']);
    }






}