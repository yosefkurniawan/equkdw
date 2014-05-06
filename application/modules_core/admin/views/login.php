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
    <meta name="keywords" content="eQuiz, UKDW, SI, Universitas Kristen Duta Wacana, DWCU, Duta Wacana Christian University, Yogyakarta, Indonesia, SI, IS">
    <meta name="description" content="eQuiz - information system for creating survey and evaluation in duta wacana christian university">
    <meta name="author" content="Pinaple Studio">
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
              <img src="<?=base_url()?>public/assets/images/logo.png" title="eQuiz" alt="eQuiz">
              <hr>
              <h4>Login Pengguna</h4>
            <form id="basic-validation" action="<?php echo base_url().$form_action ?>" method="POST">
                <?php if ($this->session->flashdata('admin_login_failed')): ?>
                    <div class="alert alert-danger fade in">
                        <?php echo $this->session->flashdata('admin_login_failed'); ?>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                </div>
                <div class="form-group clearfix">
                    <input type="submit" class="btn btn-med blue-bg pull-right" value="Login">
                </div>
                <hr>
                <h4>Lupa password ?</h4>
                <p><a href="<?php echo base_url(); ?>account">Klik di sini</a> jika Anda lupa password.
                </p>
            </form>
        </div>
    </div>
    <script src="assets/js/scripts.js"></script>
</body>
