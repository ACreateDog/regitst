<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8"/>
    <title>登录::小升初系统</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="/register_system/Public/assets/img/favicon.png" type="image/x-icon">
    <link href="/register_system/Public/Home/Login/css/login.css" rel="stylesheet" />

    <!--Basic Styles-->
    <link href="/register_system/Public/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/register_system/Public/assets/css/font-awesome.min.css" rel="stylesheet"/>

    <!--Fonts-->
    <link href="http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300"
          rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="/register_system/Public/assets/css/beyond.min.css" rel="stylesheet"/>
    <link href="/register_system/Public/assets/css/animate.min.css" rel="stylesheet"/>

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/register_system/Public/assets/js/skins.min.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
<div id="body-background">
    <img src="/register_system/Public/Home/Login/img/login_page.png" alt="Bg">
</div>
<div id="system_title">
    新乡市小升初管理系统
</div>
<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white float_class" style="height: 343px!important;padding-top: 5px;">
        <div class="loginbox-title">系统登录</div>
        <div class="loginbox-social">
        </div>
        <div class="loginbox-textbox">
            <input type="text" class="form-control tel" placeholder="学籍号"/>
        </div>
        <div class="loginbox-textbox">
            <input type="password" class="form-control pwd" placeholder="密码"/>
        </div>

        <div class="loginbox-textbox">
            <p class="top15 captcha" id="captcha-container">
                <input name="verify" class="captcha-text form-control verify" placeholder="验证码" type="text" />
                <img id="verify-fresh" onClick="this.src=this.src+'?'+Math.random()"
                     alt="验证码" title="点击刷新" src="<?php echo U('login/verify',array());?>">
            </p>
        </div>
        <div class="loginbox-submit">
            <input type="submit" class="btn btn-primary btn-block" onclick="doLogin()" value="登录">
        </div>
    </div>
    <div class="alert alert-warning" style="margin-top: 20px;display: none;">
        <i class="fa-fw fa fa-warning"></i>
        <span class="msg"></span>
    </div>
</div>
<!--
<div id="system_main">
    技术支持：三月软件工作室
</div>
-->

<!--Basic Scripts-->
<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!--Beyond Scripts-->
<script src="/register_system/Public/assets/js/beyond.min.js"></script>
<script>
    function doLogin() {
        var tel = $.trim($(".tel").val()); //获取登录账号
        var pwd = $.trim($(".pwd").val()); //获取登录密码
        var verify = $.trim($(".verify").val()); //获取验证码

        console.log(tel);
        console.log(pwd);
        console.log(verify);

        var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);//如果手机号码不能通过验证
//        var telReg = !!tel.match(/^\d{19}$/);  //验证19位学籍号
        if (telReg == false) {
            $(".msg").html("请输入正确的账号");
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
            return;
        }
        if (pwd.length == 0) {
            $(".msg").html("请输入密码");
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
            return;
        }
        if (verify.length == 0) {
            $(".msg").html("请输入验证码");
            $(".alert").fadeIn();
            setTimeout(function () {
                $(".alert").fadeOut();
            }, 3000)
            return;
        }
        $.post("<?php echo U('login/dologin');?>", {t: tel, p: pwd, v: verify}, function (s, d) {
            console.log(s);
            if (s.code == "0") {
                $(".msg").html(s.msg);
                $(".alert").fadeIn();
                setTimeout(function () {
                    $(".alert").fadeOut();
                }, 3000)
                window.location.href = "<?php echo U('register/register');?>";
            } else {
                $(".msg").html(s.msg);
                $(".alert").fadeIn();
                setTimeout(function () {
                    $(".alert").fadeOut();
                }, 3000)
            }
        }, "json");
    }
    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            var c_start = document.cookie.indexOf(c_name + "=")
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1
                var c_end = document.cookie.indexOf(";", c_start)
                if (c_end == -1) c_end = document.cookie.length
                return unescape(document.cookie.substring(c_start, c_end))
            }
        }
        return ""
    }

    $(function () {

        $(".tel").val(getCookie("sidNum"));

        $('input:checkbox').on("click", function () {
            if ($(this).attr("checked") == undefined) {
                $(this).attr("checked", true);
            }
            else {
                $(this).attr("checked", false);
            }
        });
        $(".verify").keydown(function (e) {
            var ev = document.all ? window.event : e;
            if (ev.keyCode == 13) {
                doLogin();
            }
        });
    });

    //图片自适应
    $(document).ready(function() {
        $("#body-background").ezBgResize();
    });

    var containerObj;

    (function($) {
        // plugin definition
        $.fn.ezBgResize = function(options) {
            // First position object
            containerObj = this;

            containerObj.css("visibility","hidden");

            $(window).load(function() {
                resizeImage();
            });

            $(window).bind("resize",function() {
                resizeImage();
            });

        };

        function resizeImage() {

            containerObj.css({
                "position":"fixed",
                "top":"0px",
                "left":"0px",
                "z-index":"-1",
                "overflow":"hidden",
                "width":getWindowWidth() + "px",
                "height":getWindowHeight() + "px"
            });

            // Resize the img object to the proper ratio of the window.
            var iw = containerObj.children('img').width();
            var ih = containerObj.children('img').height();
            if (getWindowWidth() > getWindowHeight()) {
                if (iw > ih) {
                    var fRatio = iw/ih;
                    containerObj.children('img').css("width",getWindowWidth() + "px");
                    containerObj.children('img').css("height",Math.round(getWindowWidth() * (1/fRatio)));

                    var newIh = Math.round(getWindowWidth() * (1/fRatio));

                    if(newIh < getWindowHeight()) {
                        var fRatio = ih/iw;
                        containerObj.children('img').css("height",getWindowHeight());
                        containerObj.children('img').css("width",Math.round(getWindowHeight() * (1/fRatio)));
                    }
                } else {
                    var fRatio = ih/iw;
                    containerObj.children('img').css("height",getWindowHeight());
                    containerObj.children('img').css("width",Math.round(getWindowHeight() * (1/fRatio)));
                }
            } else {
                var fRatio = ih/iw;
                containerObj.children('img').css("height",getWindowHeight());
                containerObj.children('img').css("width",Math.round(getWindowHeight() * (1/fRatio)));
            }
            containerObj.css("visibility","visible");
        }

        // private function for debugging
        function debug($obj) {
            if (window.console && window.console.log) {
                window.console.log('Window Width: ' + $(window).width());
                window.console.log('Window Height: ' + $(window).height());
            }
        };

        // Dependable function to get Window Height
        function getWindowHeight() {
            var windowHeight = 0;
            if (typeof(window.innerHeight) == 'number') {
                windowHeight = window.innerHeight;
            }
            else {
                if (document.documentElement && document.documentElement.clientHeight) {
                    windowHeight = document.documentElement.clientHeight;
                }
                else {
                    if (document.body && document.body.clientHeight) {
                        windowHeight = document.body.clientHeight;
                    }
                }
            }
            return windowHeight;
        };

        // Dependable function to get Window Width
        function getWindowWidth() {
            var windowWidth = 0;
            if (typeof(window.innerWidth) == 'number') {
                windowWidth = window.innerWidth;
            }
            else {
                if (document.documentElement && document.documentElement.clientWidth) {
                    windowWidth = document.documentElement.clientWidth;
                }
                else {
                    if (document.body && document.body.clientWidth) {
                        windowWidth = document.body.clientWidth;
                    }
                }
            }
            return windowWidth;
        };
    })(jQuery);
</script>
</body>
<!--Body Ends-->
</html>