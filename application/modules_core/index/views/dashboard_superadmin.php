<div class="admin-center">
	<div class="welcome">
		Selamat datang, <strong><?php echo $this->session->userdata('nama'); ?></strong>!
	</div>
	<ul class="stats clearfix">
		<li class="col-md-6">
		  <div class="blue-bg"><i class="icon-user"></i>
		    <h5>Manajemen User</h5>
		    <a href="<?= base_url() ?>manajemen/user">View Details <i class="icon-"></i></a></div>
		</li>
		<li class="col-md-6">
		  <div class="mehroon-bg"><i class="icon-signin"></i>
		    <h5>Login As</h5>
		    <a href="<?= base_url() ?>loginas">View Details <i class="icon-"></i></a></div>
		</li>
	</ul>
</div>