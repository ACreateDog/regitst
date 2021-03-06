<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
Beyond Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3
Version: 1.0.0
Purchase: http://wrapbootstrap.com
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title>新乡市小升初系统-登录页</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!--Basic Styles-->
    <link href="/register_system/Public/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="/register_system/Public/assets/css/beyond.min.css" rel="stylesheet" />
    <link href="/register_system/Public/assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    <style>
        .login-container {
            /* position: relative; */
            margin: 5% auto;
            max-width: 350px;
        }
        .login-container .loginbox {
            width: 350px !important;
            height: 450px!important;
        }
        .loginbox-warning{
            display: none;
            width:100%;
            height: 32px;
            position: relative;
        }
        #warning-msg{
            position: relative;
            display: block;
            line-height:32px;
            color:red;
            text-align: center;
        }
        .login-container .loginbox .loginbox-title{
            height:46px;
            font-size:27px;
            margin:10px 0;
        }
        .reloadverify{
            width: 100%;
            border:1px solid #ddd;
        }
    </style>
</head>
<!--Head Ends-->
<!--Body-->
<body>
<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white">
        <div class="loginbox-title">新乡市小升初</div>
        <div class="loginbox-social"></div>
        <div class="loginbox-or">
            <div class="or-line"></div>
            <div class="or">登录</div>
        </div>
        <div class="loginbox-warning">
            <p id="warning-msg"></p>
        </div>
        <div class="loginbox-textbox">
            <input type="text" class="form-control" id="account" placeholder="账号" />
        </div>
        <div class="loginbox-textbox">
            <input type="password" class="form-control" id="passwd" placeholder="密码" />
        </div>
        <div class="loginbox-textbox">
            <input type="text" class="form-control" id="verify" placeholder="验证码" />
        </div>
        <div class="loginbox-textbox">
            <img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('Login/verify');?>">
        </div>
        <div class="loginbox-forgot">
            <!--<a href="">忘记密码?</a>-->
            <p></p>
        </div>

        <div class="loginbox-submit">
            <input type="button" class="btn btn-primary btn-block" id="submit-btn" value="登录">
        </div>
    </div>
</div>

<input type="hidden" id="login-url" value="<?php echo U('login');?>">
<input type="hidden" id="index-url" value="<?php echo U('Index/index');?>">

<!--Basic Scripts-->
<script src="/register_system/Public/assets/js/jquery-2.0.3.min.js"></script>
<script src="/register_system/Public/assets/js/bootstrap.min.js"></script>
<script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
<script src="/register_system/Public/staick/md5.js"></script>
<!--Extend Scripts-->
<script src="/register_system/Public/admin/login/index.js"></script>
<script>

</script>
</body>
<!--Body Ends-->
</html>