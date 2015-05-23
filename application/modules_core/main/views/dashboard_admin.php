<div class="admin-center">
	<div class="welcome">
		Selamat datang, <strong><?php echo $this->session->userdata('nama'); ?></strong>!
	</div>

	<!-- equkdw menu -->
	<ul class="stats clearfix">
		<h2>Menu Kuisioner</h2>
		<li class="col-md-4">
		  <div class="blue-bg"><i class="icon-calendar"></i>
		    <h5>Periode dan Soal</h5>
		    <a href="<?= base_url() ?>soal">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="green-bg"><i class="icon-cogs"></i>
		    <h5>Matakuliah</h5>
		    <a href="<?= base_url() ?>matakuliah">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="mehroon-bg"><i class="icon-bar-chart"></i>
		    <h5>Laporan</h5>
		    <a href="<?= base_url() ?>laporan">View Details <i class="icon-"></i></a></div>
		</li>
	</ul>

	<!-- ip dosen menu -->
	<ul class="stats clearfix">
		<h2>Menu IP Dosen</h2>
		<li class="col-md-4">
		  <div class="blue-bg"><i class="icon-cogs"></i>
		    <h5>Dosen Pengajar</h5>
		    <a href="<?= base_url() ?>ip/konfigurasi/pengajar">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="green-bg"><i class="icon-cogs"></i>
		    <h5>Input O1 &amp; O3</h5>
		    <a href="<?= base_url() ?>ip/konfigurasi">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="mehroon-bg"><i class="icon-bar-chart"></i>
		    <h5>Laporan</h5>
		    <a href="<?= base_url() ?>ip/ip">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="blue-bg"><i class="icon-cogs"></i>
		    <h5>Deadline o4</h5>
		    <a href="<?= base_url() ?>ip/konfigurasi_o4/deadline">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-4">
		  <div class="green-bg"><i class="icon-cogs"></i>
		    <h5>Input Tanggal Penyerahan Berkas</h5>
		    <a href="<?= base_url() ?>ip/konfigurasi_o4">View Details <i class="icon-"></i></a></div>
		</li>
	</ul>
</div>

