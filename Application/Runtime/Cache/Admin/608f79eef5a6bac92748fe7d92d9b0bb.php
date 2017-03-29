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
    
    <link href="/register_system/Public/assets/css/dataTables.bootstrap.css" rel="stylesheet"/>
    <link href="/register_system/Public/admin/student/css/student_info.css" rel="stylesheet"/>

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
                    <span where=<?php echo ($where); ?> class="widget-caption"><?php echo ($reminder); ?></span>
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
                        <div class="panel-group accordion" id="accordion" style="margin-bottom: 8px;">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                                           data-parent="#accordion"
                                           href="#collapseOne">
                                            <i class="fa fa-search"></i> 高级搜索
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <label>事务类型</label>
                                        <select  id="grasp_degree">
                                            <option value="3">全部</option>
                                            <option value="1">已录取</option>
                                            <option value="2">已拒绝</option>
                                            <option value="0">信息未提交</option>
                                        </select>
                                        <button id="seek" type="button" class="btn btn-primary" style="padding: 7px; margin-top: -3px;">
                                            <i class="fa fa-search"></i>搜索
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-toolbar operation">
                        <?php if($where != 0): ?><div class="btn-group">
                                <a type="button" id="export" class="btn btn-default" href="<?php echo U('Register/export_excel');?>?name=<?php echo ($reminder); ?>">
                                    <i class="fa fa-download"></i>导出
                                </a>
                            </div><?php endif; ?>
                        <div class="btn-group">
                            <a type="button" class="btn btn-default" href="<?php echo U('Register/add_student_info');?>">
                                <i class=""></i>添加学生信息
                            </a>
                        </div>
                        <?php if((!empty($student_info)) and ($where == 0)): ?><div class="btn-group">
                                <a type="button" id="issue" class="btn btn-default" url="<?php echo U('Register/submit_info');?>">
                                    <i class="glyphicon glyphicon-volume-up"></i>立即提交
                                </a>
                            </div><?php endif; ?>
                    </div>

                    <table class="table_data table table-striped table-hover table-bordered" id="student_info">
                        <thead>
                        <tr role="row">
                        <?php if($where == 0): ?><th>
                        <?php else: ?>
                            <th style="display: none"><?php endif; ?>
                                <label>
                                    <input id="checked_all" type="checkbox">
                                    <span class="text"></span>
                                </label>
                            </th>
                            <th>学生姓名</th>
                            <th>性别</th>
                            <th>学生学籍</th>
                            <th>生源类型</th>
                            <th>志愿学校(民办)</th>
                            <th>志愿学校(公办)</th>
                            <!--<th>所属学校</th>-->
                            <!--<th>所属班级</th>-->
                            <?php if($where == 0): ?><th style="display: none;">录取状态(民办)</th>
                                <th style="display: none;">录取状态(公办)</th>
                                <th style="display: none;">再分配情况</th>
                                <th style="display: none;">最终去向</th>
                                <th style="display: none;">操作</th>
                            <?php elseif($where == 1): ?>
                                <th>录取状态(民办)</th>
                                <th>录取状态(公办)</th>
                                <th>再分配情况</th>
                                <th>最终去向</th>
                                <th style="display: none;">操作</th>
                            <?php elseif($where == 2): ?>
                                <th>录取状态(民办)</th>
                                <th>录取状态(公办)</th>
                                <th>再分配情况</th>
                                <th style="display: none;">最终去向</th>
                                <th>操作</th>
                            <?php elseif($where == 3): ?>
                                <th>录取状态(民办)</th>
                                <th>录取状态(公办)</th>
                                <th>再分配情况</th>
                                <th>最终去向</th>
                                <th>操作</th><?php endif; ?>
                        </tr>
                        </thead>
                        <tbody class="data_user">
                        <?php if(is_array($student_info)): foreach($student_info as $key=>$vo): ?><tr>
                            <?php if($where == 0): ?><td>
                                    <?php else: ?>
                                <td style="display: none"><?php endif; ?>
                                    <label>
                                        <input value="<?php echo ($vo["id"]); ?>" class="student_checked" type="checkbox">
                                        <span class="text"></span>
                                    </label>
                                </td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo ($vo["sex"]); ?></td>
                                <td><?php echo ($vo["sid_num"]); ?></td>
                                <td><?php echo ($vo["origin"]); ?></td>
                                <td><?php echo ($vo["civil_junior"]); ?></td>
                                <td><?php echo ($vo["pub_junior"]); ?></td>
                                <?php if($where == 0): ?><td style="display: none;"><?php echo ($vo["civil_status"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["pub_status"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["assign_status"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["result"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["operation"]); ?></td>
                                <?php elseif($where == 1): ?>
                                    <td><?php echo ($vo["civil_status"]); ?></td>
                                    <td><?php echo ($vo["pub_status"]); ?></td>
                                    <td><?php echo ($vo["assign_status"]); ?></td>
                                    <td><?php echo ($vo["result"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["operation"]); ?></td>
                                <?php elseif($where == 2): ?>
                                    <td><?php echo ($vo["civil_status"]); ?></td>
                                    <td><?php echo ($vo["pub_status"]); ?></td>
                                    <td><?php echo ($vo["assign_status"]); ?></td>
                                    <td style="display: none;"><?php echo ($vo["result"]); ?></td>
                                    <td><?php echo ($vo["operation"]); ?></td>
                                <?php elseif($where == 3): ?>
                                    <td><?php echo ($vo["civil_status"]); ?></td>
                                    <td><?php echo ($vo["pub_status"]); ?></td>
                                    <td><?php echo ($vo["assign_status"]); ?></td>
                                    <td><?php echo ($vo["result"]); ?></td>
                                    <td><?php echo ($vo["operation"]); ?></td><?php endif; ?>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    <input type="hidden" id="present_url" save_volunteer="<?php echo U('save_student_volunteer');?>" value="<?php echo U('student_info');?>">
                </div>
            </div>
        </div>
    </div>

    <div class="again_write modal modal-darkorange">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">重新填报学校</h4>
                </div>
                <div class="modal-body">
                    <label for="pub_junior" class="col-sm-3 control-label pub_junior_title"> 公办初中填报：</label>
                    <select id="pub_junior" name="pub_junior" class="form-control">
                        <?php if(is_array($pub_secondary_school)): foreach($pub_secondary_school as $key=>$vo): ?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="affirm_save btn btn-default">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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

    <script src="/register_system/Public/assets/js/datatable/jquery.dataTables.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="/register_system/Public/assets/js/datetime/moment.js"></script>
    <script src="/register_system/Public/assets/js/datetime/daterangepicker.js"></script>
    <script src="/register_system/Public/admin/student/js/student_info.js"></script>
    <script src="/register_system/Public/admin/student/js/refuse_info.js"></script>

</body>
</html>