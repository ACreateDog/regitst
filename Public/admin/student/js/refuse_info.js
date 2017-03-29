/**
 * Created by 杨亚东 on 2016/5/23.
 */
$(function(){
    $(document).on("click",'.look_info',function(){
        var register_id = $(this).attr("register_id");
        var school_id = $(this).attr("school_id");
        var url = $("#look_refuse_info").val();//base.html中定义
        $.post(
            url,
            {
                register_id:register_id,
                school_id:school_id,
            },
            function(data){
                if(data.code==0){
                    $(".refuse_info").text(data.data);
                    $(".look_refuse_info_modal").modal({show:true});
                }else{
                    alert_info('warning',data.msg,data.data);
                }
            }
        )
    })
})