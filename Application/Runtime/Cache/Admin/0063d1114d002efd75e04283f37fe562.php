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
                                联系人
                            </th>
                            <th>
                                联系电话
                            </th>
                            <th>
                                地址
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr data-id="<?php echo ($city["id"]); ?>">
                                <td>
                                    <a href="#" class="detail"><?php echo ($city["name"]); ?></a>
                                </td>
                                <td>
                                    <?php echo ($city["handler"]); ?>
                                </td>
                                <td>
                                    <?php echo ($city["phone"]); ?>
                                </td>
                                <td>
                                    <?php echo ($city["address"]); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                    <table class="table table-striped table-hover table-bordered" id="editabledatatable">
                        <thead>
                        <tr>
                            <th>
                                名称
                            </th>
                            <th>
                                联系人
                            </th>
                            <th>
                                联系电话
                            </th>
                            <th>
                                地址
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                    <td>
                                        <a href="#" class="detail"><?php echo ($vo["name"]); ?></a>
                                    </td>
                                    <td>
                                        <?php echo ($vo["handler"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["phone"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["address"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                                联系人
                            </th>
                            <th>
                                联系电话
                            </th>
                            <th>
                                地址
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($primary_list)): $i = 0; $__LIST__ = $primary_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                    <td>
                                        <a href="#" class="detail"><?php echo ($vo["name"]); ?></a>
                                    </td>
                                    <td>
                                        <?php echo ($vo["area"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["handler"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["phone"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["address"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                                联系人
                            </th>
                            <th>
                                联系电话
                            </th>
                            <th>
                                地址
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($junior_list)): $i = 0; $__LIST__ = $junior_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                    <td>
                                        <a href="#" class="detail"><?php echo ($vo["name"]); ?></a>
                                    </td>
                                    <td>
                                        <?php echo ($vo["area"]); ?>
                                    </td>
                                    <td>
                                        <?php if($vo["rank"] == 3 ): ?>公办
                                            <?php else: ?> 民办<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["handler"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["phone"]); ?>
                                    </td>
                                    <td>
                                        <?php echo ($vo["address"]); ?>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
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

                }
            }
        }();
        var InitiateEditableDataTable = function () {
            return {
                init: function () {
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
                        "infoCallback": function( settings, start, end, max, total, pre ) {
                            return '第 ' + start +" 到 "+ end + ' 行   共' + total + '行';
                        }
                    });
                }
            };
        }();
        var InitiateSimpleTable = function () {
            return {
                init: function () {
                    var aTable = $('.simple-table').dataTable({
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
                        "infoCallback": function( settings, start, end, max, total, pre ) {
                            return '第 ' + start +" 到 "+ end + ' 行   共' + total + '行';
                        }
                    });
                }
            };
        }();

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
    $('.table').on("click", 'a.detail', function(e){
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

</body>
</html>