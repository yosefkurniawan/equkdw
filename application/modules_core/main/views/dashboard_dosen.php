<div class="admin-center">
	<div class="welcome">
		Selamat datang, <strong><?php echo $this->session->userdata('nama'); ?></strong>!
	</div>
	<ul class="stats clearfix">
		<li class="col-md-6">
		  <div class="mehroon-bg"><i class="icon-bar-chart"></i>
		    <h5>Hasil Kuisioner Saya</h5>
		    <a href="<?= base_url() ?>laporan/dosen/hasil_evaluasi/<?=$this->session->userdata('username'); ?>">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-6">
		  <div class="green-bg"><i class="icon-bar-chart"></i>
		    <h5>IP Saya</h5>
		    <a href="<?= base_url() ?>laporan/dosen/ip_dosen/<?=$this->session->userdata('username'); ?>">View Details <i class="icon-"></i></a></div>
		</li>
      <?php if ($this->session->userdata['is_kepala_unit']) : ?>          
		<li class="col-md-6">
		  <div class="blue-bg"><i class="icon-bar-chart"></i>
		    <h5>Laporan IP Prodi</h5>
		    <a href="<?= base_url() ?>ip/ip">View Details <i class="icon-"></i></a></div>
		</li>
	  <?php endif; ?>
		<!-- 
		<li class="col-md-6">
		  <div class="blue-bg"><i class="icon-list-ol"></i>
		    <h5>Kuisioner</h5>
		    <a href="<?= base_url() ?>soal/soal_tambahan">View Details <i class="icon-"></i></a></div>
		</li>
		 -->
	</ul>
</div>