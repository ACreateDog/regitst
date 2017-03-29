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
    
    <link href="/register_system/Public/staick/FileUpload/css/jquery.fileupload.css" rel="stylesheet">
    <link href="/register_system/Public/staick/FileUpload/css/jquery.fileupload-ui.css" rel="stylesheet">
    <link href="/register_system/Public/admin/student/css/add_info_save.css" rel="stylesheet"/>

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
                    <form>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget radius-bordered">
                                <div class="widget-header bg-blue">
                                    <span class="widget-caption">学生基本信息</span>
                                </div><!--Widget Header-->
                                <div class="widget-body basis_info">
                                    <div class="fileupload-buttonbar tooltip-info" data-toggle="tooltip" data-placement="right" data-original-title="上传学生照片 180*180">
                                        <div class="upload_img thumbnail col-sm-12">
                                            <img id="photo_show" style="width:180px;height:180px;margin-top:10px;margin-bottom:8px;"  src="/register_system/Uploads/<?php echo ($default); echo ($student_info['basis_info']['picture']); ?>" data-holder-rendered="true">
                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="10" aria-valuemax="100" aria-valuenow="0">
                                                <div id="photo_progress" class="progress-bar progress-bar-success" style="width:0%;"></div>
                                            </div>
                                            <div class="caption" align="center">
                                                <span id="photo_upload" class="btn btn-primary fileinput-button">
                                                    <span>上传照片</span>
                                                    <input type="file" id="photo_image" url="<?php echo U('Register/uploadImg');?>" name="photo_image" multiple>
                                                </span>
                                                <a id="photo_cancle" href="javascript:void(0)" class="btn btn-warning" role="button" style="display:none">重新上传</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form_text form-group">
                                        <label for="name" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 学生姓名：</label>
                                        <input type="text" maxlength="20" class="form-control" value="<?php echo ($student_info['basis_info']['name']); ?>" name="name" id="name">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="nation" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 民族：</label>
                                        <input type="text" maxlength="16" class="form-control" value="<?php echo ($student_info['basis_info']['nation']); ?>" name="nation" id="nation">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="birthday" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 生日：</label>
                                        <div class="input-group">
                                            <?php if(empty($student_info['basis_info']['birthday'])): ?><input class="form-control date-picker" name="birthday" id="birthday" type="text" data-date-format="yyyy-mm-dd">
                                            <?php else: ?>
                                                <input class="form-control date-picker" name="birthday" value="<?php echo (date('Y-m-d',$student_info['basis_info']['birthday'])); ?>" id="birthday" type="text" data-date-format="yyyy-mm-dd"><?php endif; ?>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="sex" id="sex" data="<?php echo ($student_info['basis_info']['sex']); ?>" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 性别：</label>
                                        <div class="radio">
                                            <label>
                                                <input name="sex" value="0" class="colored-blue" type="radio">
                                                <span class="text"> 男</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input name="sex" value="1" class="colored-blue" type="radio">
                                                <span class="text"> 女</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="id_num" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 学生身份证号：</label>
                                        <input type="text" maxlength="18" class="form-control" value="<?php echo ($student_info['basis_info']['id_num']); ?>" name="id_num" id="id_num">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="sid_num" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 学生学籍号：</label>
                                        <input type="text" maxlength="20" class="form-control" value="<?php echo ($student_info['basis_info']['sid_num']); ?>" name="sid_num" id="sid_num">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="account" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 户口所在地：</label>
                                        <input type="text" maxlength="50" class="form-control" value="<?php echo ($student_info['basis_info']['account']); ?>" name="account" id="account">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="address" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 家庭住址：</label>
                                        <input type="text" maxlength="40" class="form-control" value="<?php echo ($student_info['basis_info']['address']); ?>" name="address" id="address">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="phone" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 电话：</label>
                                        <input type="tel" class="form-control" value="<?php echo ($student_info['basis_info']['phone']); ?>" name="phone" id="phone">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="email" class="col-sm-1 control-label no-padding-right">邮箱：</label>
                                        <input type="email" class="form-control" value="<?php echo ($student_info['basis_info']['email']); ?>" name="email" id="email">
                                    </div>
                                </div>
                            </div><!--Widget Body-->
                        </div><!--Widget-->
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget radius-bordered">
                                <div class="widget-header bg-blue">
                                    <span class="widget-caption">填报学校</span>
                                </div><!--Widget Header-->
                                <div class="widget-body volunteer">
                                    <div class="form_text form-group">
                                        <label for="pub_junior" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 公办初中填报：</label>
                                        <select id="pub_junior" name="pub_junior" data=<?php echo ($student_info['volunteer']['pub_junior']); ?> class="form-control">
                                            <?php if(is_array($secondary_school['pub_secondary_school'])): foreach($secondary_school['pub_secondary_school'] as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="origin" id="origin" data="<?php echo ($student_info['basis_info']['origin']); ?>" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 生源类型：</label>
                                        <div class="radio">
                                            <label>
                                                <input name="origin" value="0" class="colored-blue" type="radio">
                                                <span class="text"> 学区生</span>
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input name="origin" value="1" class="colored-blue" type="radio">
                                                <span class="text"> 统筹生</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="assign form_text form-group">
                                        <label for="origin" id="assign" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 是否同意调配：</label>
                                        <div class="checkbox">
                                            <label>
                                                <input name="assign" checked class="colored-blue" type="checkbox">
                                                <span class="text"> 同意调配【统筹生必须同意调配】</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="civil_junior" class="col-sm-1 control-label no-padding-right">民办初中填报：</label>
                                        <select id="civil_junior" name="civil_junior" data=<?php echo ($student_info['volunteer']['civil_junior']); ?> class="form-control">
                                            <option value=0>无</option>
                                            <?php if(is_array($secondary_school['civil_secondary_school'])): foreach($secondary_school['civil_secondary_school'] as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget radius-bordered">
                                <div class="widget-header bg-blue">
                                    <span class="widget-caption">房产信息</span>
                                </div><!--Widget Header-->
                                <div class="widget-body house_info">
                                    <div class="form_text form-group">
                                        <label for="house" class="col-sm-1 control-label no-padding-right"><span class='must must_or'>*</span> 房产证编号：</label>
                                        <input type="text" maxlength="50" class="form-control" value="<?php echo ($student_info['basis_info']['house']); ?>" name="house" id="house">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="house_address" class="col-sm-1 control-label no-padding-right"><span class='must must_or'>*</span> 房产地址：</label>
                                        <input type="text" maxlength="40" class="form-control" value="<?php echo ($student_info['basis_info']['house_address']); ?>" name="house_address" id="house_address">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="house_owners" class="col-sm-1 control-label no-padding-right"><span class='must must_or'>*</span> 房产所有人及共有人：</label>
                                        <input type="text" maxlength="50" class="form-control" value="<?php echo ($student_info['basis_info']['house_owners']); ?>" name="house_owners" id="house_owners">
                                    </div>
                                    <div class="form_text form-group">
                                        <label for="house_relations" class="col-sm-1 control-label no-padding-right"><span class='must must_or'>*</span> 房产证户主与孩子关系：</label>
                                        <input type="text" maxlength="40" class="form-control" value="<?php echo ($student_info['basis_info']['house_relations']); ?>" name="house_relations" id="house_relations">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget radius-bordered">
                                <div class="widget-header bg-blue">
                                    <span class="widget-caption">父母及监护人信息【至少填一栏】</span>
                                    <div class="widget-buttons guardian_info_checkbox">
                                        <div class="col-lg-2 col-sm-4 col-xs-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-white" object="father_info">
                                                    <span class="text">父亲信息</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-4 col-xs-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-white" object="mother_info" >
                                                    <span class="text">母亲信息</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-4 col-xs-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="colored-white" object="guardian_info" checked="checked">
                                                    <span class="text">监护人信息</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--Widget Header-->
                                <div class="widget-body duty_info">
                                    <div class="col-lg-12 col-sm-12 col-xs-12 guardian_info">
                                        <div class="widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">监护人信息</span>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label for="guardian_name" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 监护人姓名：</label>
                                                    <input type="text" maxlength="20" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['name']); ?>" name="guardian_name" id="guardian_name">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_relation" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 监护人关系：</label>
                                                    <input type="text" maxlength="10" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['relations']); ?>" name="guardian_relation" id="guardian_relation">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_ID" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 监护人身份证号码：</label>
                                                    <input type="text" maxlength="18" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['id_num']); ?>" name="guardian_ID" id="guardian_ID">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_unit" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 监护人单位：</label>
                                                    <input type="text" maxlength="100" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['workunit']); ?>" name="guardian_unit" id="guardian_unit">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_occupation" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 监护人职业：	</label>
                                                    <input type="text" maxlength="25" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['occupation']); ?>" name="guardian_occupation" id="guardian_occupation">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_tel" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 监护人联系手机：</label>
                                                    <input type="text" maxlength="11" class="form-control" value="<?php echo ($student_info['duty_info']['guardian_info']['phone']); ?>" name="guardian_tel" id="guardian_tel">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12 father_info">
                                        <div class="widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">父亲信息</span>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label for="guardian_name" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 父亲姓名：</label>
                                                    <input type="text" maxlength="20" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['name']); ?>" name="guardian_name" id="guardian_name">
                                                </div>
                                                <!--<div class="form_text form-group" style="display: none;">-->
                                                    <!--<label for="guardian_relation" class="col-sm-1 control-label no-padding-right">父亲关系：</label>-->
                                                    <!--<input type="text" maxlength="40" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['relations']); ?>" name="guardian_relation" id="guardian_relation">-->
                                                <!--</div>-->
                                                <div class="form_text form-group">
                                                    <label for="guardian_ID" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 父亲身份证号码：</label>
                                                    <input type="text" maxlength="18" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['id_num']); ?>" name="guardian_ID" id="guardian_ID">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_unit" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 父亲单位：</label>
                                                    <input type="text" maxlength="100" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['workunit']); ?>" name="guardian_unit" id="guardian_unit">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_occupation" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 父亲职业：</label>
                                                    <input type="text" maxlength="25" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['occupation']); ?>" name="guardian_occupation" id="guardian_occupation">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_tel" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 父亲联系手机：</label>
                                                    <input type="text" maxlength="11" class="form-control" value="<?php echo ($student_info['duty_info']['father_info']['phone']); ?>" name="guardian_tel" id="guardian_tel">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-xs-12 mother_info">
                                        <div class="widget radius-bordered">
                                            <div class="widget-header">
                                                <span class="widget-caption">母亲信息</span>
                                            </div>
                                            <div class="widget-body">
                                                <div class="form_text form-group">
                                                    <label for="guardian_name" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 母亲姓名：</label>
                                                    <input type="text" maxlength="20" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['name']); ?>" name="guardian_name" id="guardian_name">
                                                </div>
                                                <!--<div class="form_text form-group" style="display: none;">-->
                                                    <!--<label for="guardian_relation" class="col-sm-1 control-label no-padding-right">母亲关系：</label>-->
                                                    <!--<input type="text" maxlength="40" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['relations']); ?>" name="guardian_relation" id="guardian_relation">-->
                                                <!--</div>-->
                                                <div class="form_text form-group">
                                                    <label for="guardian_ID" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 母亲身份证号码：</label>
                                                    <input type="text" maxlength="18" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['id_num']); ?>" name="guardian_ID" id="guardian_ID">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_unit" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 母亲单位：</label>
                                                    <input type="text" maxlength="100" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['workunit']); ?>" name="guardian_unit" id="guardian_unit">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_occupation" class="col-sm-1 control-label no-padding-right"><!--<span class='must'>*</span>--> 母亲职业：</label>
                                                    <input type="text" maxlength="25" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['occupation']); ?>" name="guardian_occupation" id="guardian_occupation">
                                                </div>
                                                <div class="form_text form-group">
                                                    <label for="guardian_tel" class="col-sm-1 control-label no-padding-right"><span class='must'>*</span> 母亲联系手机：</label>
                                                    <input type="text" maxlength="11" class="form-control" value="<?php echo ($student_info['duty_info']['mother_info']['phone']); ?>" name="guardian_tel" id="guardian_tel">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="javascript:void(0);" to-url="<?php echo U('Register/student');?>" url="<?php echo U('Register/add_save');?>" student="<?php echo ($student); ?>" class="add_apply btn btn-azure shiny">保存</a>
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
                <label class="col-sm-2 control-label"> 拒绝原因：</label>
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
<script src="/register_system/Public/admin/public/alert_info.js"></script>
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

    <!--Bootstrap Time Picker-->
    <script src="/register_system/Public/assets/js/datetime/bootstrap-datepicker.js"></script>
    <!--FileUpload--->
    <script src="/register_system/Public/staick/FileUpload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/register_system/Public/staick/FileUpload/js/jquery.iframe-transport.js"></script>
    <script src="/register_system/Public/staick/FileUpload/js/jquery.fileupload.js"></script>

    <script src="/register_system/Public/admin/student/js/add_info_save.js"></script>

</body>
</html>