<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 11:37
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{

    //错误类型
    private $error_arr = [
        'verify_error' => ['code' => 0xC011, 'msg' => '验证码输入错误'],
        'empty_data' => ['code' => 0xC021, 'msg' => '无效数据'],
        'account_error' => ['code' => 0xC031, 'msg' => '用户名不存在'],
        'pass_error' => ['code' => 0xC041, 'msg' => '密码错误'],
        'organ_error' =>['code' => 0xC051, 'msg' => '没有此账号对应的机构'],
    ] ;

    /**
     * 登录页
     */
    public function index(){
        if(is_login()){
            $this->redirect('Index/index');
            return;
        }
        $this->display();
    }

    /**
     * 登录
     * @request account 账号
     * @request password 密码
     */
    public function login(){
        if(is_login()){
            //$this->redirect('Index/index');
            return;
        }
        $verify = trim(I('verify'));
        $account  = trim(I('account'));
        $password = trim(I('password'));
        if(!check_verify($verify)){
            return $this->json_response($this->error_arr['verify_error']);
        }
        if(empty($account) || empty($password)){
            return $this->json_response($this->error_arr['empty_data']);
        }
        $user = M('user')->field('id, pass, oid')->where(array('account' => $account, 'status' => 0))->find();
        if($user){
            $org = M('organ')->field('name,rank,pid')->where(array('id' => $user['oid'], 'status' => 0))->find();
            if($org){
                if( $user['pass'] == md5($password) ){
                    session('id', $user['id']);
                    session('oid', $user['oid']);
                    session('account', $account);
                    session('pid', $org['pid']);
                    session('name', $org['name']);
                    session('rank', $org['rank']);
                    // 登录日志
                    \Think\Log::record('Login => user_id :' . $user['id'] . 'name :' . $org['name'] ,'INFO',true);
                    $this->json_response();
                }else{
                    $this->json_response($this->error_arr['pass_error']);
                }
            }else{
                $this->json_response($this->error_arr['organ_error']);
            }
        }else{
            $this->json_response($this->error_arr['account_error']);
        }
    }

    //退出
    public function logout(){
        if(is_login()){
            \Think\Log::record('Logout => user_id :' . session('id') . 'name :' .session('name') ,'INFO', true);
            session(null);
        }
        $this->redirect('Login/index');
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

    private function json_response($data){
        $this->ajaxReturn(array(
            'code' => empty($data['code']) ? 0 : $data['code'],
            'msg' => empty($data['msg']) ? "" : $data['msg'],
            'data' => empty($data['data']) ? "" : $data['data'],
        ));
    }
}