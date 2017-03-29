<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{

    public function _initialize(){}

    public function login()
    {
        $this->display();
    }

    public function logout()
    {
        cookie("SM-Id", null);
        cookie("roleId", null);
        cookie("userName", null);
        cookie("studentId", null);
        redirect("login");
    }

    /*
     * 生成验证码
      */
    public function verify() {
        $config = array(
            'fontSize' => 20,
            'length' => 4,
            'imageH' => 40,
            'imageW' => 180,
            'codeSet' => '0123456789'
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }

    public function dologin()
    {
        $tel = trim(I("t"));  //获取账号
        $pwd = md5(trim(I("p")));  //获取密码
        $code = trim(I("v"));  //获取验证码

        $condition["account"] = $tel;
        $condition["status"] = 0;
        $user = M("user")->where($condition)->select();

//        file_put_contents('D:/aaa.txt', M("user")->getLastSql());

        if (count($user) > 0) {

            $where['sid_num'] = array('eq', $tel);  //设置查询条件
            $where['status'] = array('neq', 2);
            $student = M("student")->where($where)->select();  //查找具体某个学生

            if (count($student) > 0) {
                cookie("userAccount", $user[0]['account']);
                cookie("studentId", $student[0]['id']);  //将学生的 ID 保存，以便以后根据 ID 唯一定位到学生
                cookie("userName", $student[0]['name']);  //将登录的学生名保存到cookie
                cookie("userPicture", $student[0]['picture']);  //将学生的头像存入 cookie
            }
//            cookie("userAccount", $user[0]['account']);
//            cookie("studentId", $student[0]['id']);  //将学生的 ID 保存，以便以后根据 ID 唯一定位到学生
//            cookie("userName", $student[0]['name']);  //将登录的学生名保存到cookie
//            cookie("userPicture", $student[0]['picture']);  //将学生的头像存入 cookie

            //判断密码是否正确
            if ($pwd == $user[0]['pass']) {

                if (check_code($code) === false) {  //判断验证码是否正确
                    $json_str["code"] = 3;
                    $json_str["msg"] = "输入的验证码不正确";
                } else {
                    $json_str["code"] = 0;
//                    $json_str["msg"] = "登录成功";
                    $json_str["msg"] = $user[0]['oid'];
                }

            } else {
                $json_str["code"] = 3;
                $json_str["msg"] = "输入的密码不正确";
            }
        } else {
            $json_str["code"] = 3;
            $json_str["msg"] = "输入的账号不正确";
        }
        $this->ajaxReturn($json_str);

    }

    public function modify()
    {
        $oldPwd = trim(I("oldPwd"));
        $newPwd = trim(I("newPwd"));
        $model = M("user");
        $condition["account"] = cookie("userAccount");
        $user = $model->where($condition)->select();

        if ($user[0]["pass"] != md5($oldPwd)) {
            $json_str["code"] = 1;
            $json_str["msg"] = "原密码输入错误";
        } else {
            $data["pass"] = md5($newPwd);
            $rlt = $model->where($condition)->save($data);
            if ($rlt) {
                $json_str["code"] = 0;
                $json_str["msg"] = "修改成功";
            } else {
                $json_str["code"] = 2;
                $json_str["msg"] = "修改错误，请联系管理员";
            }
        }
        $this->ajaxReturn($json_str);
    }
}