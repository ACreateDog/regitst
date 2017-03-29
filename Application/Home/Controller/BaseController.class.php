<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        //判断用户是否登录
        if (cookie("studentId") == "" || cookie("studentId") == null) {
            $this->redirect("Home/login/login");
        }

        $this->assign("userPicture", cookie("userPicture"));
        $this->assign("name", cookie("userName"));
    }

    /*function  getId()
    {
        $tel['tel'] = $_COOKIE['userId'];
        if ($tel == "") {
            return;
        }
        $user = M("user_info")->field("Id")->where($tel)->select(); //获取获取用户Id和工作类型
        return $user[0]['Id'];
    }*/
}