<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- Head -->
<head>
    <meta charset="utf-8" />
    <title><?php echo ($title); ?></title>
    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/register_system/Public/assets/img/favicon.png" type="image/x-icon">

 <!--Basic Styles-->
    <link href="/register_system/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="/register_system/Public/assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/register_system/Public/assets/css/weather-icons.min.css" rel="stylesheet" />

    <!--Fonts-->

    <!--Beyond styles-->
    <link href="/register_system/Public/assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
    <link href="/register_system/Public/assets/css/demo.min.css" rel="stylesheet" />
    <link href="/register_system/Public/assets/css/typicons.min.css" rel="stylesheet" />
    <link href="/register_system/Public/assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />
    
    <style>
        .widget-body{
            padding:15px;
        }
        .col-sm-10{
            padding-left:0px;
        }
        .col-sm-2{
            max-width:100px;
        }
        .form-control{
            width: 50%;;
        }
        textarea.form-control{
            resize: none;
            height: 120px;

        }
        .help-block{
            clear: both;
            margin-left: 10px;
            margin-top: 3px;
            margin-bottom: 0px;
            color: #aaa;
        }
    </style>

    <script src="/register_system/Public/assets/js/skins.min.js"></script>
    <link href="/register_system/Public/assets/css/skins/teal.min.css" rel="stylesheet">
    <style>
        .navbar .navbar-inner .navbar-header .navbar-account .account-area>li .dropdown-menu.dropdown-login-area>li.edit a{
            width: 100%;
            clear: both;
            text-align: right;
        }
    </style>
</head>
<body>
<!---------提示信息模态框------------------>
<style>
    .modal-message{
        z-index: 2000;
    }
</style>
<!--End Email Templates-->
<!--Success Modal Templates-->
<div id="modal-success" class="modal modal-message modal-success fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="glyphicon glyphicon-check"></i>
            </div>
            <div class="modal-title">Success</div>

            <div class="modal-body">You have done great!</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- / .modal-content -->
    </div>
    <!-- / .modal-dialog -->
</div>
<!--End Success Modal Templates-->
<!--Info Modal Templates-->
<div id="modal-info" class="modal modal-message modal-info fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-envelope"></i>
            </div>
            <div class="modal-title">Alert</div>

            <div class="modal-body">You'vd got mail!</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- / .modal-content -->
    </div>
    <!-- / .modal-dialog -->
</div>
<!--End Info Modal Templates-->
<!--Danger Modal Templates-->
<div id="modal-danger" class="modal modal-message modal-danger fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="glyphicon glyphicon-fire"></i>
            </div>
            <div class="modal-title">Alert</div>

            <div class="modal-body">You'vd done bad!</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- / .modal-content -->
    </div>
    <!-- / .modal-dialog -->
</div>
<!--End Danger Modal Templates-->
<!--Danger Modal Templates-->
<div id="modal-warning" class="modal modal-message modal-warning fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-warning"></i>
            </div>
            <div class="modal-title">Warning</div>

            <div class="modal-body">Is something wrong?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- / .modal-content -->
    </div>
    <!-- / .modal-dialog -->
</div>
<!---------------end------------------------->
<div class="loading-container">
    <div class="loading-progress">
        <div class="rotator">
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
        <div class="rotator"></div>
    </div>
</div>
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small style="line-height: 40px; margin-left: 30px;">
                        新乡市小升初管理系统
                    </small>
                </a>
            </div>

            <div class="sidebar-collapse" id="sidebar-collapse" style="left : 0">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown" style="min-width: 100px;padding-left: 70px;">
                                <section style="">
                                    <h2><span class="profile"><span id="org_name_span"><?php echo (session('name')); ?></span></span></h2>
                                </section>
                            </a>
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="edit">
                                    <a href="<?php echo U('User/change_passwd');?>" class="pull-right">修改密码</a>
                                </li>
                                <li class="edit">
                                    <a href="<?php echo U('Login/logout');?>" class="pull-right" id="loginout-a">退出</a>
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
    <div class="page-container">
        <div class="page-sidebar" id="sidebar">
                
                    <ul class="nav sidebar-menu">
                        <?php
 list($first, $last) = explode(' / ',$route); foreach( $nav as $key => $item ){ if($item['name'] == $first){ if(!$item['url']){ echo '<li class="active open">'; }else{ echo '<li class="active">'; } }else{ echo '<li>'; } if($item['url']){ echo '<a href="'.$item['url'].'">'; }else{ echo '<a href="#" class="menu-dropdown">'; } echo '<i class="menu-icon '.$item['ico'].'"></i>'; echo '<span class="menu-text">'.$item['name'].'</span>'; if(!$item['url']){ echo '<i class="menu-expand"></i>'; } echo '</a>'; if(!$item['url']){ echo '<ul class="submenu">'; foreach( $item['children'] as $k => $value ){ if($value['name'] == $last){ echo '<li class="active">'; }else{ echo '<li>'; } echo '<a href="'. $value['url'] .'">'; echo '<span class="menu-text">'.$value['name'].'</span>'; echo '</a></li>'; } echo '</ul>'; } } ?>
                    </ul>
                
        </div>

        <div class="page-content">
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="javascript:void(0)"><?php echo ($route); ?></a>
                    </li>
                </ul>
            </div>
            <div class="page-body">
                
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="widget">
                <div class="widget-header bordered-bottom bordered-blue">
                    <span class="widget-caption">完善信息</span>
                </div>
                <div class="widget-body">
                    <div>
                        <form  class="form-horizontal" action="<?php echo U('Org/update_organ_info');?>">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">机构名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="<?php echo ($info["name"]); ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="parent-org" class="col-sm-2 control-label">所属上级</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="parent-org" value="<?php echo ($info["parent"]); ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">机构地址</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" id="address" maxlength="80" placeholder="机构地址" value="<?php echo ($info["address"]); ?>" data-value="<?php echo ($info["address"]); ?>">
                                    <p class="help-block">字符数不超过80</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="handler" class="col-sm-2 control-label">联系人姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="handler" id="handler" maxlength="10" placeholder="联系人姓名" value="<?php echo ($info["handler"]); ?>" data-value="<?php echo ($info["handler"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label">联系人电话</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="联系人电话" value="<?php echo ($info["phone"]); ?>" data-value="<?php echo ($info["phone"]); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="introduction" class="col-sm-2 control-label">机构简介</label>
                                <div class="col-sm-10">
                                    <textarea type="text" maxlength='300' name="introduction" placeholder="机构简介"
                                              class="form-control"  id="introduction"  data-value="<?php echo ($info["introduction"]); ?>"><?php echo ($info["introduction"]); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label" ></label>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-blue" id="submit-btn">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>


</div>

<script src="/register_system/Public/assets/js/jquery-2.0.3.min.js"></script>
<script src="/register_system/Public/assets/js/bootstrap.min.js"></script>
<script src="/register_system/Public/assets/js/beyond.min.js"></script>
<script src="/register_system/Public/Admin/public/alert_info.js"></script>
<script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
<script>
    $('#loginout-a').on('click',function(e){
        e.preventDefault();
        var that = this;
        bootbox.confirm('您确定退出本系统吗? ', function (result) {
            if (result) {
                window.location.href = $(that).attr('href');
            }
        });
    })
</script>

    <script>
        $('#submit-btn').on('click',function(){
            var form = $(this).parents('form');
            var url = form.attr('action');
            var pdata = {};
            var flag = false;
            form.find('input,textarea').each(function(){
                if(!this.disabled) {
                    if ($(this).attr('data-value') != $(this).val()) {
                        pdata[$(this).attr('name')] = $(this).val();
                        flag = true;
                    }
                }
            })
            if(flag){
                $.post(url,pdata,function(data){
                    if(data.code == 0){
                        alert_info('success','成功', '修改成功');
                    }else{
                        alert_info('warning', '失败', data.msg);
                    }
                });
            }else{
                alert_info('warning', '失败', '没有修改');
            }
        })
    </script>

</body>
</html>