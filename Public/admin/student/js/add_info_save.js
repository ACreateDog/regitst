/**
 * Created by 杨亚东 on 2016/4/26.
 */
$(function(){
    var url = $(".add_apply").attr('url');//操作地址
    var student = $('.add_apply').attr('student');//当前操作对象
    var sid_num = $("#sid_num").val();//当前操作对象的【老学籍号】
    var verify_phone = /^1[3|4|5|7|8]\d{9}$/;//验证手机
    var verify_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;//验证邮箱
    var verify_id = /^\d{17}([0-9]|X|x)$/;//验证身份证号
    //var verify_sid = /^[G|L|J]\d{17}([0-9]|X|x)$/;//验证学籍
    var verify_sid = false;
    var text = /^[\u4e00-\u9fa5]{2,20}$/;//验证姓名文字
    var nation = /^[\u4e00-\u9fa5]{1,20}$/;//验证民族文字
    $(":checkbox").click(function(){
        if($("input[object='mother_info']").is(':checked') || $("input[object='father_info']").is(':checked') ||$("input[object='guardian_info']").is(':checked')){
            var object = $(this).attr("object");
            $("."+object).toggle();
        }else{
            alert_info('warning','警告',"父母及监护人信息（必填一项）");
            return false;
        }
    })
    //修改信息时性别，生源类型，志愿学校对应选中
    $("input:radio[name='sex'][value="+$("#sex").attr("data")+"]").click();
    $("#pub_junior").find("option[value='"+$("#pub_junior").attr('data')+"']").attr("selected",true);
    $("#civil_junior").find("option[value='"+$("#civil_junior").attr('data')+"']").attr("selected",true);
    $("input:radio[name='origin'][value="+$("#origin").attr("data")+"]").click();
    var guardian_name = $(".duty_info").find(".guardian_info").find("#guardian_name").val();
    var mother_name = $(".duty_info").find(".mother_info").find("#guardian_name").val();
    var father_name = $(".duty_info").find(".father_info").find("#guardian_name").val();
    if(mother_name != '' || father_name != '' || guardian_name != ''){
        if(guardian_name != '' && !$("input[object='guardian_info']").is(':checked')){
            $("input:checkbox[object='guardian_info']").click();
        }
        if(mother_name == '' && $("input[object='mother_info']").is(':checked')){
            $("input:checkbox[object='mother_info']").click();
        }
        if(father_name == '' && $("input[object='father_info']").is(':checked')){
            $("input:checkbox[object='father_info']").click();
        }
    }

    var photo_src = $("#photo_show").attr("src").split("Uploads/");
    var photo_default = photo_src[1];//默认图片
    var photo=photo_default;//上传图片
    //--Bootstrap Date Picker--
    $('.date-picker').datepicker();
    $(document).on("click",'.input-group-addon',function(){
        $("#birthday").focus();
    })

    //上传插件实例化
    $("#photo_image").fileupload({
        url: $('#photo_image').attr('url'),
        sequentialUploads: true
    }).bind('fileuploadprogress', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $("#photo_progress").css('width',progress + '%');
        $("#photo_progress").html(progress + '%');
    }).bind('fileuploaddone', function (e, data) {
        $("#photo_show").attr("src",photo_src[0]+"Uploads/"+data.result);
        photo=data.result;
        $("#photo_upload").css({display:"none"});
        $("#photo_cancle").css({display:""});
    });
    //重新上传
    $("#photo_cancle").click(function(){
        $("#photo_show").attr("src",photo_src[0]+"Uploads/"+photo_default);
        photo=photo_default;
        $("#photo_progress").css('width','0%');
        $("#photo_progress").html('0%');
        $("#photo_upload").css({display:""});
        $("#photo_cancle").css({display:"none"});
        $("#photo_image").click();
    });

    var post;
    //提交学生信息
    $(".add_apply").click(function(){
        post = true;
        var data = get_student_info();
        if(post){
            $(this).attr('disabled',true);
            $.post(
                url,
                {
                    student_info:data,
                    student:student,
                    sid_num:sid_num
                },
                function(data){
                    if(data.code==0){
                        alert_info('success','成功','保存成功');
                        setTimeout(function(){
                            window.location.href=$('.add_apply').attr('to-url')+"?student="+data.data;
                        },2000)
                    }else if(data.code==1){
                        alert_info('danger','失败','保存失败');
                        $(".add_apply").attr('disabled',false);
                    }else if(data.code==2){
                        alert_info('warning',data.msg,data.data);
                        $(".add_apply").attr('disabled',false);
                    }else{
                        alert_info('warning','提示','出错啦！');
                        $(".add_apply").attr('disabled',false);
                    }
                }
            )
        }
    })

    var house=false,house_address,house_owners,house_relations;
    $("input[name='origin']").click(function(){
        if($(this).val()==1){
            house = house_address = house_owners = house_relations =false;
            $(".must_or").hide();
            $(".assign").css("display",'inline-block');
            if($("input[name='assign']").is(':checked')){
                $(".add_apply").attr("disabled",false);
            }else{
                $(".add_apply").attr("disabled",true);
            }
        }else{
            /*house = */house_address = house_owners = house_relations =true;
            $(".must_or").show();
            $(".assign").hide();
            $(".add_apply").attr("disabled",false);
        }
    })

    $("input[name='assign']").click(function(){
        if($(this).is(':checked')){
            $(".add_apply").attr("disabled",false);
        }else{
            $(".add_apply").attr("disabled",true);
        }
    })

    function get_student_info(){

        var data = {};
        var basis_info = {};
        basis_info.picture = photo;

        try {
            basis_info.name = get_verify_data($("#name"), text, true,'学生姓名');
            basis_info.nation = get_verify_data($("#nation"), nation, true,'民族');
            basis_info.id_num = get_verify_data($("#id_num"), verify_id, true,'学生身份证号');
            if($("#original_school")[0]){
                basis_info.original_school = get_verify_data($("#original_school"), false, true,'原就读小学');
            }
            basis_info.sid_num = get_verify_data($("#sid_num"), verify_sid, true,'学生学籍号');
            basis_info.account = get_verify_data($("#account"), false, true,'户口所在地');
            basis_info.address = get_verify_data($("#address"), false, true,'家庭住址');
            basis_info.phone = get_verify_data($("#phone"), verify_phone, true,'电话');
            basis_info.email = get_verify_data($("#email"), verify_email, false,'邮箱');
            basis_info.origin = $("input[name='origin']:checked").val();
            var birthday = $.trim($("#birthday").val());
            var condition = new RegExp(/^\d{4}[-][0|1]\d[-][0|1|2|3]\d$/);
            if(!condition.test(birthday)){
                alert_info('warning', '提示', '生日填写格式有误！！！');
                post = false;
                return;
            }
            basis_info.birthday = Date.parse(new Date($("#birthday").val()));
            if(basis_info.birthday>=Date.parse(new Date())){
                alert_info('warning', '提示', '生日填写有误！！！');
                post = false;
                return;
            }else{
                basis_info.birthday = basis_info.birthday/1000;
            }
            basis_info.sex = $("input[name='sex']:checked").val();

            if (!basis_info.sex) {
                alert_info('warning', '提示', '性别为必选项！！！');
                post = false;
                throw false
            }
            if (!basis_info.origin) {
                alert_info('warning', '提示', '生源类型为必选项！！！');
                post = false;
                throw false
            }

            basis_info.house = get_verify_data($("#house"), false, house,'房产证编号');
            basis_info.house_address = get_verify_data($("#house_address"), false, house_address,'房产地址');
            basis_info.house_owners = get_verify_data($("#house_owners"), false, house_owners,'房产所有人及共有人');
            basis_info.house_relations = get_verify_data($("#house_relations"), false, house_relations,'房产证户主与孩子关系');

            var volunteer = {};
            volunteer.pub_junior = $("#pub_junior").val();
            volunteer.civil_junior = $("#civil_junior").val();

            var duty_info = {};
            if ($("input[object='mother_info']").is(':checked')) {
                var mother_info = {};
                var mother_info = get_duty_info(mother_info, 'mother_info');
                mother_info.relations = 1;
                duty_info.mother_info = mother_info;
            }
            if ($("input[object='father_info']").is(':checked')) {
                var father_info = {};
                var father_info = get_duty_info(father_info, 'father_info');
                father_info.relations = 0;
                duty_info.father_info = father_info;
            }
            if ($("input[object='guardian_info']").is(':checked')) {
                var guardian_info = {};
                var guardian_info = get_duty_info(guardian_info, 'guardian_info');
                guardian_info.relations = get_verify_data($(".guardian_info").find("#guardian_relation"), false, true);
                duty_info.guardian_info = guardian_info;
            }
        }catch(that){
            if(that){
                that.css('border', '1px solid red');
                that.focus();
            }
        }
        data.basis_info = basis_info;
        data.volunteer = volunteer;
        data.duty_info = duty_info;
        return data;
    }

    function get_duty_info(object_info,object){
        var that = $("."+object);
        object_info.name = get_verify_data(that.find("#guardian_name"),false,true,'名字');
        object_info.id_num = get_verify_data(that.find("#guardian_ID"),verify_id,false,'身份证号');
        object_info.workunit = get_verify_data(that.find("#guardian_unit"),false,false,'单位');
        object_info.occupation = get_verify_data(that.find("#guardian_occupation"),false,false,'职业');
        object_info.phone = get_verify_data(that.find("#guardian_tel"),verify_phone,true,'手机号');
        return object_info;
    }

    function get_verify_data(that,condition,must,info){
        var get_data = $.trim(that.val());
        if(must && get_data==''){
            alert_info('warning', '提示', info+'为必填项！！！');
            post = false;
            throw that
        }else{
            that.css('border','1px solid #d5d5d5');
        }
        if(condition && get_data!=''){
            var condition = new RegExp(condition);
            if(!condition.test(get_data)){
                alert_info('warning','提示',info+'信息填写有误！！！');
                post = false;
                throw that
            }else{
                that.css('border','1px solid #d5d5d5');
            }
        }
        return get_data;
    }
})