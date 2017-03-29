/**
 * Created by 杨亚东 on 2016/4/25.
 */
$(function(){
    var student_id;//修改学生志愿（学生id）
    var save_student_volunteer_url = $("#present_url").attr('save_volunteer');//修改学生志愿（操作方法）
    var present_url = $("#present_url").val();
    $("#present_url").remove();
    var activity_end = set_data_table("student_info");//实例化表
    var table = activity_end;//当前操作的表
    function set_data_table(table){
        var table = $('#'+table).DataTable({
            'bStateSave':true,
            "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "search": "",
                "sLengthMenu": "_MENU_",
                "oPaginate": {
                    "sPrevious": "<",
                    "sNext": ">"
                },
                "zeroRecords": "没有找到符合条件的记录"
            },
            "infoCallback": pageInfo,
            columnDefs:[{
                orderable:false,
                targets:9,
            }]
        });
        return table;
    }

    //高级搜索下拉框对应选中
    var diplomas = $(".widget-caption").attr("where");
    $("#grasp_degree option[value="+diplomas+"]").attr("selected", true);

    //导表
    $("#export").click(function(){
        var count = table.rows().data().length;
        if(count <= 0){
            alert_info('warning',"提示","没有任何数据");
            return false;
        }
    })

    //高级搜索
    $(document).on("click","#seek",function(){
        var type = $("#grasp_degree").val();
        window.location.href=present_url+"?type="+type;
    })

    $(document).on('click','.again_junior',function(){
        student_id = $(this).attr('student_id');
        $('.again_write').modal({show:true});
    })

    $(document).on('click','.again_junior,#checkbox_assign',function(){
        student_id = $(this).attr('student_id');
        if(!student_id){
            student_id = 0;
            for(var i = 0;i < $(".student_checked").length; i++){
                if($(".student_checked").eq(i).is(':checked')){
                    student_id = $('.student_checked').eq(i).val()+","+student_id;
                }
            }
        }
        if(student_id==0){
            alert_info('warning','提示',"请先勾选学生");
            return;
        }
        $('.again_write').modal({show:true});
    })

    $("#checked_all").click(function(){
        $('.student_checked').attr('checked',false);
        if($("#checked_all").is(':checked')){
            $('.student_checked').click();
        }
    })

    $('.affirm_save').click(function(){
        $('.again_write').modal('hide');
        var volunteer = $("#pub_junior").val();
        $.post(
            save_student_volunteer_url,
            {
                student_id:student_id,
                volunteer:volunteer,
                status:"assign"
            },
            function(data){
                if(data.code==0){
                    alert_info('success',data.msg,data.data,true);
                }else{
                    alert_info('danger',data.msg,data.data);
                }
            }
        )
    })

    $("#issue").click(function(){
        var url = $(this).attr('url');
        bootbox.setDefaults("locale","zh_CN");
        bootbox.confirm("你确定要发布吗?", function (result) {
            if (!result) {
                return;
            }else{
                if(!$(".issue_y").length>0){
                    alert_info('warning','提示',"没有待发布学生");
                    return;
                }
                $.post(
                    url,
                    function(data){
                        if(data.code==0){
                            alert_info('success',data.msg,data.data,true);
                        }else{
                            alert_info('danger',data.msg,data.data);
                        }
                    }
                )
            }
        })
    })
})