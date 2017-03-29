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
        input[type=checkbox], input[type=radio]{
            opacity: .8;
            position: relative;
            left:0;
            z-index: auto;
            width: 15px;
            height: 15px;
            cursor: pointer;
        }
        #classtable_import{

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
        .table{
            width: 100%;
            table-layout: fixed;
        }
        .table th:nth-child(1){
            width:5%;
            min-width: 10px;
        }
        .table th:nth-child(2){
            width:10%;
        }
        .table th:nth-child(3){
            width:10%;
        }
        .table th:nth-child(4){
            width:16%;
        }
        .table th:nth-child(5){
            width:10%;
        }
        .table th:nth-child(6){
            width:12%;
        }
        .table th:nth-child(7){
            width:12%;
        }
        .table th:nth-child(8){
            width:25%;
        }
        td .form-control.input-small{
            width: 100%;!important;
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
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <section>
                                    <h2><span class="profile"><span><?php echo (session('name')); ?></span></span></h2>
                                </section>
                            </a>
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="edit">
                                    <a href="<?php echo U('User/change_passwd');?>" class="pull-right">修改密码</a>
                                </li>
                                <li class="edit">
                                    <a href="<?php echo U('Login/logout');?>" class="pull-right">退出</a>
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
 foreach( $nav as $key => $item ){ echo '<li>'; if($item['url']){ echo '<a href="'.$item['url'].'">'; }else{ echo '<a href="#" class="menu-dropdown">'; } echo '<i class="menu-icon '.$item['ico'].'"></i>'; echo '<span class="menu-text">'.$item['name'].'</span>'; if(!$item['url']){ echo '<i class="menu-expand"></i>'; } echo '</a>'; if(!$item['url']){ echo '<ul class="submenu">'; foreach( $item['children'] as $k => $value ){ echo '<li><a href="'. $value['url'] .'">'; echo '<span class="menu-text">'.$value['name'].'</span>'; echo '</a></li>'; } echo '</ul>'; } } ?>
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
                    <span class="widget-caption">班级/班主任</span>
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
                        <a id="classtable_new" href="javascript:void(0);" class="btn btn-default">
                            添加班主任
                        </a>
                        <a id="classtable_del" href="javascript:void(0);" class="btn btn-default">
                            <i class="fa fa-trash-o"></i>批量删除
                        </a>
                        <a id="import_excel" href="javascript:void(0);" class="btn btn-default">
                            <i class="glyphicon glyphicon-log-in"></i>导入
                        </a>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="classtable">
                        <thead>
                        <tr>
                            <th>
                                <input id="check-all" type="checkbox">
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                区属/市属
                            </th>
                            <th>
                                学校
                            </th>
                            <th>
                                班级
                            </th>
                            <th>
                                联系方式
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
                        <?php if(is_array($classes_list)): $i = 0; $__LIST__ = $classes_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td>
                                    <input type="checkbox" value="<?php echo ($vo["id"]); ?>">
                                </td>
                                <td>
                                    <?php echo ($vo["handler"]); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["area"]); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["school"]); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["name"]); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["phone"]); ?>
                                </td>
                                <td>
                                    <?php echo ($vo["account"]); ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a>
                                    <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a>
                                    <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-trash-o"></i> 重置密码</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                        <input type="password" class="form-control" id="user-new-passwd" placeholder="New Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user-re-passwd" class="col-lg-offset-2 col-xs-offset-1 col-sm-2 col-xs-2 control-label no-padding-right">确认密码</label>
                    <div class="col-lg-6 col-md-6  col-sm-8 col-xs-8">
                        <input type="password" class="form-control" id="user-re-passwd" placeholder="Again Password">
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
    <input value="<?php echo U('Org/import_classes');?>" id="import-url" type="hidden">
    <input value="<?php echo U('Org/get_primary_option');?>" id="primary-list-url" type="hidden">
    <input value="<?php echo U('Org/get_area_option');?>" id="area-list-url" type="hidden">
    <input value="<?php echo U('Org/insert_org');?>" id="add-teacher-url" type="hidden">
    <input value="<?php echo U('Org/update_org');?>" id="edit-teacher-url" type="hidden">
    <input value="<?php echo U('Org/delete_org');?>" id="del-teacher-url" type="hidden">
    <input value="<?php echo U('Org/download-template?type=class');?>" id="download-template-url" type="hidden">


            </div>
        </div>
    </div>
</div>

<script src="/register_system/Public/assets/js/jquery-2.0.3.min.js"></script>
<script src="/register_system/Public/assets/js/bootstrap.min.js"></script>
<script src="/register_system/Public/assets/js/beyond.min.js"></script>
<script src="/register_system/Public/Admin/public/js/alert_info.js"></script>

    <script src="/register_system/Public/assets/js/datatable/jquery.dataTables.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/ZeroClipboard.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.tableTools.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/dataTables.bootstrap.min.js"></script>
    <script src="/register_system/Public/assets/js/datatable/datatables-init.js"></script>
    <script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>

    <script>
        var InitiatePrimaryTable = function () {
            return {
                init: function () {

                    //Datatable Initiating
                    var oTable = $('#classtable').dataTable({
                        "autoWidth": false,
                        "lengthChange": false,
                        "iDisplayLength": 20,
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
                            null,
                            null,
                            null,
                            null,
                            null,
                            { "bSortable": false }
                        ],
                        "columns" : [
                            { "width": "5%" },
                            { "width": "10%" },
                            { "width": "10%" },
                            { "width": "15%" },
                            { "width": "15%" },
                            { "width": "15%" },
                            { "width": "15%" },
                                null
                        ],
                        "aaSorting" : [],
                        "infoCallback": function( settings, start, end, max, total, pre ) {
                            return '第 ' + start +" 到 "+ end + ' 行   共' + total + '行';
                        }
                    });

                    var isEditing = null;
                    var isCreating= null;
                    var select_primary_node = '<select class="form-control" name="primary" id="primary-select"></select>';
                    var select_node = '<select class="form-control" name="area" id="area-select"></select>';
                    var new_node = '<a href="#" class="btn btn-success btn-xs save"  data-mode="new"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel" data-mode="new"><i class="fa fa-times"></i> 关闭</a>';
                    var edit_node = '<a href="#" class="btn btn-success btn-xs save"><i class="fa fa-save"></i> 保存</a> <a href="#" class="btn btn-warning btn-xs cancel"><i class="fa fa-times"></i> 关闭</a>';
                    var opera_node= '<a href="#" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> 编辑</a> <a href="#" class="btn btn-danger btn-xs delete"><i class="fa fa-trash-o"></i> 删除</a> <a href="#" class="btn btn-warning btn-xs pass"><i class="fa fa-edit"></i> 重置密码</a>';

                    $('#classtable').on("click", 'a.pass', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];
                        var aData = oTable.fnGetData(nRow);
                        changePasswd(aData[6]);
                    });

                    $('#check-all').on("change", function (e) {
                        var flag = this.checked;
                        $('#classtable tbody').find("input[type=checkbox]").each(function(){
                            this.checked = flag;
                        })
                    });
                    $('#classtable tbody').on('change', 'input[type=checkbox]', function(){
                        if($('#check-all')[0].checked && ! this.checked){
                            $('#check-all')[0].checked = false;
                        }
                    })

                    //More delete
                    $('#classtable_del').click(function (e) {
                        e.preventDefault();
                        var ids = [];
                        $('#classtable tbody').find('input[type=checkbox]').each(function(){
                            if(this.checked){
                                ids.push(this.value);
                            }
                        })
                        if(ids.length < 1){
                            return;
                        }
                        bootbox.confirm('确定删除这 '+ ids.length +'人 吗? ', function (result) {
                            if (result) {
                                var url = $('#del-teacher-url').val();
                                $.post(url, {ids:ids},function(data){
                                    if(data.code == 0){
                                        alert_info('success','成功', '删除成功');
                                        $('#classtable tbody').find('input[type=checkbox]').each(function(){
                                            oTable.fnDeleteRow($(this).parents('tr')[0]);
                                        })
                                    }else{
                                        alert_info('warning','失败', '删除失败');
                                    }
                                })
                            }
                        });

                    });

                    //Add New Row
                    $('#classtable_new').click(function (e) {
                        e.preventDefault();
                        var aiNew = oTable.fnAddData(['','','','','','','',opera_node]);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        editRow(oTable, nRow, true);
                        isCreating = nRow;
                    });

                    //Edit A Row
                    $('#classtable').on("click", 'a.edit', function (e) {
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
                    $('#classtable').on("click", 'a.save', function (e) {
                        e.preventDefault();
                        if ($(this).attr("data-mode") == "new") {
                            saveRow(oTable, isCreating, true);
                        }else{
                            saveRow(oTable, isEditing);
                        }
                        //Some Code to Highlight Updated Row
                    });

                    //Delete an Existing Row
                    $('#classtable').on("click", 'a.delete', function (e) {
                        e.preventDefault();
                        var nRow = $(this).parents('tr')[0];
                        var aData = oTable.fnGetData(nRow);
                        bootbox.confirm('确定删除 "'+aData[1]+'" 吗? ', function (result) {
                            if (result) {
                                var url = $('#del-teacher-url').val();
                                $.post(url, {ids:$(nRow).find('input[type=checkbox]').val()},function(data){
                                    if(data.code == 0){
                                        alert_info('success','成功', '删除成功');
                                        oTable.fnDeleteRow(nRow);
                                    }else{
                                        alert_info('warning','失败', '删除失败');
                                    }
                                })
                            }
                        });
                    });

                    //Cancel Editing or Adding a Row
                    $('#classtable').on("click", 'a.cancel', function (e) {
                        e.preventDefault();
                        if ($(this).attr("data-mode") == "new") {
                            var nRow = $(this).parents('tr')[0];
                            oTable.fnDeleteRow(nRow);
                            isCreating = null;
                        } else {
                            restoreRow(oTable, isEditing);
                            isEditing = null;
                        }
                    });

                    function editRow(oTable, nRow, isnew) {
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);
                        jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                        jqTds[2].innerHTML = select_node;
                        jqTds[3].innerHTML = select_primary_node;
                        jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
                        jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
                        jqTds[6].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[6] + '">';
                        if(isnew){
                            jqTds[7].innerHTML = new_node;
                        }else{
                            jqTds[7].innerHTML = edit_node;
                        }

                         loadAreaOption(aData[2],function(ap){
                            loadPrimaryOption(ap,aData[3]);
                        });



                        $('#area-select').on('change', function(){
                            if($(this).val() > 0){
                                loadPrimaryOption($(this).val());
                            }
                        })
                    }
                    function loadAreaOption(select, fun){
                        var url = $('#area-list-url').val();
                        var ap = 0;
                        $.post(url, {}, function(data){
                            if(data.code == 0){
                                var options = '<option value="0">请选择</option>';;
                                for(var i = 0; i < data.data.length; i ++){
                                    if(!ap && select == data.data[i].name){
                                        options += '<option value="'+ data.data[i].id +'" selected>' + data.data[i].name + '</option>';
                                        ap = data.data[i].id;
                                    }else{
                                        options += '<option value="'+ data.data[i].id +'">' + data.data[i].name + '</option>'
                                    }
                                }
                                console.log(data.data);
                                console.log(options);
                                $('#area-select').html(options);
                                fun(ap);
                            }else{
                                fun();
                            }
                        })
                    }
                    function loadPrimaryOption(area,select){
                        var options = '<option value="0">请选择</option>';
                        if(area){
                            var url = $('#primary-list-url').val();
                            $.post(url, {area:area}, function(data){
                                if(data.code == 0){
                                    for(var i = 0; i < data.data.length; i ++){
                                        if(select == data.data[i].name){
                                            options += '<option value="'+ data.data[i].id +'" selected>' + data.data[i].name + '</option>'
                                        }else{
                                            options += '<option value="'+ data.data[i].id +'">' + data.data[i].name + '</option>'
                                        }
                                    }
                                    console.log(data.data);
                                    console.log(options);
                                    $('#primary-select').html(options);
                                }
                            })
                        }else{
                            $('#primary-select').html(options);
                        }
                    }

                    function restoreRow(oTable, nRow) {
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);

                        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                            oTable.fnUpdate(aData[i], nRow, i, false);
                        }

                        oTable.fnDraw();
                    }

                    function saveRow(oTable, nRow, isnew) {
                        var jqInputs = $('input[type=text],select', nRow);
                        var tdata = oTable.fnGetData(nRow);

                        if(isnew){
                            var pdata = {
                                handler : jqInputs[0].value,
                                pid: jqInputs[2].value,
                                name: jqInputs[3].value,
                                phone: jqInputs[4].value,
                                account: jqInputs[5].value,
                                rank : 6
                            }
                            var url = $('#add-teacher-url').val();
                        }else{
                            var pdata = {id:$(nRow).find('input[type=checkbox]').val()};
                            if(tdata[1] != jqInputs[0].value){
                                pdata.handler = jqInputs[0].value
                            }
                            if(tdata[3] != L_trim($(jqInputs[2]).find('option[value='+jqInputs[2].value+']').text())){
                                pdata.pid = jqInputs[2].value
                            }
                            if(tdata[4] != jqInputs[3].value){
                                pdata.name = jqInputs[3].value
                            }
                            if(tdata[5] != jqInputs[4].value){
                                pdata.phone = jqInputs[4].value
                            }
                            if(tdata[6] != jqInputs[5].value){
                                pdata.account = jqInputs[5].value
                            }
                            var url = $('#edit-teacher-url').val();
                        }

                        $.post(url, pdata, function(data){
                            if(data.code == 0){
                                alert_info('success', '成功', '操作成功');
                                if(isnew){
                                    isCreating= null;
                                    oTable.fnUpdate('<input type="checkbox" value="'+data.data+'">', nRow, 0, false);
                                }else{
                                    isEditing = null;
                                }
                                oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
                                oTable.fnUpdate( L_trim($(jqInputs[1]).find('option[value='+jqInputs[1].value+']').text()) , nRow, 2, false);
                                oTable.fnUpdate( L_trim($(jqInputs[2]).find('option[value='+jqInputs[2].value+']').text()), nRow, 3, false);
                                oTable.fnUpdate(jqInputs[3].value, nRow, 4, false);
                                oTable.fnUpdate(jqInputs[4].value, nRow, 5, false);
                                oTable.fnUpdate(jqInputs[5].value, nRow, 6, false);
                                oTable.fnUpdate(opera_node, nRow, 7, false);
                                oTable.fnDraw();
                            }else{
                                alert_info('warning', '错误', data.msg);
                            }
                        });
                    }
                }
            };
        }();

        InitiatePrimaryTable.init();
    </script>
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