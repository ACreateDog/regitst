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
    
    <link href="/register_system/Public/admin/student/css/student.css" rel="stylesheet"/>

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
        <div class="col-xs-12 col-md-12">
            <div class="widget">
                <div class="widget-header ">
                    <span class="widget-caption"><?php echo ($reminder); ?></span>
                    <!--<div class="widget-buttons">-->
                    <!--<a href="#" data-toggle="maximize">-->
                    <!--<i class="fa fa-expand"></i>-->
                    <!--</a>-->
                    <!--<a href="#" data-toggle="collapse">-->
                    <!--<i class="fa fa-minus"></i>-->
                    <!--</a>-->
                    <!--</div>-->
                </div>
                <div class="widget-body">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget radius-bordered">
                            <div class="widget-header bg-blue">
                                <span class="widget-caption">学生基本信息</span>
                            </div><!--Widget Header-->
                            <div class="widget-body basis_info">
                                <div class="fileupload-buttonbar tooltip-info" data-toggle="tooltip">
                                    <div class="upload_img thumbnail col-sm-12">
                                        <img id="photo_show" style="width:180px;height:180px;margin-top:10px;margin-bottom:8px;"  src="/register_system/Uploads/<?php echo ($default); echo ($student_info['basis_info']['picture']); ?>" data-holder-rendered="true">
                                    </div>
                                    <?php if($student_info['basis_info']['oid'] == session('oid')): ?><div class="reset_pass">
                                            <a href="javascript:void(0);" url="<?php echo U('Register/reset_pass');?>" sid_num="<?php echo ($student_info['basis_info']['sid_num']); ?>" id_num="<?php echo ($student_info['basis_info']['id_num']); ?>" class="reset_pass_btn btn btn-azure shiny">重置密码</a>
                                        </div><?php endif; ?>
                                </div>

                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">学生姓名：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['name']); ?></span>
                                </div>

                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">民族：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['nation']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label for="sex" id="sex" class="col-sm-1 control-label no-padding-right">性别：</label>
                                    <span class="col-sm-8 control-label">
                                        <?php if($student_info['basis_info']['sex'] == 0): ?>男
                                            <?php else: ?>
                                            女<?php endif; ?>
                                    </span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">生日：</label>
                                    <span class="col-sm-8 control-label"><?php echo (date('Y-m-d',$student_info['basis_info']['birthday'])); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label for="origin" id="origin" data="<?php echo ($student_info['basis_info']['origin']); ?>" class="col-sm-1 control-label no-padding-right">生源类型：</label>
                                    <span class="col-sm-8 control-label">
                                        <?php if($student_info['basis_info']['origin'] == 0): ?>学区生
                                            <?php else: ?>
                                            统筹生<?php endif; ?>
                                    </span>
                                </div>
                                <?php if(session('rank') != 6): ?><div class="form_text form-group">
                                        <label id="original_school" data="<?php echo ($student_info['basis_info']['origin']); ?>" class="col-sm-1 control-label no-padding-right">原就读小学：</label>
                                        <span class="col-sm-8 control-label">
                                            <?php if(empty($student_info['basis_info']['school'])): echo ($student_info['basis_info']['original_school']); ?>
                                                <?php else: ?>
                                                <?php echo ($student_info['basis_info']['school']); endif; ?>
                                        </span>
                                    </div><?php endif; ?>
                                <?php if($student_info['basis_info']['status'] != 1): ?><div class="form_text form-group">
                                        <label class="col-sm-1 control-label no-padding-right">志愿学校（民办）：</label>
                                        <span class="col-sm-8 control-label"><?php echo ($student_info['volunteer']['civil_junior_name']); ?></span>
                                    </div>
                                    <div class="form_text form-group">
                                        <label class="col-sm-1 control-label no-padding-right">志愿学校（公办）：</label>
                                        <span class="col-sm-8 control-label"><?php echo ($student_info['volunteer']['pub_junior_name']); ?></span>
                                    </div><?php endif; ?>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">学生身份证号：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['id_num']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">学生学籍号：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['sid_num']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">户口所在地：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['account']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">家庭住址：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['address']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">手机号：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['phone']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">邮箱：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['email']); ?></span>
                                </div>
                            </div>
                        </div><!--Widget Body-->
                    </div><!--Widget-->
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget radius-bordered">
                            <div class="widget-header bg-blue">
                                <span class="widget-caption">房产信息</span>
                            </div><!--Widget Header-->
                            <div class="widget-body house_info">
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">房产证编号：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['house']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">房产地址：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['house_address']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">房产所有人及共有人：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['house_owners']); ?></span>
                                </div>
                                <div class="form_text form-group">
                                    <label class="col-sm-1 control-label no-padding-right">房产证户主与孩子关系：</label>
                                    <span class="col-sm-8 control-label"><?php echo ($student_info['basis_info']['house_relations']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget radius-bordered">
                            <div class="widget-header bg-blue">
                                <span class="widget-caption">父母及监护人信息</span>
                            </div><!--Widget Header-->
                            <div class="widget-body duty_info">
                                <?php if(!empty($student_info['duty_info']['guardian_info'])): ?><div class="col-lg-12 col-sm-12 col-xs-12 guardian_info">
                                        <div class="mother_father_duty widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">监护人信息</span>
                                                <?php if($student_info['basis_info']['oid'] == session('oid')): ?><div class="widget-buttons duty_info_header">
                                                        <a href="javascript:void(0);" object="guardian_info" class="edit_duty_info btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                                        <a href="javascript:void(0);" url="<?php echo U('Register/save_duty_info');?>" object="guardian_info" student="<?php echo ($student_info['duty_info']['guardian_info']['id']); ?>" style="display: none;" class="save_duty_info btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a>
                                                        <a href="javascript:void(0);" style="display: none;" object="guardian_info" class="btn btn-warning btn-xs cancel duty_info_cancel"><i class="fa fa-times"></i> 取消</a>
                                                    </div><?php endif; ?>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人姓名：</label>
                                                    <span name="name" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['name']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人关系：</label>
                                                    <span name="relations" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['relations']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人身份证号码：</label>
                                                    <span name="id_num" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['id_num']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人单位：</label>
                                                    <span name="workunit" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['workunit']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人职业：	</label>
                                                    <span name="occupation" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['occupation']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人联系手机：</label>
                                                    <span name="phone" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['guardian_info']['phone']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php endif; ?>

                                <?php if(!empty($student_info['duty_info']['father_info'])): ?><div class="col-lg-12 col-sm-12 col-xs-12 father_info">
                                        <div class="mother_father_duty widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">父亲信息</span>
                                                <?php if($student_info['basis_info']['oid'] == session('oid')): ?><div class="widget-buttons duty_info_header">
                                                        <a href="javascript:void(0);" object="father_info" class="edit_duty_info btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                                        <a href="javascript:void(0);" url="<?php echo U('Register/save_duty_info');?>" object="father_info" student="<?php echo ($student_info['duty_info']['father_info']['id']); ?>" style="display: none;" class="save_duty_info btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a>
                                                        <a href="javascript:void(0);" style="display: none;" object="father_info" class="btn btn-warning btn-xs cancel duty_info_cancel"><i class="fa fa-times"></i> 取消</a>
                                                    </div><?php endif; ?>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人姓名：</label>
                                                    <span name="name" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['father_info']['name']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人身份证号码：</label>
                                                    <span name="id_num" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['father_info']['id_num']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人单位：</label>
                                                    <span name="workunit" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['father_info']['workunit']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人职业：	</label>
                                                    <span name="occupation" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['father_info']['occupation']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人联系手机：</label>
                                                    <span name="phone" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['father_info']['phone']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php endif; ?>

                                <?php if(!empty($student_info['duty_info']['mother_info'])): ?><div class="col-lg-12 col-sm-12 col-xs-12 mother_info">
                                        <div class="mother_father_duty widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">母亲信息</span>
                                                <?php if($student_info['basis_info']['oid'] == session('oid')): ?><div class="widget-buttons duty_info_header">
                                                        <a href="javascript:void(0);" object="mother_info" class="edit_duty_info btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                                        <a href="javascript:void(0);" url="<?php echo U('Register/save_duty_info');?>" object="mother_info" student="<?php echo ($student_info['duty_info']['mother_info']['id']); ?>" style="display: none;" class="save_duty_info btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a>
                                                        <a href="javascript:void(0);" style="display: none;" object="mother_info" class="btn btn-warning btn-xs cancel duty_info_cancel"><i class="fa fa-times"></i> 取消</a>
                                                    </div><?php endif; ?>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人姓名：</label>
                                                    <span name="name" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['mother_info']['name']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人身份证号码：</label>
                                                    <span name="id_num" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['mother_info']['id_num']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人单位：</label>
                                                    <span name="workunit" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['mother_info']['workunit']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人职业：	</label>
                                                    <span name="occupation" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['mother_info']['occupation']); ?></span>
                                                </div>
                                                <div class="form_text form-group">
                                                    <label class="col-sm-1 control-label no-padding-right">监护人联系手机：</label>
                                                    <span name="phone" class="col-sm-8 text control-label"><?php echo ($student_info['duty_info']['mother_info']['phone']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if($student_info['basis_info']['status'] == 1): ?><div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget radius-bordered">
                                <div class="widget-header bg-blue">
                                    <span class="widget-caption">录取详情</span>
                                </div><!--Widget Header-->
                                <div class="widget-body enroll_info">
                                    <table class="table_data table table-striped table-hover table-bordered" id="student_info">
                                        <thead>
                                        <tr role="row">
                                            <th>序号</th>
                                            <th>学校</th>
                                            <th>公/民(办)</th>
                                            <th>状态</th>
                                            <th>备注</th>
                                        </tr>
                                        </thead>
                                        <tbody class="data_user">
                                        <?php if(is_array($enroll_info)): foreach($enroll_info as $k=>$vo): ?><tr>
                                                <td><?php echo ($k+1); ?></td>
                                                <td><?php echo ($vo["school"]); ?></td>
                                                <td><?php echo ($vo["type"]); ?></td>
                                                <td><?php echo ($vo["status"]); ?></td>
                                                <td><?php echo ($vo["remark"]); ?></td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><?php endif; ?>
                    <?php if($student_info['basis_info']['status'] != 1 and $student_info['basis_info']['oid'] == session('oid')): ?><a href='<?php echo U("Register/save_student_info?student_id=$student");?>' class="edit btn btn-azure shiny">编辑</a>
                        <a href="javascript:void(0);" to-url="<?php echo U('Register/student_info');?>" url="<?php echo U('Register/submit_info');?>" student="<?php echo ($student); ?>" class="submit btn btn-azure shiny">提交</a><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

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

    <script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
    <script src="/register_system/Public/admin/student/js/student.js"></script>

</body>
</html>