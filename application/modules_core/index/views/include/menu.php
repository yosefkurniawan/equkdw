<!-- VERTICAL NAVBAR -->
<nav id="main_topnav">
  <div class="container-fluid"><a href="javascript:;" class="pull-left toggle-aside"><i class="icon-">&#xf0a9; </i></a><a href="javascript:;" class="pull-right toggle-topmenu">
  	<i class="icon-">&#xf0c9; </i></a>
    <ul>
	<?php if ($this->session->userdata['is_super_admin']): ?>
			<li><a href="<?=base_url()?>hakakses" title="Hak Akses" >Hak Akses</a></li>
			<li><a href="<?=base_url()?>loginas" title="Login As" >Login As</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_admin']): ?>
			<li><a href="<?=base_url()?>soal" title="Periode dan Soal" >Periode dan Soal</a></li>
			<li><a href="<?=base_url()?>laporan" title="Laporan" >Laporan</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_kepala_unit'] || ($this->session->userdata['status'] == 'Dosen')) :?>
			<li><a href="<?=base_url()?>laporan" title="Laporan" >Laporan</a></li>
			<li><a href="<?=base_url()?>kuisioner" title="Kuisioner" >Kuisioner</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
			<li><a href="<?=base_url()?>mahasiswa/dashboard" title="Dashboard" ><i class="icon-">&#xf0ac;</i>Dashboard</a></li>
	<?php endif ?>
    </ul>
  </div>
</nav>