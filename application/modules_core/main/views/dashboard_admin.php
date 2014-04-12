<div class="admin-center">
	<div class="welcome">
		Selamat datang, <strong><?php echo $this->session->userdata('nama'); ?></strong>!
	</div>
	<ul class="stats clearfix">
		<li class="col-md-6">
		  <div class="blue-bg"><i class="icon-calendar"></i>
		    <h5>Periode dan Soal</h5>
		    <a href="<?= base_url() ?>soal">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-6">
		  <div class="mehroon-bg"><i class="icon-bar-chart"></i>
		    <h5>Laporan</h5>
		    <a href="<?= base_url() ?>laporan">View Details <i class="icon-"></i></a></div>
		</li>
	</ul>
</div>