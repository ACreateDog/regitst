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
        .profile-container .profile-header .profile-info .header-information{
            max-height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
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
        .table td{
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .refuse_info_title{
            width: 17%;
        }
        .refuse_info{
            display: inline-block;
            width: 80%;
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
        <div class="col-md-12">
            <div class="profile-container">
                <div class="profile-header row">
                    <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                        <img src="/register_system/Public/assets/img/avatars/mschool.jpg" alt="" class="header-avatar" />
                    </div>
                    <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                        <div class="header-fullname"><?php echo ($data['schname']); ?></div>
                        <div class="header-information">
                            <?php echo ($data['introduction']); ?>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                <div class="stats-value pink"><?php echo ($data['adopt']); ?></div>
                                <div class="stats-title">已录人数</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                <div class="stats-value pink"><?php echo ($data['fail']); ?></div>
                                <div class="stats-title">待审人数</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                <div class="stats-value pink"><?php echo ($data['reginfo']); ?></div>
                                <div class="stats-title">报考人数</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 inlinestats-col">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="glyphicon glyphicon-map-marker"></i>
                                报名截止时间：<?php echo ($enter_time); ?> <?php if(empty($ex_time)): ?>时间已过<?php else: ?>还有 <?php echo ($ex_time); ?> 天<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-body">
                    <div class="col-lg-12">
                        <div class="tabbable">`
                            <div class="tab-content tabs-flat">
                                <div class="databox databox-xxlg databox-inverted databox-vertical databox-shadowed databox-graded">
                                    <div class="databox-top padding-10">
                                        <div id="pie-chart-bandwidth" class="chart chart" style="padding: 0px; position: relative;"><canvas class="flot-base" width="219" height="220" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 219px; height: 220px;"></canvas><canvas class="flot-overlay" width="219" height="220" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 219px; height: 220px;"></canvas></div>
                                        <div class="flot-donut-caption">
                                            <span class="databox-number lightcarbon no-margin"><?php echo ($data['reginfo']); ?></span>
                                            <span class="databox-text sonic-silver  no-margin">报考人数</span>
                                        </div>
                                    </div>
                                    <div class="databox-bottom no-padding bg-white bordered bordered-platinum">
                                        <div class="databox-row row-12 no-padding">
                                            <div class="databox-cell cell-4 no-padding text-align-center bordered-bottom-5 bordered-sky">
                                                <span class="databox-title lightcarbon no-margin"><i class="menu-icon glyphicon glyphicon-thumbs-up"></i></span>
                                                <span class="databox-text sonic-silver  no-margin">已录人数:<?php echo ($data['adopt']); ?></span>
                                            </div>
                                            <div class="databox-cell cell-4 no-padding text-align-center bordered-bottom-5 bordered-yellow">
                                                <span class="databox-title lightcarbon no-margin"><i class="menu-icon glyphicon glyphicon-check"></i></span>
                                                <span class="databox-text sonic-silver  no-margin">待审人数:<?php echo ($data['fail']); ?></span>
                                            </div>
                                            <div class="databox-cell cell-4 no-padding text-align-center bordered-bottom-5 bordered-pink">
                                                <span class="databox-title lightcarbon no-margin"><i class="glyphicon glyphicon-remove"></i></span>
                                                <span class="databox-text sonic-silver no-margin">拒绝人数:<?php echo ($data['annals']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo U('Index/notify_fail');?>" id="notify-info">

            </div>
        </div>
    </div>


</div>

<input type="hidden" id="look_refuse_info" value="<?php echo U('Register/refuse_info');?>"><!--查看拒绝原因路径-->
<div class="modal look_refuse_info_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">拒绝原因</h4>
            </div>
            <div class="modal-body">
                <label class="col-sm-2 control-label refuse_info_title"> 拒绝原因：</label>
                <span class="refuse_info"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="/register_system/Public/assets/js/jquery-2.0.3.min.js"></script>
<script src="/register_system/Public/assets/js/bootstrap.min.js"></script>
<script src="/register_system/Public/assets/js/beyond.min.js"></script>
<script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
<script src="/register_system/Public/admin/public/alert_info.js"></script>
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

    <script src="/register_system/Public/assets/js/charts/flot/jquery.flot.js"></script>
    <script src="/register_system/Public/assets/js/charts/flot/jquery.flot.resize.js"></script>
    <script src="/register_system/Public/assets/js/charts/flot/jquery.flot.pie.js"></script>
    <script src="/register_system/Public/assets/js/charts/flot/jquery.flot.tooltip.js"></script>
    <script src="/register_system/Public/assets/js/charts/flot/jquery.flot.orderBars.js"></script>
    <script>
        var adopt = <?php echo ($data['adopt']); ?>;
        var fail = <?php echo ($data['fail']); ?>;
        var annals = <?php echo ($data['annals']); ?>;
        var data = [
            { data: [[1, adopt]], color: '#11a9cc' },
            { data: [[1, fail]], color: '#ffce55' },
            { data: [[1, annals]], color: '#e75b8d' }
        ];
        var placeholder = $("#pie-chart-bandwidth");
        placeholder.unbind();

        $.plot(placeholder, data, {
            series: {
                pie: {
                    innerRadius: 0.7,
                    show: true,
                    gradient: {
                        radial: true,
                        colors: [
                            { opacity: 1.0 },
                            { opacity: 1.0 },
                            { opacity: 1.0 }
                        ]
                    }
                }
            }
        });
        function notify_info(){
            $.post($('#notify-info').val(),{},function(data){
                if(data.code == 0 && data.data){
                    Notify(data.data, 'top-right', null, 'warning', 'fa-warning', true);
                }
            })
        }
        window.onload = function(){
            // setTimeout(function(){
            notify_info()
            //},3000);
        }
    </script>

</body>
</html>