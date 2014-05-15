<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title ?></title>
<!-- Meta Tags -->
<meta charset="UTF-8" />
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="shortcut icon" href="<?=base_url()?>public/assets/images/favicon.ico" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Standards"><![endif]-->
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="eQuiz, UKDW, SI, Universitas Kristen Duta Wacana, DWCU, Duta Wacana Christian University, Yogyakarta, Indonesia, SI, IS">
<meta name="description" content="eQuiz - information system for creating survey and evaluation in duta wacana christian university">
<meta name="author" content="Pinaple Studio">
<!-- Bootstrap Version 3.0-->
<link rel="stylesheet" href="<?=base_url()?>public/assets/css/bootstrap/bootstrap.min.css" />
<!--Base style sheet-->
<link href="<?=base_url()?>public/assets/css/base.css" type="text/css" rel="stylesheet">
<!-- Chosen (input/select)-->
<link href="<?=base_url()?>public/assets/css/chosen/chosen.css" rel="stylesheet"/>
<!-- Visualize Charts-->
<link href="<?=base_url()?>public/assets/css/visualize/visualize.css" rel="stylesheet"/>
<!-- Full Calendar-->
<link href="<?=base_url()?>public/assets/css/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<!-- Jquery UI-->
<link href="<?=base_url()?>public/assets/css/jquery-ui/jquery-ui.css" rel="stylesheet"/>

<link href="<?=base_url()?>public/assets/css/jquery.datetimepicker.css" rel="stylesheet"/>

<!-- general -->
<link href="<?=base_url()?>public/assets/css/general.css" rel="stylesheet"/>
<!-- Soal -->
<link href="<?=base_url()?>public/assets/css/soal.css" rel="stylesheet"/>
<!-- Laporan -->
<link href="<?=base_url()?>public/assets/css/laporan.css" rel="stylesheet"/>
<!-- admin -->
<link href="<?=base_url()?>public/assets/css/admin.css" rel="stylesheet"/>

<link href="<?=base_url()?>public/assets/css/data-tables/data-table.css" rel="stylesheet" type=
"text/css">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

<script type="text/javascript">
        CI_ROOT = "<?=base_url() ?>";
</script>
<script src="<?=base_url()?>public/assets/js/scripts.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]><script src="<?=base_url()?>public/assets/js/html5shiv/html5shiv.js" type="text/javascript"></script><script src="<?=base_url()?>public/assets/js/respond/respond.min.js" type="text/javascript"></script><![endif]-->

</head>
<body>

<!-- FOTO PROFIL -->
<header>
 <!-- LOGO -->
  <div class="container-fluid clearfix">
    <a href="index.html" title="eQuiz" class="pull-left">
      <img src="<?=base_url()?>public/assets/images/logo.png" title="eQuiz" alt="eQuiz">
    </a>


    <div class="user pull-right">
      <a href="#" title="User Options" data-toggle="dropdown" class="pull-right">
        <div class="pull-left">
          <h5><?=$this->session->userdata['nama'];?></h5>
          <p>
          <?php if ($this->session->userdata['is_super_admin']): ?>
            Superadmin
          <?php endif; ?>
          <?php if ($this->session->userdata['is_admin']): ?>
            Admin
          <?php endif; ?>
          <?php if ($this->session->userdata['is_kepala_unit']) : ?>          
              Kepala Unit
              <?php if ($this->session->userdata['status'] == 'Dosen'): ?>
                dan Dosen
              <?php endif ?>
          <?php elseif ($this->session->userdata['status'] == 'Dosen'): ?>
          Dosen
          <?php endif ?>
          <?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
          Mahasiswa
          <?php endif ?>
        </p>
        </div>
        <div class="pull-right">
          <!-- <img src="<?=base_url()?>public/assets/images/user_pic/user.jpg" title="User Pic" alt="User Pic"> -->
        </div>
      </a>
      <ul class="dropdown-menu pull-right">
        <?php if ($this->session->userdata['is_admin'] || $this->session->userdata['is_super_admin']): ?>
          <li><a href="<?php echo base_url(); ?>account/pengaturan_akun">Ubah Password</a></li>
        <?php endif ?>
        <?php if ($this->session->userdata['status'] != 'Mahasiswa'): ?>
          <li><a href="<?php echo base_url(); ?>main">Dashboard</a></li>
        <?php endif ?>
          <li><a href="<?php echo base_url(); ?>main/logout">Log Out</a></li>
      </ul>
    </div>
  </div>
</header>
<!--HEADER ENDS-->

<body>
