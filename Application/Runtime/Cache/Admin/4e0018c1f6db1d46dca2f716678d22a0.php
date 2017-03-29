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
    <link href="/register_system/Public/Admin/student/css/look_student_info.css" rel="stylesheet"/>

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
                    <span class="widget-caption"><?php echo ($route); ?></span>
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
                                        <label>生源类型：</label>
                                        <select id="origin_type">
                                            <option value="">全部</option>
                                            <option value="0">学区生</option>
                                            <option value="1">统筹生</option>
                                            <option value="2">调剂生</option>
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
                        <div class="btn-group">
                            <a type="button" id="export" class="btn btn-default" href="<?php echo U('Enter/pub_studnet_info_export');?>?type=4">
                                <i class="fa fa-download"></i>导出
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="student_info">
                        <thead>
                        <tr role="row">
                            <th>
                                序号
                            </th>
                            <th>
                                学籍号码
                            </th>
                            <th>
                                学生姓名
                            </th>
                            <th>
                                性别
                            </th>
                            <th>
                                生源类型
                            </th>
                            <th>
                                毕业小学
                            </th>
                            <th>
                                民办学校
                            </th>
                            <th>
                                民办状态
                            </th>
                            <th>
                                分配学校
                            </th>
                            <th>
                                状态
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                                <td>
                                    <?php echo ($k + 1); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["sid_num"]); ?>
                                </td>
                                <td>
                                    <a href="<?php echo U('Register/student');?>?student=<?php echo ($vo["sid"]); ?>"><?php echo ($vo['stu_name']); ?></a>
                                </td>
                                <td>
                                    <?php if($vo["sex"] == 0 ): ?>男<?php else: ?> 女<?php endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if($vo["origin"] == 0): ?>学区生
                                        <?php elseif($vo["origin"] == 1): ?>统筹生
                                        <?php elseif($vo["status"] == 3): ?>调剂生<?php endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["drank"] == '' or $vo["drank"] == 1)): echo ($vo["original_school"]); ?>
                                        <?php else: echo ($vo["oname"]); endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["civil_name"] == '')): ?>无
                                        <?php else: echo ($vo["civil_name"]); endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["civil_status"] == 1) and ($vo["lot_release"] == 1)): ?>派中
                                        <?php elseif(($vo["civil_status"] == 2) and ($vo["civil_release"] == 1)): ?>录取
                                        <?php elseif(($vo["civil_status"] == 3) and ($vo["civil_release"] == 1)): ?>退回
                                        <?php elseif(($vo["civil_status"] == 4) and ($vo["civil_release"] == 1)): ?>未派中
                                        <?php elseif(($vo["sch_name"] == '')): ?>无
                                        <?php else: ?>等待<?php endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["assign_name"] == '')): ?>无
                                        <?php else: echo ($vo["assign_name"]); endif; ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["pub_status"] == 1) and ($vo["pub_release"] == 1)): ?>同意
                                        <?php elseif(($vo["pub_status"] == 2) and ($vo["pub_release"] == 1)): ?>拒绝
                                        <?php elseif(($vo["civil_status"] == 2) and ($vo["civil_release"] == 1)): ?>--
                                        <?php elseif(($vo["civil_status"] == 1) and ($vo["civil_release"] == 1)): ?>--
                                        <?php elseif(($vo["sch_name"] == '')): ?>--
                                        <?php else: ?>等待<?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    <input type="hidden" data-area='<?php echo ($organization); ?>' id="present_url" value="">
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

    <script src="/register_system/Public/assets/js/datatable/jquery.dataTables.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="/register_system/Public/assets/js/datetime/moment.js"></script>
    <script src="/register_system/Public/assets/js/datetime/daterangepicker.js"></script>
    <script>
        $(function(){
            var present_url = $("#present_url").val();
            var activity_end = set_data_table("student_info");//实例化表
            var table = activity_end;//当前操作的表
            function set_data_table(table){
                var table = $('#'+table).DataTable({
                    "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
                    "language": {
                        "search": "",
                        "sLengthMenu": "_MENU_",
                    },
                    "oLanguage":{
                        "sZeroRecords" : "没有您要搜索的内容",
                        "sSearch" : "",
                        "oPaginate": {
                            "sPrevious": "<",
                            "sNext": ">",
                        }
                    },
                    "infoCallback": pageInfo
                });
                return table;
            }
            $("#export").click(function(){
                var count = table.rows().data().length;
                if(count <= 0){
                    alert_info('warning',"提示","没有任何数据");
                    return false;
                }
            })
            $("#school_district,#school,#class").change(function(){
                $(this).val();
            })

            $("#seek").click(function(){
                var origin_tyep = $("#origin_type");
                var type = origin_tyep.get(0).value
                var present_url = "<?php echo U('Enter/pubreginfo');?>";
                if(type == ""){
                    window.location.href=present_url;
                }else{
                    window.location.href=present_url +'?type='+type;
                }

            })

            function getUrlParam(name)
            {
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r!=null) return unescape(r[2]); return null; //返回参数值
            }

            function getSelect(){
                var type = getUrlParam('type');
                if(type == null ||type == ""){
                    return;
                }
                var collapseOne = $("#collapseOne");
                collapseOne.addClass('in');
                var origin_tyep = $("#origin_type");
                type++;
                $(origin_tyep[0][type]).attr('selected',true);
            }
            getSelect();
        })
    </script>

</body>
</html>