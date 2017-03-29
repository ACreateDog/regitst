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
    
    <link href="/register_system/Public/staick/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <style>
        .pricing-container .plan ul{
            max-width: 150px;
            margin: 20px auto 10px auto;
        }
        .option-lab{

        }
        .option-data{
            font-weight:bold;
            font-size:18px;
        }
        .clear-float{
            clear: both;
        }
        .btn-bar{
            padding: 15px;
        }
        .pricing-container .plan .signup{
            margin : 0;
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
                
    <div class="'row">
        <h5 class="row-title before-themeprimary">时间节点设置</h5>
        <div class="row pricing-container">
            <div class="col-xs-12 col-sm-6 col-md-4 plan-bar">
                <div class="plan">
                    <div class="header bordered-yellow">信息报名</div>
                    <ul>
                        <li  class="option-lab">截止时间</li>
                        <li  class="option-data" data-date="<?php echo ($info_time); ?>" data-for="info-time">
                            <?php if(empty($info_time)): ?>未设置<?php else: echo ($info_time); endif; ?>
                        </li>
                        <div class="clear-float"></div>
                    </ul>
                    <div class="btn-bar">
                        <a class="signup bg-warning" href="#">修改</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 plan-bar">
                <div class="plan">
                    <div class="header bordered-palegreen">民办录取</div>
                    <ul>
                        <li  class="option-lab">截止时间</li>
                        <li  class="option-data" data-date="<?php echo ($civil_time); ?>" data-for="civil-time">
                            <?php if(empty($civil_time)): ?>未设置<?php else: echo ($civil_time); endif; ?>
                        </li>
                        <div class="clear-float"></div>
                    </ul>
                    <div class="btn-bar">
                        <a class="signup bg-warning" href="#">修改</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 plan-bar">
                <div class="plan">
                    <div class="header bordered-orange">公办录取</div>
                    <ul>
                        <li  class="option-lab">截止时间</li>
                        <li  class="option-data" data-date="<?php echo ($pub_time); ?>" data-for="pub-time">
                            <?php if(empty($pub_time)): ?>未设置<?php else: echo ($pub_time); endif; ?>
                        </li>
                        <div class="clear-float"></div>
                    </ul>
                    <div class="btn-bar">
                        <a class="signup bg-warning" href="#">修改</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--hidden input start-->
    <input type="hidden" id="info-time-url" value="<?php echo U('Setting/update_time?type=info');?>"/>
    <input type="hidden" id="pub-time-url" value="<?php echo U('Setting/update_time?type=pub');?>"/>
    <input type="hidden" id="civil-time-url" value="<?php echo U('Setting/update_time?type=civil');?>"/>
    <!--hidden input end-->

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

    <script src="/register_system/Public/staick/bootstrap-datetimepicker.min.js"></script>
    <script>
        var data_picker = '<div class="input-group">'+
                '<input class="form-control date-picker" type="text" data-date-format="yyyy-mm-dd" readonly>'+
                        '</div>';
        var edit_btn = '<a class="signup bg-warning" href="#">修改</a>';
        var send_btn = '<a class="btn btn-blue sure" >确定</a> <a class="btn btn-default cancel" >取消</a>';
        $('.btn-bar').on('click', 'a.signup',function(e){
            e.preventDefault();
            var bar = $(this).parent();
            var startDate = bar.parents('.plan-bar').prev().find('.option-data').data('date');
            if(!startDate){
                startDate = new Date()
            }

            bar.parent().find('.option-data').each(function(){
                var picker = $(data_picker);
                $(this).html(picker);

                picker.find('.date-picker').val($(this).data('date')).datetimepicker({
                    autoclose:true,
                    minView:'month',
                    maxView:'year',
                    pickerPosition: "bottom-right",
                    startDate:startDate
                }).datetimepicker('show');
            });
            bar.html(send_btn);
        });
        $('.btn-bar').on('click', 'a.sure', function(e){
            var bar = $(this).parent();
            bar.parent().find('.option-data').each(function(){
                var new_date = $(this).find('input').val();

                if(new_date == $(this).data('date')){
                    return func();
                }
                var that = this;
                function  func(){
                    $(that).text(new_date);
                    $(that).data('date',new_date);
                    bar.html(edit_btn);
                }

                change_date($(this).data('for'),new_date,func);

            });

        })
        $('.btn-bar').on('click', 'a.cancel', function(e){
            var bar = $(this).parent();
            bar.parent().find('.option-data').each(function(){
                var dd = $(this).data('date');
                $(this).text(dd ? dd : '未设置');
            });
            bar.html(edit_btn);
        })
        function change_date(type,data,fun){
//            return fun();
            var url = $("#"+type+'-url').val();
            $.post(url,{time:data},function(data){
                if(data.code == 0){
                    alert_info('success','成功','设置成功');
                    fun();
                }else{
                    alert_info('warning','失败',data.msg);
                }
            })
        }
    </script>

</body>
</html>