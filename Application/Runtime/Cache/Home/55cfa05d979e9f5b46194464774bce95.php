<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>
        小升初::学生信息
    </title>
    <meta name="description" content="Dashboard"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="/register_system/Public/assets/img/favicon.png" type="image/x-icon">


    <!--Basic Styles-->
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!--Fonts-->
    <link href="http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300"
          rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="/register_system/Public/assets/css/beyond.min.css" rel="stylesheet" type="text/css"/>
    <link href="/register_system/Public/assets/css/typicons.min.css" rel="stylesheet"/>
    <link href="/register_system/Public/assets/css/animate.min.css" rel="stylesheet"/>

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/register_system/Public/assets/js/skins.min.js"></script>
    <link href="/register_system/Public/assets/css/skins/teal.min.css" rel="stylesheet">
    <link href="/register_system/Public/Home/Base/css/header.css" rel="stylesheet" />
    
    <link href="/register_system/Public/assets/css/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="/register_system/Public/Home/Register/css/guardian_info.css" rel="stylesheet" />

    <style>
        div.dataTables_filter label {
            float: right;
            margin-right: 70px;
        }

        .modal-header {
            border-bottom: 3px solid #03b3b2;
        }

        input[type=checkbox]:checked + .text:before {
            border: 0px;
            background: transparent;
        }

        input[type=checkbox] + .text:before {
            border: 0px;
            color: #03b3b2;
            background: transparent;
        }

        .table-toolbar .dropdown label {
            width: 100%;
            cursor: pointer;
            margin-bottom: 0px;
        }

        .panel-body label {
            padding: 7px;
            border: 1px solid #d5d5d5;
            border-right: 0px;
            margin-top: 1px;
            color: #858585;
            background-color: #f5f5f5;
        }

        .panel-body input {
            padding: 7px;
            border: 1px solid #d5d5d5;
            color: #858585;
            background-color: #fbfbfb;
        }

        .dataTables_empty {
            text-align: center;
        }

        .panel-body .input-group {
            margin-right: 10px;
        }

        .panel-body select {
            -webkit-appearance: none;
            border-radius: 0px;

        }

        .panel-body .input-group-btn {
            left: -18px;
            z-index: 10;
        }

        .input-icon.icon-right > input {
            padding-left: 14px;
        }

        .panel-body .col-lg-2 {
            padding-left: 5px;
            padding-right: 5px;
        }

        .dropdown-menu {
            z-index: 999999;
        }

        .bootbox-confirm .modal-dialog {
            width: 250px;
        }

        .animated {
            -webkit-animation-duration: 0.5s;
            animation-duration: 0.5s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
    </style>
</head>
<body>
<!-- Loading Container -->
<div class="loading-container">
    <div class="loading-progress">
        <!--<div class="rotator">
            <div class="rotator">
                <div class="rotator colored">
                    <div class="rotator">
                        <div class="rotator colored">
                            <div class="rotator colored"></div>
                            <div class="rotator"></div>
                        </div>
                        <div class="rotator colored"></div>
                    </div>
                    <div class="rotator"></div>
                </div>
                <div class="rotator"></div>
            </div>
            <div class="rotator"></div>
        </div>
        <div class="rotator"></div>-->
        <img src="/register_system/Public/assets/img/loading.svg">
    </div>
</div>
<!--  /Loading Container -->
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                        <img src="/register_system/Public/assets/img/logo.png" alt=""/>
                    </small>
                </a>
            </div>
            <!-- Account Area and Settings --->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a href="<?php echo U('Register/register');?>" class="login-area dropdown-toggle" title="报考学校和录取状态">
                                <div class="avatar" title="状态">
                                    <i class="icon fa fa-edit" style="line-height: 30px;"></i>
                                </div>
                                <section>
                                    <h2>
                                        <span class="profile">
                                            <span>报考学校及录取状态</span>
                                        </span>
                                    </h2>
                                </section>
                            </a>
                        </li>
                        <li class>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown" title="学生信息" href="<?php echo U('Register/student_info');?>">
                                <div class="avatar" title="信息">
                                    <i class="icon fa fa-envelope" style="line-height: 30px;"></i>
                                </div>
                                <section>
                                    <h2>
                                        <span class="profile">
                                            <span>基本信息</span>
                                        </span>
                                    </h2>
                                </section>
                            </a>
                            <ul class="zxc pull-right dropdown-menu dropdown-arrow dropdown-messages nav sidebar-menu" style="width: 139.5px;">
                                <li>
                                    <a href="<?php echo U('Register/student_info');?>">
                                        <div class="clearfix">
                                            <span class="pull-left pull-left-env">
                                                <i class="fa fa-smile-o"></i>
                                            </span>
                                            <span class="pull-right pull-right-env">学生信息</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Register/parent_info');?>">
                                        <div class="clearfix">
                                            <span class="pull-left pull-left-env">
                                                <i class="fa fa-heart-o"></i>
                                            </span>
                                            <span class="pull-right pull-right-env" id="pull-right-float">父母信息</span>
                                        </div>
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="/register_system/Home/Register/guardian_info">
                                        <div class="clearfix">
                                            <span class="pull-left pull-left-env">
                                                <i class="fa fa-bell-o"></i>
                                            </span>
                                            <span class="pull-right pull-right-env">监护人</span>
                                        </div>
                                    </a>
                                </li>-->
                            </ul>
                            <!--<span><i class="fa fa-angle-right"></i></span>-->
                        </li>
                        <li style="right: -40px;">
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" style="border-left:0px;" title="点击修改密码或退出系统">
                                    <img src="/register_system/Public/assets/img/avatars/boy.png">
                                </div>
                                <section style="width: 105px;">
                                    <h2><span class="profile"><span>吃吃吃<?php echo ($name); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a></a></li>
                                <li class="email"><a>欢迎来到小升初学生端</a></li>
                                <li>
                                    <div class="avatar-area">
                                        <img src="/register_system/Public/assets/img/avatars/boy.png" class="avatar">
                                        <span class="caption"><?php echo ($name); ?></span>
                                    </div>
                                </li>
                                <li class="dropdown-footer edit">
                                    <a href="#" class="pull-left" id="bootbox-options">修改密码</a>
                                    <a href="<?php echo U('login/logout',null,false);?>" class="pull-right">退出系统</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="main-container container-fluid">
    <!-- Page Container -->
    <div class="page-container">
        <!-- Page Content -->
        <div class="page-content" style="margin-left: 0px;">
            <!-- Page Breadcrumb -->
            <div class="page-breadcrumbs breadcrumbs-fixed" style="width: 100%;left: 0px;">
                <ul class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">小升初学生端</a>
                    </li>
                    
    <li class="active"><?php echo ($type); ?></li>

                </ul>

            </div>
            <!-- /Page Breadcrumb -->

            <!-- Page Body -->
            <div class="page-body" style="margin-top: 40px;">

                
    <div id="type_id" style="height: 1000px;" type_id="<?php echo ($type_id); ?>">
        <!--index-->
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="widget">
                    <div class="widget-header">
                        <span class="widget-caption"><?php echo ($type); ?></span>
                    </div>
                    <div class="widget-body">
                        <div class="btn-group">
                            <a class="btn btn-default">
                                <i class="fa fa-download"></i>
                                下载
                            </a>
                        </div>
                        <div class="mail-container" style="top:12px;">
                            <div class="mail-body" id="clear-mail-body-float">
                                <ul class="mail-list">
                                    <li class="list-item">
                                        <div class="item-sender">
                                            学生姓名：
                                        </div>
                                        <div class="item-subject">
                                            贺某某
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            学生性别：
                                        </div>
                                        <div class="item-subject">
                                            男
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            出生日期：
                                        </div>
                                        <div class="item-subject">
                                            1995年9月23日
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            原就读学校：
                                        </div>
                                        <div class="item-subject">
                                            新乡市红旗区红旗小学
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            学生身份证：
                                        </div>
                                        <div class="item-subject">
                                            410222190312123456
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            学生学籍号：
                                        </div>
                                        <div class="item-subject">
                                            4920857492
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            民族：
                                        </div>
                                        <div class="item-subject">
                                            汉族
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            户口所在地：
                                        </div>
                                        <div class="item-subject">
                                            河南省新乡市卫辉县卫辉村38号
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            户口类型：
                                        </div>
                                        <div class="item-subject">
                                            城镇户口
                                        </div>
                                    </li>
                                    <li class="list-item">
                                        <div class="item-sender">
                                            家庭住址：
                                        </div>
                                        <div class="item-subject">
                                            河南省新乡市卫辉县卫辉村38号
                                        </div>
                                    </li>
                                </ul>
                                <div style="height: 12px;"></div>
                            </div>
                            <div class="mail-sidebar">
                                <img src="/register_system/Public/assets/img/avatars/boy.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="/register_system/index.php/Home/Register" id="url">


            </div>
            <!-- /Page Body -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Container -->
    <!-- Main Container -->

</div>
<div id="myModal" style="display: none">
    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <input type="password" class="form-control"
                       id="oldPwd" placeholder="原密码" required=""/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="newPwd" placeholder="新密码"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="rePwd" placeholder="确认密码"/>
            </div>
            <div class="col-md-8" style="padding-left: 0">
                <div class="alert alert-warning" style="display: none;">
                    <i class="fa-fw fa fa-warning"></i>
                    <span class="msg"></span>
                </div>
            </div>
            <div class="col-md-4" style="text-align: right;padding-right: 0;">
                <div class="form-group" style="height:50px;">
                    <button data-bb-handler="保存" type="button" class="btn btn-primary" onclick="btnSave()">保存
                    </button>
                    <button data-bb-handler="取消" type="button" class="btn btn btn-warning" onclick="btnQuit()">关闭
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!--Beyond Scripts-->
<script src="/register_system/Public/assets/js/beyond.min.js"></script>
<script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
<script src="/register_system/Public/assets/js/validation/bootstrapValidator.js"></script>
<script>
    $(function () {
        $(".has").on("click", function () {
            createCookie("SM-Id", $(this).attr("data"));
        });
        $(".pull-left").on("click", function () {
            createCookie("SM-Id", '999');
        });
        $("#bootbox-options").on('click', function () {
            showDialog();
        });

    });

    function bootMessage(type, message) {
        $("#mdl-" + type).remove();
        var html = $('<div id="mdl-' + type + '" class="modal modal-message modal-' + type + ' animated fadeInDown" style="display: block;opacity:1">' +
                '<div class="modal-dialog">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<i class="glyphicon glyphicon-check"></i>' +
                '</div>' +
                '<div class="modal-title"></div>' +
                '<div class="modal-body">' + message + '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn btn-' + type + '" data-dismiss="modal">确定</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');

        html.find(".btn-" + type).on("click", function () {
            $("#mdl-" + type).addClass("fadeOutUp").on("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $(this).remove();
            });
        })
        $("body").append(html);
        setTimeout(function () {
            $("#mdl-" + type + " .btn-" + type).click();
        }, 2000)
    }
    function btnQuit() {
        $(".bootbox-close-button").click();
        $(".msg").html("");
        $(".alert").fadeOut();
    }
    function btnSave() {
        var oldPwd = $.trim($(".bootbox #oldPwd").val());
        var newPwd = $.trim($(".bootbox #newPwd").val());
        var rePwd = $.trim($(".bootbox #rePwd").val());
        if (oldPwd == "" || newPwd == "" || rePwd == "") {
            $(".msg").html("原密码、新密码、确认密码都不能为空");
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
            return;
        }
        if (newPwd != rePwd) {
            $(".msg").html("新密码和确认密码输入不一致");
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
            return;
        }
        $.post("<?php echo U('login/modify');?>", {oldPwd: oldPwd, newPwd: newPwd}, function (d, s) {
            if (d.code == 0) {
                $(".bootbox #oldPwd").val("");
                $(".bootbox #newPwd").val("");
                $(".bootbox #rePwd").val("");
            }
            $(".msg").html(d.msg);
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
        }, "json");

    }
    function showDialog() {
        bootbox.dialog({
            message: $("#myModal").html(),
            title: "修改密码",
            className: ""
        });
    }
</script>

    <script src="/register_system/Public/assets/js/skins.min.js"></script>


</body>
</html>