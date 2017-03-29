/**
 * Created by 杨亚东 on 2016/5/7.
 */
$(function(){
    var url = $(".submit").attr('url');//操作地址
    var student = $('.submit').attr('student');//当前操作对象
    var to_url = $(".submit").attr('to-url');//操作地址
    $(".submit").click(function(){
        bootbox.setDefaults("locale","zh_CN");
        bootbox.confirm("你确定要提交吗?", function (result) {
            if (!result) {
                return;
            }else{
                $(this).attr('submit',true);
                $.post(
                    url,
                    {
                        student:student
                    },
                    function(data){
                        if(data.code==0){
                            alert_info('success',data.msg,data.data);
                            setTimeout(function(){
                                window.location.href=to_url;
                            },2000)
                        }else{
                            alert_info('danger',data.msg,data.data);
                            $(".submit").attr('disabled',false);
                        }
                    }
                )
            }
        })
    })

    //重置密码
    $(".reset_pass_btn").click(function(){
        var url = $(this).attr('url');
        var student = $(this).attr('sid_num');
        var pass = $(this).attr('id_num');
        bootbox.setDefaults("locale","zh_CN");
        bootbox.confirm("你确定要重置吗?", function (result) {
            if (!result) {
                return;
            }else{
                $.post(
                    url,
                    {
                        student:student,
                        pass:pass
                    },
                    function(data){
                        if(data.code==0){
                            alert_info('success',data.msg,data.data);
                        }else{
                            alert_info('danger',data.msg,data.data);
                        }
                    }
                )
            }
        })
    })

    var duty_info_old = [];
    $(".edit_duty_info").click(function(){
        $(this).parents(".mother_father_duty").find('.text').attr('contenteditable',true).css("border",'1px solid #dddddd');
        $(this).hide();
        $(this).nextAll(".save_duty_info,.duty_info_cancel").css('display','inline-block');
        get_duty_info(this);
    })
    $(".save_duty_info").click(function(){
        var object = $(this).attr('object');
        var url = $(this).attr("url");
        var that = $(this).parents(".mother_father_duty");
        var name = $.trim(that.find("span[name='name']").text());
        var condition = new RegExp(/^[\u4e00-\u9fa5]{2,20}$/);
        if(!condition.test(name)){
            alert_info('warning','提示',"监护人姓名有误！！！");
            return;
        }
        var id_num = $.trim(that.find("span[name='id_num']").text());
        var condition = new RegExp(/^\d{17}([0-9]|X|x)$/);
        if(id_num!='' && !condition.test(id_num)){
            alert_info('warning','提示',"监护人身份证号有误！！！");
            return;
        }
        var workunit = $.trim(that.find("span[name='workunit']").text());
        if(workunit!=''&&workunit.length>100){
            alert_info('warning','提示',"监护人工作单位填写有误！！！");
            return;
        }
        var occupation = $.trim(that.find("span[name='occupation']").text());
        if(occupation!=''&&occupation.length>25){
            alert_info('warning','提示',"监护人职业填写有误！！！");
            return;
        }
        var phone = $.trim(that.find("span[name='phone']").text());
        var condition = new RegExp(/^1[3|4|5|7|8]\d{9}$/);
        if(!condition.test(phone)){
            alert_info('warning','提示',"手机号有误！！！");
            return;
        }
        if(object == 'guardian_info'){
            var relations = $.trim(that.find("span[name='relations']").text());
            if(relations!=''&&relations.length>10){
                alert_info('warning','提示',"监护人关系填写有误！！！");
                return;
            }
        }else if(object == 'father_info'){
            var relations = 0;
        }else{
            var relations = 1;
        }
        var duty_info_id = $(this).attr("student");
        $.post(
            url,
            {
                duty_info_id:duty_info_id,
                name:name,
                id_num:id_num,
                workunit:workunit,
                occupation:occupation,
                phone:phone,
                relations:relations,
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

    $(".duty_info_cancel").click(function(){
        var object = $(this).attr('object');
        var that = $(this).parents(".mother_father_duty");
        that.find("span[name='name']").text(duty_info_old[object]['name']);
        that.find("span[name='id_num']").text(duty_info_old[object]['id_num']);
        that.find("span[name='workunit']").text(duty_info_old[object]['workunit']);
        that.find("span[name='occupation']").text(duty_info_old[object]['occupation']);
        that.find("span[name='phone']").text(duty_info_old[object]['phone']);
        if(object == 'guardian_info'){
            that.find("span[name='relations']").text(duty_info_old[object]['relations']);
        }
        $(this).parents(".mother_father_duty").find('.text').attr('contenteditable',false).css("border",'0px solid #dddddd');
        $(this).toggle();
        $(this).prevAll(".save_duty_info,.edit_duty_info").toggle();
    })

    function get_duty_info(that){
        var object = $(that).attr('object');
        var that = $(that).parents(".mother_father_duty");
        duty_info_old[object] = [];
        duty_info_old[object]['name'] = that.find("span[name='name']").text();
        duty_info_old[object]['id_num'] = that.find("span[name='id_num']").text();
        duty_info_old[object]['workunit'] = that.find("span[name='workunit']").text();
        duty_info_old[object]['occupation'] = that.find("span[name='occupation']").text();
        duty_info_old[object]['phone'] = that.find("span[name='phone']").text();
        if(object == 'guardian_info'){
            duty_info_old[object]['relations'] = that.find("span[name='relations']").text();
        }
    }

})