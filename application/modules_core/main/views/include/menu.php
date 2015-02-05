<!-- VERTICAL NAVBAR -->
<nav id="main_topnav">
  <div class="container-fluid">
  	<?php if (isset($left_bar)): ?>
	  	<a href="javascript:;" class="pull-left toggle-aside">
	  		<i class="icon-">&#xf0a9; </i>
	  	</a>
  	<?php endif ?>
  	<a href="javascript:;" class="pull-right toggle-topmenu">
	  	<i class="icon-">&#xf0c9; </i>
	</a>
    <ul>
	<?php if ($this->session->userdata['is_super_admin']): ?>
			<li><a href="<?=base_url()?>manajemen/user" title="Hak Akses" >Manajemen User</a></li>
			<li><a href="<?=base_url()?>loginas" title="Login As" >Login As</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_admin']): ?>
			<li><i class="icon-globe"></i><a href="<?=base_url()?>" title="Dashboard" >Dashboard</a></li>
			<li>
				<i class="icon-check"></i><a href="javascript:void(0)" title="Menu Kuisioner" >Kuisioner</a>
				<ul class="toggle">
					<li><a href="<?=base_url()?>soal" title="Periode dan Soal" >Periode &amp; Soal</a></li>
					<li><a href="<?=base_url()?>matakuliah" title="Matakuliah" >Matakuliah</a></li>
					<li><a href="<?=base_url()?>laporan" title="Laporan" >Laporan</a></li>
				</ul>
			</li>
			<li>
				<i class="icon-dashboard"></i><a href="javascript:void(0)" title="Menu IP Dosen" >IP Dosen</a>
				<ul class="toggle">
					<li><a href="<?=base_url()?>ip/konfigurasi/pengajar" title="Dosen Pengajar" >Dosen Pengajar</a></li>
					<li><a href="<?=base_url()?>ip/konfigurasi/" title="O1 dan O3" >Presensi (O1) &amp; Nilai Kelulusan (O3)</a></li>
					<li><a href="<?=base_url()?>ip/konfigurasi_o4/deadline/" title="Deadline Pengumpulan Nilai" >Deadline Pengumpulan Nilai</a></li>
					<li><a href="<?=base_url()?>ip/ip/" title="Laporan" >Laporan</a></li>
				</ul>
			</li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_kepala_unit'] || ($this->session->userdata['status'] == 'Dosen')) :?>
			<li><i class="icon-globe"></i><a href="<?=base_url()?>" title="Dashboard" >Dashboard</a></li>
			<li>
				<i class="icon-dashboard"></i><a href="javascript:void(0)" title="Laporan" >Laporan</a>
				<ul class="toggle">
					<li><a href="<?=base_url()?>laporan/dosen/hasil_evaluasi/<?= $this->session->userdata('username'); ?>" title="Laporan" >Evaluasi Dosen</a></li>
					<li><a href="<?=base_url()?>laporan/dosen/ip_dosen/<?= $this->session->userdata('username'); ?>" title="Laporan" >IP Dosen</a></li>
				</ul>
			</li>
			<!-- <li><a href="<?=base_url()?>soal/soal_tambahan" title="Kuisioner" >Kuisioner</a></li> -->
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
			<li><a href="<?=base_url()?>mahasiswa/dashboard" title="Dashboard" ><i class="icon-">&#xf0ac;</i>Dashboard</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_biro1']): ?>
			<li><i class="icon-globe"></i><a href="<?=base_url()?>" title="Dashboard" >Dashboard</a></li>
			<li>
				<i class="icon-dashboard"></i><a href="javascript:void(0)" title="Dashboard" >IP Dosen</a>
				<ul class="toggle">
					<li><a href="<?=base_url()?>ip/konfigurasi_o4" title="Penerimaan Nilai Masuk" >Penerimaan Nilai Masuk</a></li>
				</ul>
			</li>
	<?php endif ?>
    </ul>
  </div>
</nav>