<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
Beyond Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3
Version: 1.0.0
Purchase: http://wrapbootstrap.com
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title>Error 404 - Page Not Found</title>

    <meta name="description" content="Error 404 - Page Not Found" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!--Basic Styles-->
    <link href="/register_system/Public/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--Beyond styles-->
    <link id="beyond-link" href="/register_system/Public/assets/css/beyond.min.css" rel="stylesheet" />
    <style>
        .error-container h2{
            font-size: 38px;
        }
    </style>
</head>
<!--Head Ends-->
<!--Body-->
<body class="body-404">
<div class="error-header"> </div>
<div class="container ">
    <section class="error-container text-center">
        <h1>404</h1>
        <div class="error-divider">
            <h2>没有找到此页</h2>
            <p class="description">We Couldn’t Find This Page</p>
        </div>
        <a href="<?php echo U('Index/index');?>" class="return-btn"><i class="fa fa-home"></i>Home</a>
    </section>
</div>
</body>
<!--Body Ends-->
</html>