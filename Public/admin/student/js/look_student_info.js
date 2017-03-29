/**
 * Created by 杨亚东 on 2016/4/27.
 */
$(function(){
    var present_url = $("#present_url").val();
    //var area = JSON.parse($("#data_area").text());//机构框架
    //$("#data_area").remove();
    var student_info = set_data_table("student_info");//实例化表
    var table = student_info;//当前操作的表
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
            "infoCallback": pageInfo
        });
        return table;
    }

    //高级联动对象绑定
    $("#school_district,#school").change(function(){
        var object = $(this).attr("id");
        var school_district = $("#school_district").val();
        var school = $("#school").val();
        $(this).nextAll("select").not("#civil_junior,#pub_junior").find("option[value!='0']").remove();
        change_click(object,school_district,school);
    })

    function change_click(object,school_district,school){
        if(object == 'school_district'){
            for(var item in area['primary_school'][school_district]){
                $("#school").append("<option value='"+item+"'>"+area['primary_school'][school_district][item]+"</option>");
            }
        }else if(object == 'school'){
            for(var item in area['class'][school]){
                $("#class").append("<option value='"+item+"'>"+area['class'][school][item]+"</option>");
            }
        }
    }

    //搜索条件对应选中
    if($("#school_district").attr('data')){
        change_click('school_district',$("#school_district").attr('data'),$("#school").attr('data'));
    }
    if($("#school").attr('data')){
        change_click('school',$("#school_district").attr('data'),$("#school").attr('data'));
    }
    $("#student_type option[value="+$("#student_type").attr('data')+"]").attr("selected", true);
    $("#lottery option[value="+$("#lottery").attr('data')+"]").attr("selected", true);
    $("#school_district option[value="+$("#school_district").attr('data')+"]").attr("selected", true);
    $("#school option[value="+$("#school").attr('data')+"]").attr("selected", true);
    $("#class option[value="+$("#class").attr('data')+"]").attr("selected", true);
    $("#civil_junior option[value="+$("#civil_junior").attr('data')+"]").attr("selected", true);
    $("#pub_junior option[value="+$("#pub_junior").attr('data')+"]").attr("selected", true);

    //导表
    $("#export").click(function(){
        var count = table.rows().data().length;
        if(count <= 0){
            alert_info('warning',"提示","没有任何数据");
            return false;
        }
    })

    $("#seek").click(function(){
        var school_district = $("#school_district").val();
        var school = $("#school").val();
        var class_id = $("#class").val();
        var student_type = $('#student_type').val();
        var lottery = $('#lottery').val();
        var civil_junior = $('#civil_junior').val();
        var pub_junior = $('#pub_junior').val();
        window.location.href=present_url
            +'?student_type='+student_type
            +'&lottery='+lottery
            +'&school_district='+school_district
            +'&school='+school
            +'&class_id='+class_id
            +'&civil_junior='+civil_junior
            +'&pub_junior='+pub_junior;
    })

})