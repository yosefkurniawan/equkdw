<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Standards"><![endif]-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="keywords" content="Admin Template, Dashboard, Web Application, C Panel, Admin Theme">
    <meta name="description" content="Flatron - responsive admin template, based on bootstrap v3.0, this theme is very useful in developing web application">
    <meta name="author" content="Akshay Kumar">
    <!-- Bootstrap Version 3.0-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap/bootstrap.min.css" />
    <!--Base style sheet-->
    <link href="<?php echo base_url(); ?>public/assets/css/base.css" type="text/css" rel="stylesheet">
    <!-- Styled Checkbox/Radiobuttons-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/icheck-skins/square/blue.css" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]><script src="assets/js/html5shiv/html5shiv.js" type="text/javascript"></script><script src="assets/js/respond/respond.min.js" type="text/javascript"></script><![endif]-->
</head>

<body class="blue-bg">
    <div class="signin">
        <div class="signin-body">
            <h3>Enter your email address</h3>
            <form id="basic-validation" action="<?php echo base_url(); ?>admin/forgot_password_process" method="POST">
                <div class="form-group">
                    <div class="msg"><?php echo $this->session->flashdata('message'); ?></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                </div>
                <div class="form-group clearfix">
                    <input type="submit" class="btn btn-med blue-bg pull-right" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
