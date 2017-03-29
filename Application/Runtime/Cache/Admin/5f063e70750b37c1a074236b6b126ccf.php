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
    
    <link href="/register_system/Public/assets/css/dataTables.bootstrap.css" rel="stylesheet" />
    <style>
        .table-toolbar{
            position:absolute;
            padding:0;
            z-index: 99;
        }
        .user-list{
            table-layout:fixed ;
        }
        .table>tbody>tr>td.details{
            padding: 0;
        }
        a.add{
            display: none;
        }
        .dataTable .details td, .dataTable .details th{
            padding: 8px;
            border-left:1px solid #ddd;
        }
        @media (min-width: 768px){
            .modal-dialog {
                width: 400px;
                margin: 30px auto;
            }
        }
        @media (max-width: 768px){
            .modal-dialog {
                width: 80%;
                margin: 30px auto;
            }
        }
        .dd2-handle{
            width: 70px;
        }
        .dd2-handle+.dd2-content{
            padding-left: 80px;
        }
        .form-inline .form-control{
            width: 100%;
        }
        .simple-table{
            table-layout: fixed;
        }
        #junior-table>thead>tr>th:nth-child(1){
            width: 25%;
        }
        #junior-table>thead>tr>th:nth-child(2){
            width: 15%;
        }
        #junior-table>thead>tr>th:nth-child(3){
            width: 10%;
        }
        #junior-table>thead>tr>th:nth-child(4){
            width: 20%;
        }
        #junior-table>thead>tr>th:nth-child(5){
            width: 30%;
        }
        #primary-table>thead>tr>th:nth-child(1){
            width: 25%;
        }
        #primary-table>thead>tr>th:nth-child(2){
            width: 15%;
        }
        #primary-table>thead>tr>th:nth-child(3){
            width: 20%;
        }
        #primary-table>thead>tr>th:nth-child(4){
            width: 10%;
        }
        #primary-table>thead>tr>th:nth-child(5){
            width: 30%;
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
                
    <?php switch($account_rank): case "1": ?><div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="widget">
                        <div class="widget-header ">
                            <span class="widget-caption">市教育局</span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="maximize">
                                    <i class="fa fa-expand"></i>
                                </a>
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <table class="table table-striped table-hover table-bordered" id="city-table">
                                <thead>
                                <tr>
                                    <th>
                                        名称
                                    </th>
                                    <th>
                                        账号
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr data-id="<?php echo ($city["id"]); ?>">
                                    <td>
                                        <?php echo ($city["name"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($city["account"]); ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                        <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-edit"></i> 重置密码</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><?php break;?>
        <?php case "2": ?><div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="widget">
                        <div class="widget-header ">
                            <span class="widget-caption">区教育局</span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="maximize">
                                    <i class="fa fa-expand"></i>
                                </a>
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="table-toolbar">
                                <a id="editabledatatable_new" href="javascript:void(0);" class="btn btn-default">
                                    添加机构
                                </a>
                            </div>
                            <table class="table table-striped table-hover table-bordered" id="editabledatatable">
                                <thead>
                                <tr>
                                    <th>
                                        名称
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                        <td>
                                            <?php echo ($vo["name"]); ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                            <a href="#" class="btn btn-success btn-xs detail"><i class="fa fa-info"></i> 详情</a>
                                            <a href="#" class="btn btn-success btn-xs add"><i class="fa fa-edit"></i> 添加账号</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><?php break;?>
        <?php case "3": ?><div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="widget">
                        <div class="widget-header ">
                            <span class="widget-caption">初中</span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="maximize">
                                    <i class="fa fa-expand"></i>
                                </a>
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="table-toolbar">
                                <a id="junior-table-new" href="javascript:void(0);" class="btn btn-default">
                                    添加初中
                                </a>
                                <a id="import_excel" href="javascript:void(0);" class="btn btn-default">
                                    <i class="glyphicon glyphicon-log-in"></i>导入
                                </a>
                            </div>
                            <table class="table table-striped table-hover table-bordered simple-table" id="junior-table">
                                <thead>
                                <tr>
                                    <th>
                                        名称
                                    </th>
                                    <th>
                                        区属/市属
                                    </th>
                                    <th>
                                        民办/公办
                                    </th>
                                    <th>
                                        账号
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($junior_list)): $i = 0; $__LIST__ = $junior_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                        <td>
                                            <?php echo ($vo["name"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($vo["area"]); ?>
                                        </td>
                                        <td>
                                            <?php if($vo["rank"] == 3 ): ?>公办
                                                <?php else: ?> 民办<?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo ($vo["account"]); ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                            <a href="#" class="btn btn-success btn-xs detail"><i class="fa fa-info"></i> 详情</a>
                                            <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-trash-o"></i> 重置密码</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <input value="<?php echo U('Org/download_template?type=junior');?>" id="download-template-url" type="hidden">
            <input value="<?php echo U('Org/import_junior');?>" id="import-url" type="hidden"><?php break;?>
        <?php case "4": ?><div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="widget">
                        <div class="widget-header ">
                            <span class="widget-caption">小学</span>
                            <div class="widget-buttons">
                                <a href="#" data-toggle="maximize">
                                    <i class="fa fa-expand"></i>
                                </a>
                                <a href="#" data-toggle="collapse">
                                    <i class="fa fa-minus"></i>
                                </a>

                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="table-toolbar">
                                <a id="primary-table-new" for="primary-table" href="javascript:void(0);" class="btn btn-default simple-table-new">
                                    添加小学
                                </a>
                                <a id="import_excel" href="javascript:void(0);" class="btn btn-default">
                                    <i class="glyphicon glyphicon-log-in"></i>导入
                                </a>
                            </div>
                            <table class="table table-striped table-hover table-bordered simple-table" id="primary-table">
                                <thead>
                                <tr>
                                    <th>
                                        名称
                                    </th>
                                    <th>
                                        区属/市属
                                    </th>
                                    <th>
                                        账号
                                    </th>
                                    <th>
                                        毕业班级数
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($primary_list)): $i = 0; $__LIST__ = $primary_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                        <td>
                                            <?php echo ($vo["name"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($vo["area"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($vo["account"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($vo["class_num"]); ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                            <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                            <a href="#" class="btn btn-success btn-xs detail"><i class="fa fa-info"></i> 详情</a>
                                            <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-trash-o"></i> 重置密码</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <input value="<?php echo U('Org/download_template?type=primary');?>" id="download-template-url" type="hidden">
            <input value="<?php echo U('Org/import_primary');?>" id="import-url" type="hidden"><?php break;?>
        <?php default: ?>默认情况<?php endswitch;?>
    <input value="<?php echo U('User/repass');?>" id="repass-url" type="hidden">
<!--changepass Modal Templates-->
<div id="myModal" style="display:none;">
    <div class="row">
        <div id="horizontal-form">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="user-account" class="col-lg-offset-2 col-xs-offset-1 col-sm-2 col-xs-2 control-label no-padding-right">用户名</label>
                    <div class="col-lg-6 col-md-6  col-sm-8 col-xs-8">
                        <input type="text" class="form-control" name="account" id="user-account" disabled placeholder="account">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-new-passwd" class="col-lg-offset-2 col-xs-offset-1 col-sm-2 col-xs-2 control-label no-padding-right">新密码</label>
                    <div class="col-lg-6 col-md-6  col-sm-8 col-xs-8">
                        <input type="password" class="form-control" id="user-new-passwd">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-re-passwd" class="col-lg-offset-2 col-xs-offset-1 col-sm-2 col-xs-2 control-label no-padding-right">确认密码</label>
                    <div class="col-lg-6 col-md-6  col-sm-8 col-xs-8">
                        <input type="password" class="form-control" id="user-re-passwd">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End changepass Templates-->
<script src="/register_system/Public/staick/md5.js"></script>
<script>
    function changePasswd(account, successfun, cancelfun){
        bootbox.dialog({
            message: $("#myModal").html(),
            title: "重置密码",
            className: "modal-darkorange",
            size: "small",
            buttons: {
                success: {
                    label: "提交",
                    className: "btn-blue",
                    callback: function () {
                        var url = $('#repass-url').val();
                        var pass = $('.modal-darkorange').find('#user-new-passwd').val();
                        var repass = $('.modal-darkorange').find('#user-re-passwd').val();
                        if(repass != pass){
                            alert_info('warning', '错误', '两次输入密码不同');
                            return false;
                        }
                        $.post(url,{account:account, pass:hex_md5(pass)},function(data){
                            if(data.code == 0){
                                alert_info('success', '成功', '密码重置成功');
                                if(successfun) successfun(pass);
                                bootbox.hideAll();
                            }else{
                                alert_info('warning', '错误', data.msg);
                                if(cancelfun) cancelfun(data.msg);
                            }
                        });
                        return false;
                    }
                },
                "取消": {
                    className: "btn",
                    callback: function () {}
                }
            }
        });
        $('.bootbox-body').find('#user-account').val(account);
    }
</script>
    <!--Hidden Input-->
    <input type="hidden" id="get-area-account-url" value="<?php echo U('User/get_area_account');?>" >
    <input type="hidden" id="new-area-url" value="<?php echo U('Org/insert_area');?>" >
    <input type="hidden" id="edit-area-url" value="<?php echo U('Org/update_area');?>" >
    <input type="hidden" id="del-area-url" value="<?php echo U('Org/delete_area');?>" >
    <input type="hidden" id="new-area-account-url" value="<?php echo U('User/insert_user');?>" >
    <input type="hidden" id="edit-area-account-url" value="<?php echo U('User/update_user');?>" >
    <input type="hidden" id="del-area-account-url" value="<?php echo U('User/delete_user');?>" >
    <input type="hidden" id="new-org-url" value="<?php echo U('Org/insert_org');?>" >
    <input type="hidden" id="edit-org-url" value="<?php echo U('Org/update_org');?>" >
    <input type="hidden" id="del-org-url" value="<?php echo U('Org/delete_org');?>" >
    <input value="<?php echo U('Org/get_area_option');?>" id="area-list-url" type="hidden">
    <!--End Hidden Input-->

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

    <script src="/register_system/Public/assets/js/datatable/jquery.dataTables.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/ZeroClipboard.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.tableTools.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/datatables-init.js"></script>
    <script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
    <script>
        var InitiateCityTable = function (){
            return {
                init : function(){
                    var edit_node = '<a href="#" class="btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel"><i class="fa fa-times"></i> 关闭</a>';
                    var cityTable = $('#city-table');
                    var tr = cityTable.find('tbody tr')[0];

                    cityTable.on('click', 'a.edit', function(){
                        var tds = $('>td', tr);
                        var tdata = [];
                        for(var i = 0; i < tds.length; i ++){
                            tdata.push( L_trim(tds[i].innerHTML) );
                        }
                        $(tr).data('tdata', tdata);
                        tds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + tdata[0] + '">';
                        tds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + tdata[1] + '">';
                        tds[2].innerHTML =  edit_node ;
                    });

                    cityTable.on('click', 'a.save', function(){
                        var inputs = $('input', tr);
                        var tds = $('>td',tr);
                        var tdata = $(tr).data('tdata');
                        var pdata = {id:$(tr).data('id'),update:{}};
                        var flag = false;

                        if(tdata[0] != inputs[0].value){
                            pdata.update.name =  inputs[0].value;
                            flag = true;
                        }
                        if(tdata[1] != inputs[1].value){
                            pdata.update.account =  inputs[1].value;
                            flag = true
                        }
                        if(flag){
                            do_post(pdata, function(){
                                tds[0].innerHTML = inputs[0].value;
                                tds[1].innerHTML = inputs[1].value;
                                tds[2].innerHTML = $(tr).data('tdata')[2];
                                $(tr).data('tdata', null);
                            });
                        }else{
                            cityTable.find('a.cancel').click();
                        }
                    });

                    cityTable.on('click', 'a.cancel', function(){
                        var tds = $('>td', tr);
                        var tdata = $(tr).data('tdata');
                        for(var i = 0; i < tds.length; i ++){
                            tds[i].innerHTML = tdata[i];
                        }
                    });

                    function do_post(pdata, suCall, errCall){
                        function succ(){
                            alert_info('success', '成功', '操作成功');
                            if(pdata.update.name){
                                $('#org_name_span').text(pdata.update.name);
                            }
                        }
                        function error(msg){
                            alert_info('warning', '失败', msg ? msg : '操作失败');
                        }
                        changeOrg(pdata,function(){
                            succ();
                            if(suCall)  suCall();
                        },function(msg){
                            error(msg);
                            if(errCall) errCall
                        })
                    }

                    cityTable.on("click", 'a.pass', function (e) {
                        e.preventDefault();
                        var tds = $('>td', tr);
                        changePasswd( L_trim(tds[1].innerHTML) );
                    });
                }
            }
        }();
        var InitiateEditableDataTable = function () {
            return {
                init: function () {

                    var ext_node = '<i class="fa fa-plus-square-o row-details"></i>';

                    /*
                     * Insert a 'details' column to the table
                     */
                    var nCloneTh = document.createElement('th');
                    nCloneTh.className = 'ext-td';
                    var nCloneTd = document.createElement('td');
                    nCloneTd.innerHTML = ext_node;
                    nCloneTd.className = 'ext-td';

                    $('#editabledatatable thead tr').each(function () {
                        this.insertBefore(nCloneTh, this.childNodes[0]);
                    });

                    $('#editabledatatable tbody tr').each(function () {
                        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                    });


                    //Datatable Initiating
                    var oTable = $('#editabledatatable').dataTable({
                        "lengthChange": false,
                        "paging": false,
                        "sPaginationType": "bootstrap",
                        "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
                        "oTableTools": {
                            "aButtons": [
                                // "create"
                            ],
                            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
                        },
                        "language": {
                            "search": "",
                            "sLengthMenu": "_MENU_",
                            "oPaginate": {
                                "sPrevious": "<",
                                "sNext": ">"
                            },
                            "zeroRecords": "没有找到符合条件的记录"
                        },
                        "aoColumns": [
                            { "bSortable": false },
                            null,
                            { "bSortable": false }
                        ],
                        "aaSorting" : [],
                        "infoCallback": function( settings, start, end, max, total, pre ) {
                            return '第 ' + start +" 到 "+ end + ' 行   共' + total + '行';
                        }
                    });

                    var isEditing = null;
                    var isCreating= null;

                    var new_node = '<a href="#" class="btn btn-success btn-xs save"  data-mode="new"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel" data-mode="new"><i class="fa fa-times"></i> 关闭</a>';
                    var edit_node = '<a href="#" class="btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel"><i class="fa fa-times"></i> 关闭</a>';
                    var opera_node= '<a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a> <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a> <a href="#" class="btn btn-success btn-xs detail"><i class="fa fa-info"></i> 详情</a> <a href="#" class="btn btn-success btn-xs add"><i class="fa fa-edit"></i> 添加账号</a>';

                    //Add New Row
                    $('#editabledatatable_new').click(function (e) {
                        e.preventDefault();
                        if(isCreating != null){
                            return;
                        }
                        oTable.api()
                                .column( '1:visible' )
                                .order( 'asc' )
                                .draw();
                        var aiNew = oTable.fnAddData(['','',opera_node]);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        editRow(oTable, nRow, true);
                        isCreating = nRow;
                    });

                    //Edit A Row
                    $('#editabledatatable').on("click", 'a.edit', function (e) {
                        e.preventDefault();

                        var nRow = $(this).parents('tr')[0];

                        if(isCreating !== null && isCreating != nRow){
                            oTable.fnDeleteRow(isCreating);
                            isCreating = null;
                        }else if (isEditing !== null && isEditing != nRow) {
                            restoreRow(oTable, isEditing);
                        }

                        editRow(oTable, nRow);
                        isEditing = nRow;
                    });

                    //Save an Editing Row
                    $('#editabledatatable').on("click", 'a.save', function (e) {
                        e.preventDefault();
                        if ($(this).attr("data-mode") == "new") {
                            saveRow(oTable, isCreating, true);
                            isCreating= null;
                        }else{
                            saveRow(oTable, isEditing);
                            isEditing = null;
                        }
                        //Some Code to Highlight Updated Row
                    });

                    //Delete an Existing Row
                    $('#editabledatatable').on("click", 'a.delete', function (e) {
                        e.preventDefault();

                        var nRow = $(this).parents('tr')[0];
                        var aData = oTable.fnGetData(nRow);

                        bootbox.confirm('确定删除 "'+aData[1]+'" 吗? ', function (result) {
                            if (result) {
                                changeArea($(nRow).data('id'), '', function(){
                                    oTable.fnDeleteRow(nRow);
                                    $('#modal-success').modal('show');
                                },function(info){
                                    alert_info('warning', '错误', info);
                                })
                            }
                        });
                    });

                    //Cancel Editing or Adding a Row
                    $('#editabledatatable').on("click", 'a.cancel', function (e) {
                        e.preventDefault();
                        if ($(this).attr("data-mode") == "new") {
                            restoreRow(oTable, isCreating, true);
                            isCreating = null;
                        } else {
                            restoreRow(oTable, isEditing);
                            isEditing = null;
                        }
                    });

                    /**
                     * 恢复一行
                     * @param oTable datatables 对象
                     * @param nRow 要恢复的行
                     **/
                    function restoreRow(oTable, nRow, isnew) {
                        if(isnew){
                            return oTable.fnDeleteRow(nRow);
                        }
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);

                        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                            oTable.fnUpdate(aData[i], nRow, i, false);
                        }

                       // oTable.fnDraw();
                    }

                    /**
                     * 编辑一行
                     * @param oTable datatables 对象
                     * @param nRow 要编辑的行
                     * @param isnew 是否为新添行
                     **/
                    function editRow(oTable, nRow, isnew) {
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);
                        jqTds[0].innerHTML = '';
                        jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                        if(isnew){
                            jqTds[2].innerHTML = new_node;
                        }else{
                            jqTds[2].innerHTML = edit_node;
                        }
                    }

                    /**
                     * 保存一行的更改
                     * @param oTable datatables 对象
                     * @param nRow 要编辑的行
                     * @param isnew 是否为新添行
                     **/
                    function saveRow(oTable, nRow, isnew) {
                        var jqInputs = $('input', nRow);
                        var aData = oTable.fnGetData(nRow);
                        var name = jqInputs[0].value;
                        if('' == name || typeof name == 'undefined' || aData[1] == name){
                            return restoreRow(oTable, nRow);
                        }
                        function update(){
                            oTable.fnUpdate(name, nRow, 1, false);
                            oTable.fnUpdate(opera_node, nRow, 2, false);
                            oTable.fnDraw();
                        }
                        function error(info){
                            restoreRow(oTable, nRow);
                            alert_info('warning', '错误', info);
                        }
                        if(isnew){
                            changeArea('', name, function(){
                                oTable.fnUpdate(ext_node, nRow, 0, false);
                                $(nRow).data('list',[]);
                                update()
                            },error)
                        }else{
                            changeArea($(nRow).data('id'), name,function(){
                                update();
                            },error)
                        }

                    }

                    /**
                     * post提交改变一区的数据
                     * @param id 区 id
                     * @param name 区名
                     * @suCall 成功回调函数
                     * @errCall 失败回调函数
                     **/
                    function changeArea(id, name, suCall, errCall){
                        if(!id) { // 添加
                            var url = $('#new-area-url').val();
                            var data = {name:name};
                        } else if(name) { // 编辑
                            var url = $('#edit-area-url').val();
                            var data = {id:id, name:name};
                        } else { //删除
                            var url = $('#del-area-url').val();
                            var data = {id:id};
                        }

                        $.post(url, data, function(data){
                            if(data.code == 0){
                                suCall(data.data);
                            }else{
                                if(errCall) errCall(data.msg);
                            }
                        });
                    }

                    $('#editabledatatable').on('click', ' tbody td .row-details', function () {
                        var nTr = $(this).parents('tr')[0];
                        if(isEditing != null && isEditing != nTr){
                            restoreRow(oTable, isEditing);
                        }
                        if(isCreating != null && isCreating != nTr){
                            restoreRow(oTable, isCreating, true);
                        }

                        if (oTable.fnIsOpen(nTr)) {
                            /* This row is already open - close it */
                            $(this).addClass("fa-plus-square-o").removeClass("fa-minus-square-o");
                            oTable.fnClose(nTr);
                            $(nTr).find('.add').hide();
                        }
                        else {
                            /* Open this row */
                            $(this).addClass("fa-minus-square-o").removeClass("fa-plus-square-o");
                            list = $(nTr).data('list');
                            if(!list || list.length < 1){
                                //加载 区教育局的账号, 并保存
                                var url = $('#get-area-account-url').val();
                                $.post(url, {id: $(nTr).data('id')}, function(data){
                                    if(data.code == 0){
                                        $(nTr).data('list',data.data);
                                        ext();
                                    }else{
                                        alert_info('warning', '错误', '加载失败');
                                    }
                                })
                            }else{
                                ext();
                            }
                        }
                        function ext(){
                            oTable.fnOpen(nTr, fnFormatDetails(nTr), 'details');
                            $(nTr).find('.add').show();

                            $(window).resize(function(){
                                $(nTr).next().find('.user-list').css('margin-left',  $('.ext-td ')[0].offsetWidth-1 + 'px')
                                        .find('tbody td:first-child,thead th:first-child').css('width', $('.ext-td ').next()[0].offsetWidth + 'px');
                            }).resize();
                        }
                    });

                    var child_new_node = '<a href="#" class="btn btn-success btn-xs child-save"  data-mode="new"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs child-cancel" data-mode="new"><i class="fa fa-times"></i> 关闭</a>';
                    var child_edit_node = '<a href="#" class="btn btn-success btn-xs child-save"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs child-cancel"><i class="fa fa-times"></i> 关闭</a>';
                    var child_opera_node= '<a href="#" class="btn btn-info btn-xs child-edit"><i class="fa fa-edit"></i> 编辑</a> <a href="#" class="btn btn-danger btn-xs child-delete"><i class="fa fa-trash-o"></i> 删除</a> <a href="#" class="btn btn-warning btn-xs child-pass"><i class="fa fa-trash-o"></i> 重置密码</a>'

                    var child_isCreating = null;
                    var child_isEditing = null;

                    //Add New Row
                    $('#editabledatatable').on('click', '.add', function(e){
                        e.preventDefault();
                        var aNew = document.createElement('tr');
                        aNew.innerHTML = '<td><input type="text" class="form-control input-small"></td><td>'+ child_new_node +'</td>';
                        $(this).parent().parent().next().find('tbody').prepend(aNew);
                        child_isCreating = aNew;
                    })

                    /* Formatting function for row details */
                    function fnFormatDetails(otr) {
                        var data = $(otr).data('list');
                        if(!data){
                            data = [];
                        }
                        var sOut = '<table class="user-list">';
                        sOut += '<thead>';
                        sOut += '<tr><th>账号</th><th>操作</th></tr>';
                        sOut += '</thead>';
                        sOut += '<tbody>';

                        for(var i = 0; i < data.length; i ++){
                            sOut += '<tr data-id = "'+data[i].id+'">';
                            sOut += '<td>'+data[i].account+'</td>';
                            sOut += '<td>'+child_opera_node+'</td>';
                            sOut += '</tr>';
                        }

                        sOut += '</tbody>';
                        sOut += '</table>';

                        var ctable = $(sOut);

                        ctable.on("click", 'a.child-pass', function (e) {
                            e.preventDefault();
                            var nRow = $(this).parents('tr')[0];
                            var aData = getData($(nRow).attr('data-id'));
                            changePasswd(aData,function(){

                            });
                        });
                        ctable.on("click", 'a.child-pass', function (e) {
                            e.preventDefault();
                            var nRow = $(this).parents('tr')[0];
                            var aData = oTable.fnGetData(nRow);
                            changePasswd(aData[0]);
                        });

                        //Edit A Row
                        ctable.on("click", 'a.child-edit', function (e) {
                            e.preventDefault();

                            var nRow = $(this).parents('tr')[0];

                            if(child_isCreating !== null && child_isCreating != nRow){
                                isCreating.remove();
                                isCreating = null;
                            }else if (child_isEditing !== null && child_isEditing != nRow) {
                                restoreRow(child_isEditing);
                            }
                            editRow(nRow);
                            child_isEditing = nRow;
                        });

                        //Save an Editing Row
                        ctable.on("click", 'a.child-save', function (e) {
                            e.preventDefault();
                            if ($(this).attr("data-mode") == "new") {
                                saveRow(child_isCreating, true);
                                child_isCreating= null;
                            }else{
                                saveRow(child_isEditing);
                                child_isEditing = null;
                            }
                            //Some Code to Highlight Updated Row
                        });

                        //Delete an Existing Row
                        ctable.on("click", 'a.child-delete', function (e) {
                            e.preventDefault();

                            var nRow = $(this).parents('tr')[0];
                            var aData = getData($(nRow).attr('data-id'));
                            bootbox.confirm('确定删除 "'+aData+'" 吗? ', function (result) {
                                if (result) {
                                    changeAccount($(nRow).attr('data-id'), '', function(){
                                        nRow.remove();
                                    })
                                }
                            });
                        });

                        //Cancel Editing or Adding a Row
                        ctable.on("click", 'a.child-cancel', function (e) {
                            e.preventDefault();
                            if ($(this).attr("data-mode") == "new") {
                                var nRow = $(this).parents('tr')[0];
                                nRow.remove();
                                child_isCreating = null;
                            } else {
                                restoreRow(child_isEditing);
                                child_isEditing = null;
                            }
                        });

                        function restoreRow(nRow) {
                            var aData = getData($(nRow).attr('data-id'));
                            var jqTds = $('>td', nRow);

                            jqTds[0].innerHTML = aData;
                            jqTds[1].innerHTML = child_opera_node;
                        }

                        function editRow(nRow, isnew) {
                            var jqTds = $('>td', nRow);
                            jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + jqTds[0].innerHTML + '">';
                            if(isnew){
                                jqTds[1].innerHTML = child_new_node;
                            }else{
                                jqTds[1].innerHTML = child_edit_node;
                            }
                        }

                        function saveRow(nRow, isnew) {
                            var jqInputs = $('input', nRow);

                            function addchild(){

                            }

                            if(isnew){
                                changeAccount('', jqInputs[0].value,function(newid){
                                    nRow.children[0].innerHTML =   jqInputs[0].value;
                                    nRow.children[1].innerHTML =   child_opera_node;
                                    $(nRow).attr('data-id',newid);
                                },function(){
                                    nRow.remove();
                                });
                            }else{
                                if(jqInputs[0].value == getData($(nRow).attr('data-id'))){
                                    return restoreRow(nRow);
                                }
                                changeAccount($(nRow).attr('data-id'),  jqInputs[0].value,function(){
                                    nRow.children[0].innerHTML =   jqInputs[0].value;
                                    nRow.children[1].innerHTML =   child_opera_node;
                                },function(){
                                    restoreRow(nRow);
                                });
                            }
                        }

                        function getData(key){
                            for(var i = 0; i < data.length; i ++){
                                if(data[i].id == key){
                                    return data[i].account;
                                }
                            }
                            return false;
                        }

                        function changeAccount(id, name, suCall, errCall){
                            function deleteCall(){
                                for(var i = 0; i < data.length; i ++){
                                    if(data[i].id == id){
                                        data.splice(i,1);
                                        break;
                                    }
                                }
                            }
                            function insertCall(id){
                                var idata = {
                                    id : id,
                                    account : name
                                }
                                data.unshift(idata);
                            }
                            function updateCall(){
                                for(var i = 0; i < data.length; i ++){
                                    if(data[i].id == id){
                                        data[i].account = name;
                                        $(otr).data('list', data);
                                        break;
                                    }
                                }
                            }
                            if(!id) { // 添加
                                var url = $('#new-area-account-url').val();
                                var pdata = {account:name};
                                var fun = insertCall;
                            } else if(name) { // 编辑
                                var url = $('#edit-area-account-url').val();
                                var pdata = {id:id, account:name};
                                var fun = updateCall;
                            } else { //删除
                                var url = $('#del-area-account-url').val();
                                var pdata = {id:id};
                                var fun = deleteCall;
                            }
                            pdata.oid = $(otr).data('id');

                            $.post(url, pdata, function(dd){
                                if(dd.code == 0){
                                    fun(dd.data);
                                    suCall(dd.data);
                                    alert_info('success','成功','操作成功');
                                }else{
                                    if(errCall) errCall(dd.msg);
                                    alert_info('warning','失败',dd.msg);
                                }
                            });
                        }

                        return ctable;
                    }
                }
            };
        }();
        var InitiateSimpleTable = function () {
            return {
                init: function () {
                    var tableElem = $('.simple-table');
                    var oTable = null;
                    //Datatable Initiating
                    var aTable = tableElem.dataTable({
                        "autoWidth": false,
                        "lengthChange": false,
                        "iDisplayLength": 10,
                        "sPaginationType": "bootstrap",
                        "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
                        "oTableTools": {
                            "aButtons": [
                                // "create"
                            ],
                            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
                        },
                        "language": {
                            "search": "",
                            "sLengthMenu": "_MENU_",
                            "oPaginate": {
                                "sPrevious": "<",
                                "sNext": ">"
                            },
                            "zeroRecords": "没有找到符合条件的记录"
                        },
                        "aoColumns": [
                            null,
                            null,
                            null,
                            null,
                            { "bSortable": false }
                        ],
                        "infoCallback": function( settings, start, end, max, total, pre ) {
                            return '第 ' + start +" 到 "+ end + ' 行   共' + total + '行';
                        }
                    });

                    /**
                     * 得到选择区的下拉列表
                     * @param {string} selected 初始选中的
                     * @returns {string} <select>html
                     */
                    function getSelectNode(selected, fun){
                        var select_node = '<select class="form-control" name="area">' ;
                        var url = $('#area-list-url').val();
                        var ap = 0;
                        $.post(url, {}, function(data){
                            if(data.code == 0){
                                var options = '<option value="0">请选择</option>';
                                for(var i = 0; i < data.data.length; i ++){
                                    if(!ap && selected == data.data[i].name){
                                        options += '<option value="'+ data.data[i].id +'" selected>' + data.data[i].name + '</option>';
                                        ap = data.data[i].id;
                                    }else{
                                        options += '<option value="'+ data.data[i].id +'">' + data.data[i].name + '</option>'
                                    }
                                }
                                select_node += options;
                                select_node += '</select>';
                                fun(select_node);
                            }else{
                                alert_info('warning', '错误', data.msg);
                            }
                        })


                        return select_node;
                    }

                    function getRadioNode(select){
                        var radio_node = '<select> class="form-control" name="private">';
                        if(select == '公办'){
                            radio_node += '<option value = "3" selected>公办</option><option value = "4">民办</option>';
                        }else if(select == '公办'){
                            radio_node += '<option value = "3">公办</option><option value = "4" selected>民办</option>';
                        }else{
                            radio_node += '<option value = "3">公办</option><option value = "4">民办</option>';
                        }
                        radio_node += '</select>';
                        return radio_node;
                    }

                    //var new_node = '<a href="#" class="btn btn-success btn-xs save"  data-mode="new"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel" data-mode="new"><i class="fa fa-times"></i> 关闭</a>';
                    var edit_node = '<a href="#" class="btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel"><i class="fa fa-times"></i> 关闭</a>';
                    var opera_node= '<a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a> <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a> <a href="#" class="btn btn-success btn-xs detail"><i class="fa fa-info"></i> 详情</a> <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-edit"></i> 重置密码</a>';
                    function primaryEditData(aData,insert){
                        getSelectNode(aData[1],function (selectNode){
                            insert(
                                    ['<input type="text" class="form-control input-small" value="' + aData[0] + '">',
                                        selectNode,
                                        '<input type="text" class="form-control input-small" value="' + aData[2] + '">',
                                        aData[3],
                                        edit_node]
                            )
                        })
                    }

                    function juniorEditData(aData,insert){
                        getSelectNode(aData[1],function (selectNode){
                            insert(
                                    ['<input type="text" class="form-control input-small" value="' + aData[0] + '">',
                                        selectNode,
                                        getRadioNode(aData[2]),
                                        '<input type="text" class="form-control input-small" value="' + aData[3] + '">',
                                        edit_node]
                            )
                        })
                    }

                    function primaryPostData(oTable, nRow, suCall, errCall){
                        var isnew = false;
                        if(nRow == isCreating(oTable)){
                            isnew = true;
                        }
                        var jqInputs = $('input,select', nRow);
                        var name = jqInputs[0].value;
                        var pid = jqInputs[1].value;
                        var pname = jqInputs.find('option[value='+pid+']').text();
                        var account = jqInputs[2].value;

                        if(isnew){
                            changeOrg({
                                id:'',
                                update:{
                                    name : name,
                                    pid : pid,
                                    rank: 5,
                                    account : account
                                }
                            },suCall,errCall);
                        }else{
                            var aData = oTable.fnGetData(nRow);
                            var update = {};
                            var flag = false;
                            if(name != aData[0]){
                                flag = true;
                                update.name = name;
                            }
                            if(pname != aData[1]){
                                flag = true;
                                update.pid = pid;
                            }
                            if(account != aData[2]){
                                flag = true;
                                update.account = account;
                            }
                            if(flag){
                                changeOrg({
                                    id:$(nRow).data('id'),
                                    update:update
                                },suCall,errCall);
                            }else{
                                tableElem.find('a.cancel').click();
                            }
                        }
                    }

                    function juniorPostData(oTable, nRow, suCall, errCall){
                        var isnew = false;
                        if(nRow == isCreating(oTable)){
                            isnew = true;
                        }
                        var jqInputs = $('input,select', nRow);
                        var name = jqInputs[0].value;
                        var pid = jqInputs[1].value;
                        var pname = L_trim($(jqInputs[1]).find('option[value='+pid+']').text());
                        var rank = jqInputs[2].value;
                        var rname = L_trim($(jqInputs[2]).find('option[value='+rank+']').text());
                        var account = jqInputs[3].value;

                        if(isnew){
                            changeOrg({
                                id:'',
                                update:{
                                    name : name,
                                    pid : pid,
                                    rank: rank,
                                    account : account
                                }
                            },suCall,errCall);
                        }else{
                            var aData = oTable.fnGetData(nRow);
                            var update = {};
                            var flag = false;
                            if(name != aData[0]){
                                flag = true;
                                update.name = name;
                            }
                            if(pname != aData[1]){
                                flag = true;
                                update.pid = pid;
                            }
                            if(rname != aData[2]){
                                flag = true;
                                update.rank = rank;
                            }
                            if(account != aData[3]){
                                flag = true;
                                update.account = account;
                            }
                            if(flag){
                                changeOrg({
                                    id:$(nRow).data('id'),
                                    update:update
                                },suCall,errCall);
                            }else{
                                tableElem.find('a.cancel').click();
                            }
                        }
                    }

                    tableElem.on("click", 'a', function (e) {
                        var fTable = $(this).parents('table');
                        oTable = fTable.dataTable();
                    });

                    tableElem.on("click", 'a.pass', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];
                        var aData = oTable.fnGetData(nRow);
                        if(oTable.is('#junior-table')){
                            changePasswd(aData[3]);
                        }else{
                            changePasswd(aData[2]);
                        }
                    });

                    //Add New Row
                    $('#primary-table-new').click(function(e){
                        e.preventDefault();
                        oTable = $('#primary-table').dataTable();
                        if(isCreating(oTable)){
                            return;
                        }
                        var nRow = addRow(oTable,['','','',0,opera_node]);
                        $(nRow).data('mode','new');
                        oTable.api()
                                .column( '0:visible' )
                                .order( 'asc' )
                                .draw();
                        editRow(oTable, nRow);
                    });

                    $('#junior-table-new').click(function(e){
                        e.preventDefault();
                        oTable = $('#junior-table').dataTable();
                        if(isCreating(oTable)){
                            return;
                        }
                        var nRow = addRow(oTable,['','','','',opera_node]);
                        $(nRow).data('mode','new');
                        editRow(oTable, nRow);
                    });

                    //Edit A Row
                    tableElem.on("click", 'a.edit', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];

                        if(isCreating(oTable)){
                            restoreRow(oTable, isCreating(oTable));
                        }
                        if(isEditing(oTable)){
                            restoreRow(oTable, isEditing(oTable));
                        }
                        editRow(oTable, nRow);
                    });

                    //Delete an Existing Row
                    tableElem.on("click", 'a.delete', function (e) {
                        e.preventDefault();

                        var nRow = $(this).parents('tr')[0];
                        var aData = oTable.fnGetData(nRow);

                        bootbox.confirm('确定删除 "'+aData[0]+'" 吗? ', function (result) {
                            if (result) {
                                oTable.fnDeleteRow(nRow);
                            }
                        });
                    });

                    //Save an Editing Row
                    tableElem.on("click", 'a.save', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];

                        function succ(){
                            alert_info('success', '成功', '操作成功');
                        }
                        function error(msg){
                            alert_info('warning', '失败', msg ? msg : '操作失败');
                        }

                        if(oTable.is('#primary-table')){
                            primaryPostData(oTable, nRow, function($data){
                                succ()
                                saveRow(oTable, nRow, $data);
                            },error);
                        }else{
                            juniorPostData(oTable, nRow, function($data){
                                succ()
                                saveRow(oTable, nRow, $data);
                            },error);
                        }
                        //Some Code to Highlight Updated Row
                    });

                    //Cancel Editing or Adding a Row
                    tableElem.on("click", 'a.cancel', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];
                        restoreRow(oTable, nRow);
                    });

                    function isCreating(oTable){
                        var value = arguments[1];
                        if(typeof value == 'undefined'){
                            return oTable.data('isCreating');
                        }else{
                            return oTable.data('isCreating',value);
                        }
                    }

                    function isEditing(oTable){
                        var value = arguments[1];
                        if(typeof value == 'undefined'){
                            return oTable.data('isEditing');
                        }else{
                            return oTable.data('isEditing',value);
                        }
                    }

                    function addRow(oTable, RowData){
                        var aiNew = oTable.fnAddData(RowData);
                        var at = oTable.fnGetNodes(aiNew[0]);
                        $(at).data('mode', 'new');
                        return at;
                    }

                    function editRow(oTable, nRow) {
                        window.kk = nRow;
                        var aData = oTable.fnGetData(nRow);
                        if(oTable.is('#primary-table')){
                            fun = primaryEditData;
                        }else{
                            fun = juniorEditData;
                        }
                        fun(aData, insert);
                        function insert(ndata){
                            var jqTds = $('>td', nRow);
                            jqTds[0].innerHTML = ndata[0];
                            jqTds[1].innerHTML = ndata[1];
                            jqTds[2].innerHTML = ndata[2];
                            jqTds[3].innerHTML = ndata[3];
                            jqTds[4].innerHTML = ndata[4];
                            if($(nRow).data('mode') == 'new'){
                                isCreating(oTable, nRow);
                            }else{
                                isEditing(oTable, nRow);
                            }
                        }
                    }

                    function saveRow(oTable, nRow, $rid){

                        var jqInputs = $('input,select', nRow);
                        var showData = [];
                        for(var key = 0; key < jqInputs.length; key ++){
                            if(jqInputs[key].nodeName == "SELECT"){
                                showData[key] = $(jqInputs[key]).find('option[value='+jqInputs[key].value+']').text();
                            }else{
                                showData[key] = jqInputs[key].value;
                            }
                            oTable.fnUpdate(showData[key], nRow, key, false);
                        }
                        oTable.fnUpdate(opera_node, nRow, 4, false);
                        oTable.fnDraw();

                        if(nRow == isCreating(oTable)){
                            isCreating(oTable, null);
                            $(nRow).attr('data-id',$rid);
                        }else if(nRow == isEditing(oTable)){
                            isEditing(oTable, null);
                        }

                    }

                    function restoreRow(oTable, nRow) {
                        if(nRow == isCreating(oTable) ){
                            oTable.fnDeleteRow(nRow);
                        }else{
                            var aData = oTable.fnGetData(nRow);
                            var jqTds = $('>td', nRow);

                            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                                oTable.fnUpdate(aData[i], nRow, i, false);
                            }
                        }
                        //oTable.fnDraw();
                    }
                }
            };
        }();

        /**
         * post提交改变一个一般机构的数据
         * @param ndata 修改信息{id, update : {name, pid, rank, account} }
         * @suCall 成功回调函数
         * @errCall 失败回调函数
         **/
        function changeOrg(ndata, suCall, errCall){
            console.log(ndata);
            if(typeof ndata != 'object'){
                errCall('数据不合法');
                return false;
            }
            if(!ndata.id && !ndata.update){
                errCall('数据不合法');
                return false;
            }
            if(!ndata.id) { // 添加
                for(var item in ndata.update){
                    if(ndata.update[item] == ''){
                        errCall('数据不合法');
                        return false;
                    }
                }
                var url = $('#new-org-url').val();
                var pdata = ndata.update;
            } else if(ndata.update) { // 编辑
                var pdata = {id:ndata.id};
                for(var item in ndata.update){
                    if(ndata.update[item]){
                        pdata[item] = ndata.update[item];
                    }
                }
                var url = $('#edit-org-url').val();
            } else { //删除
                var url = $('#del-org-url').val();
                var pdata = {id:ndata.id};
            }

            $.post(url, pdata, function(data){
                if(data.code == 0){
                    suCall(data.data);
                }else{
                    if(errCall) errCall(data.msg);
                }
            });
        }

        InitiateCityTable.init();
        InitiateEditableDataTable.init();
        InitiateSimpleTable.init();
    </script>
    <!--detail Modal Templates-->
<div id="detailModal" style="display:none;">
    <div class="dd dd-draghandle darker">
        <ol class="dd-list">
            <li class="dd-item dd2-item" data-id="13">
                <div class="dd-handle dd2-handle">
                    机构名称
                </div>
                <div class="dd2-content" for="name"></div>
            </li>
            <li class="dd-item dd2-item" data-id="13">
                <div class="dd-handle dd2-handle">
                    机构类型
                </div>
                <div class="dd2-content" for="rank" id="rank"></div>
            </li>

            <li class="dd-item dd2-item" data-id="14">
                <div class="dd-handle dd2-handle">
                    上级机构
                </div>
                <div class="dd2-content" for="parent"></div>
            </li>

            <li class="dd-item dd2-item dd-collapsed">
                <div class="dd-handle dd2-handle">
                    地址
                </div>
                <div class="dd2-content" for="address"></div>
            </li>
            <li class="dd-item dd2-item dd-collapsed">
                <div class="dd-handle dd2-handle">
                    联 系 人
                </div>
                <div class="dd2-content" for="handler"></div>
            </li>
            <li class="dd-item dd2-item dd-collapsed">
                <div class="dd-handle dd2-handle">
                    联系电话
                </div>
                <div class="dd2-content" for="phone"></div>
            </li>
            <li class="dd-item dd2-item dd-collapsed">
                <div class="dd-handle dd2-handle">
                    简介
                </div>
                <div class="dd2-content" for="introduction"></div>
            </li>
        </ol>
    </div>
</div>
<!--End detail Modal Templates-->
<input type="hidden" id="get-org-info-url" value="<?php echo U('Org/get_organ_info');?>" >

<script>
    $('.table').on("click", 'a.detail', function (e) {
        e.preventDefault();
        var oid = $(this).parents('tr').data('id');
        var url = $('#get-org-info-url').val();
        $.post(url,{oid:oid},function(data){
            bootbox.dialog({
                message: $("#detailModal").html(),
                title: "机构详情",
                className: "modal-primary",
                buttons: {
                    success: {
                        label: "确定",
                        className: "btn-blue",
                        callback: function () {}
                    },
                }
            });
            $('.modal-primary').find('.dd2-content').each(function(){
                var val = data.data[$(this).attr('for')]
                $(this).text( val ? val : '无');
            })
            var org_type = '';
            switch (L_trim($('.modal-primary #rank').text())){
                case '1' : org_type = '市教育局';break;
                case '2' : org_type = '区教育局';break;
                case '3' : org_type = '公办初中';break;
                case '4' : org_type = '民办初中';break;
                case '5' : org_type = '小学';break;
            }
            $('.modal-primary #rank').text(org_type);

        })
    });
</script>
    <style>
    .modal-darkorange .import-btn{
        cursor: pointer;
        /*margin-bottom: 10px;*/
    }
    .modal-darkorange .file-bar{
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    .modal-darkorange p{
        color:#777;
    }

</style>
<!--import Modal Templates-->
<div id="import-modal" style="display:none;">
    <input type="file" name="import" class="import-submit" style="display: none">
    <a class="import-btn">上传文件</a>
    <div class="file-bar"></div>
    <p>请上传规定格式的Excel文件,<a id="download-template">下载模板</a></p>
</div>
<!--End import Modal Templates-->
<script>
    $(document).on('click','a.import-btn',function(e){
        e.preventDefault();
        $('.modal-darkorange .import-submit').click();
    })
    $(document).on('change','.import-submit',function(e){
        $(this).siblings('.file-bar').text(this.files[0].name);
    })
    $('#import_excel').on('click',function(e){
        e.preventDefault();
        bootbox.dialog({
            message: $("#import-modal").html(),
            title: "导入文件",
            className: "modal-darkorange",
            buttons: {
                success: {
                    label: "导入",
                    className: "btn-blue",
                    callback: function () {
                        var formdata = new FormData ();
                        var url = $('#import-url').val();
                        formdata.append('import_file',$('.modal-darkorange .import-submit')[0].files[0]);
                        $.ajax({
                            url :url,
                            type: 'post',
                            data:formdata,
                            cache: false,
                            processData:false,
                            contentType:false,
                            success:function(data){
                                if(data.code == 0){
                                    alert_info('success','成功', '导入成功',true);
                                }else{
                                    alert_info('warning','失败',data.msg);
                                }
                                return false;
                            }
                        })
                    }
                },
                "取消": {
                    className: "btn",
                    callback: function () {}
                }
            }
        });
        $('.modal-darkorange').find('#download-template').attr('href',$('#download-template-url').val());
    })
</script>

</body>
</html>