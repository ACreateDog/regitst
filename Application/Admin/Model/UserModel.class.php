<?php
/**
 * Created by PhpStorm.
 * User: 杨亚东1
 * Date: 2016/4/25
 * Time: 21:33
 */

namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    public function get_student_info($where)
    {
        $data_select = [];
        for ($i = 0; $i < 20; $i++) {
            $data_select[$i]['name'] = '亚东' . $i;
            $data_select[$i]['sid_num'] = time() . sprintf("%02d", $i);
            if ($i < 10) {
                $data_select[$i]['school1'] = '铁路初级中学';
                $data_select[$i]['school2'] = '河师大附中金龙学校';
            } else {
                $data_select[$i]['school1'] = '河师大实验中学';
                $data_select[$i]['school2'] = '立人文化学校';
            }
            $data_select[$i]['status'] = $i % 3;
            $data_select[$i]['updatetime'] = time();
        }
        return $data_select;
    }
    /**
     * 添加用户
     * @param $account  用户名
     * @param $oid      新用户对应机构id
     * @return bool|mixed false 失败   string 新用户id
     */
    public function insert_user ($account, $oid){
        if(empty($account) || !preg_match('/^[a-zA-z0-9_]{4,12}$/', $account)){
            $this->error= '账号不合法, 4 - 12 位字母数字的组合';
            return false;
        }
        $flag = M('organ')->field('id')->where(array('status' => 0))->find($oid);
        if(empty($flag)){
            $this->error = '机构不存在';
            return false;
        }
        $flag = $this->field('id')->where(array('account' => $account, 'status' => 0))->find();
        if(!empty($flag)){
            $this->error = '此账号已被占用';
            return false;
        }
        $pass = getDefualtPass();
        $time = time();
        $result = $this->add(array('account' => $account, 'pass' => $pass, 'oid' => $oid, 'creattime' => $time, 'updatetime' => $time));

        if(!$result){
            $this->error = '操作失败';
        }
        return $result;
    }

    /**
     * 修改账户名
     * @param $account  新用户名
     * @param $id       用户id
     * @return bool     是否成功
     */
    public function update_user($account, $id){
        $flag = $this->field('id')->where(array('status' => 0))->find($id);
        if(empty($flag)){
            $this->error = '用户不存在';
            return false;
        }
        if(empty($account) || !preg_match('/^[a-zA-z0-9_]{6,12}$/', $account)){
            $this->error= '账号不合法, 6 - 12 位字母数字的组合';
            return false;
        }
        $flag = $this->field('id')->where(array('account' => $account, 'status' => 0))->find();
        if(!empty($flag)){
            $this->error = '此账号已被占用';
            return false;
        }
        $time = time();
        $result = $this->where(array('id' => $id))->save(array('account' => $account, 'updatetime' => $time));
        if($result === false){
            $this->error = '操作失败';
        }
        return $result;
    }

    /**
     * 删除用户
     * @param $id  用户id
     * @return bool 是否成功
     */
    public function delete_user($id){
        $flag = $this->field('id')->find($id);
        if(empty($flag)){
            $this->error = '用户不存在';
            return false;
        }
        $time = time();
        $result = $this->where(array('id' => $id))->save(array('updatetime' => $time, 'status' => 1));
        if($result === false){
            $this->error = '操作失败';
        }
        return $result;
    }


}