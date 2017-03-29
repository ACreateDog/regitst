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
    <style>
        input[type=checkbox]{
            opacity: 1;
            position: relative;
            left: 0px;
            z-index: 12;
            width: 18px;
            height: 18px;
            cursor: pointer;
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
                    <div class="table-toolbar operation">
                        <div class="btn-group">
                            <a id="classtable_import" href="javascript:void(0);" class="btn btn-default">
                                <i class="glyphicon glyphicon-log-in"></i>导入
                            </a>
                        </div>
                        <div class="btn-group">
                            <a type="button" id="lot" onclick="throughS()" class="btn btn-default">
                                <i class="fa fa-download"></i>派中
                            </a>
                        </div>
                        <div class="btn-group">
                            <a type="button" id="nlot" onclick="NthroughS()" class="btn btn-default">
                                <i class="fa fa-download"></i>未派中
                            </a>
                        </div>
                        <div class="btn-group">
                            <a type="button" id="issued" class="btn btn-default" onclick="issued()">
                                <i class="glyphicon glyphicon-volume-up"></i>发布
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="student_info">
                        <thead>
                        <tr role="row">
                            <th>
                                <input type="checkbox" id="checkboxAll" onclick="checkboxAll(this)" />
                            </th>
                            <th>
                                学生姓名
                            </th>
                            <th>
                                性别
                            </th>
                            <th>
                                学籍号码
                            </th>
                            <th>
                                志愿学校(民办)
                            </th>
                            <th>
                                手机号
                            </th>
                            <th>
                                状态
                            </th>
                            <th>
                                操作
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                                <td>
                                    <?php if(($vo["civil_release"] == 1) or ($vo["lot_release"] == 1)): ?><input type="checkbox" name='reid' value="<?php echo ($vo["register_id"]); ?>" disabled=disabled/>
                                        <?php else: ?>
                                        <input type="checkbox" name='reid' value="<?php echo ($vo["register_id"]); ?>" /><?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo U('Register/student');?>?student=<?php echo ($vo["sid"]); ?>"><?php echo ($vo['stu_name']); ?></a>
                                </td>
                                <td>
                                    <?php if($vo["sex"] == 0 ): ?>男<?php else: ?> 女<?php endif; ?>
                                </td>
                                <td>
                                    <?php echo ($vo["sid_num"]); ?>
                                </td>
                                <td class="center ">
                                    <?php echo ($vo["sch_name"]); ?>
                                </td>
                                <td class="center ">
                                    <?php echo ($vo["phone"]); ?>
                                </td>
                                <td class="center ">
                                    <?php if(($vo["civil_status"] == 2) and ($vo["civil_release"] == 1)): ?>已录取
                                        <?php elseif(($vo["civil_status"] == 3) and ($vo["civil_release"] == 1)): ?>未录取
                                        <?php elseif(($vo["civil_status"] == 1)): ?>派中
                                        <?php elseif(($vo["civil_status"] == 4)): ?>未派中
                                        <?php else: ?>等待<?php endif; ?>
                                </td>
                                <?php if(($vo["civil_release"] == 1) or ($vo["lot_release"] == 1)): ?><td>
                                        已发布
                                    </td>
                                    <?php else: ?>
                                    <td registerid="<?php echo ($vo["register_id"]); ?>">
                                        <?php if($vo["civil_status"] == 1): ?><a href="javascript:void(0);"  onclick="through(this)" class="btn btn-success btn-xs" disabled="false"><i class="fa fa-check"></i>派中</a>
                                            <a href="javascript:void(0);"  onclick="Nthrough(this)" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>未派中</a>
                                            <?php elseif(($vo["civil_status"] == 4)): ?>
                                            <a href="javascript:void(0);"  onclick="through(this)" class="btn btn-success btn-xs"><i class="fa fa-check"></i>派中</a>
                                            <a href="javascript:void(0);"  onclick="Nthrough(this)" class="btn btn-danger btn-xs" disabled="false"><i class="fa fa-times"></i>未派中</a>
                                            <?php else: ?>
                                            <a href="javascript:void(0);"  onclick="through(this)" class="btn btn-success btn-xs"><i class="fa fa-check"></i>派中</a>
                                            <a href="javascript:void(0);"  onclick="Nthrough(this)" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>未派中</a><?php endif; ?>

                                    </td><?php endif; ?>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    <input type="hidden" data-area='<?php echo ($organization); ?>' id="present_url" value="">
                </div>
            </div>
        </div>
    </div>
    <div id="import-modal" style="display:none;">
        <input type="file" name="import" class="import-submit" style="display: none">
        <a class="import-btn">上传文件</a>
        <div class="file-bar"></div>
        <p>请上传规定格式的Excel文件,<a class="download-template">下载模板</a></p>
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
    <script src="/register_system/Public/assets/js/bootbox/bootbox.js"></script>
    <script>
        function checkboxAll(obj){
            if($(obj)[0].checked){
                $("input[name='reid'][disabled!='disabled']").each(function(){this.checked=true;
                });
            }else{
                $("input[name='reid'][disabled!='disabled']").each(function(){this.checked=false;});
            }
        }

        function refresh(data){
            if(data['data'] == ''){
                data['data'] = 0;
            }
            alert_info('success','共有'+data['data']+'条数据改变!','',true)
        }
        //同意按钮请求
        function  through(obj){
            var objTr = $(obj).parent().parent();
            var objTd = $(obj).parent().prev();
            var reid = $($(obj).parent()).attr('registerid');
            var url = "<?php echo U('Enter/lotNum');?>";
            $.post(
                    url,
                    {
                        register_id:reid
                    },
                    function(data){
                        console.log(objTd[0].innerText = "派中");
                        $(obj).attr('disabled',true);
                        $(obj).next().attr('disabled',false);
                        Highlight(objTr);
                    }
            );
        }
        //拒绝按钮请求
        function Nthrough(obj){
            var objTr = $(obj).parent().parent();
            var objTd = $(obj).parent().prev();
            var url = "<?php echo U('Enter/NlotNum');?>";
            var reid = $($(obj).parent()).attr('registerid');
            $.post(
                    url,
                    {
                        register_id:reid
                    },
                    function(data){
                        console.log(objTd[0].innerText = "未派中");
                        Highlight(objTr);
                        $(obj).attr('disabled',true);
                        $(obj).prev().attr('disabled',false);
                    }
            );
        }
        //选中多个设置摇中
        function  throughS(){
            var url = "<?php echo U('Enter/lotNum');?>";
            var reid = [];
            $("input[name='reid'][disabled!='disabled']").each(function(){
                if(this.checked){
                    reid.push(this.value);
                }
            });
            if(reid.length == 0){
                alert_info('warning',"提示","请勾选派中学生!");
                return;
            }
            bootbox.confirm("<p style='font-size: 25px'>有"+reid.length+"条设为派中? </p>", function (result) {
                if (result) {
                    $.post(
                            url,
                            {
                                register_id:reid
                            },
                            function(data){
                                refresh(data);
                            }
                    );
                }
            });
        }
        //选中多个未摇中
        function NthroughS(){
            var url = "<?php echo U('Enter/NlotNum');?>";
            var reid = [];
            $("input[name='reid'][disabled!='disabled']").each(function(){
                if(this.checked){
                    reid.push(this.value);
                }
            });
            if(reid.length == 0){
                alert_info('warning',"提示","请勾选未派中学生!");
                return;
            }
            bootbox.confirm("<p style='font-size: 25px'>有"+reid.length+"条设为未派中? </p>", function (result) {
                if (result) {
                    $.post(
                            url,
                            {
                                register_id:reid
                            },
                            function(data){
                                refresh(data);
                            }
                    );
                }
            })
        }
        //发布摇号信息
        function issued(){
            var url = "<?php echo U('Enter/cilil_issued_lot');?>";
            var reid = [];
            $("input[name='reid'][checked='true']").each(function(){
                this.checked=true;
                reid.push(this.value);
            });
            bootbox.confirm("<p style='font-size: 25px'>确定发布已操作的信息?</p>", function (result) {
                if (result) {
                    $.post(
                            url,
                            {
                                where:reid
                            },
                            function(data){
                                refresh(data);
                            }
                    );
                }
            })
        }
        //高亮效果
        function Highlight(obj){
            obj.stop(true, true).animate({
                opacity:'0.3',
            },800).animate({
                opacity:'1',
            },800);
        }
        $(function(){
            bootbox.setDefaults("locale","zh_CN");
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
                    "order": [[ 1, ]],
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
                    "infoCallback": pageInfo
                });
                return table;
            }
            $("#school_district,#school,#class").change(function(){
                $(this).val();
            })

            $("#seek").click(function(){
                var origin_tyep = $("#origin_type");
                var type = origin_tyep.get(0).value
                var present_url = "<?php echo U('Enter/civilreginfo');?>";
                if(type == ""){
                    window.location.href=present_url;
                }else{
                    window.location.href=present_url +'?type='+type;
                }

            })
        })

        $(document).on('click','a.import-btn',function(e){
            e.preventDefault();
            $('.modal-darkorange .import-submit').click();
        })
        $(document).on('change','.import-submit',function(e){
            $(this).siblings('.file-bar').text(this.files[0].name);
        })

        $('#classtable_import').on('click',function(e){
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
                            var url = "<?php echo U('Enter/import_lot');?>";
                            formdata.append('import_file',$('.modal-darkorange .import-submit')[0].files[0]);
                            $.ajax({
                                url :url,
                                type: 'post',
                                data:formdata,
                                cache: false,
                                processData:false,
                                contentType:false,
                                success:function(data){
                                    if(data.code == "0xA004"){
                                        refresh(data);
                                    }else{
                                        alert_info('warning','失败'," ");
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
        })
    </script>

</body>
</html>