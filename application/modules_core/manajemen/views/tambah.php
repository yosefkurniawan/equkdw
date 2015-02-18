<div class="page-header">
	<h1>Tambah User</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url() ?>manajemen/user">Manajemen User</a></li>
	<li class="active">Tambah User</li>
</ol>

<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Informasi User</h3>
	</div>
	<form method="POST" action="<?php echo base_url(); ?>manajemen/user/tambah_proses">
		<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
		<div class="panel-body">
			<?php echo $this->session->userdata('message'); ?>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Email</label>
						<div class="controls">
							<input type="text" name="email" class="form-control" value="<?php echo $this->session->userdata('email'); ?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Username</label>
						<div class="controls">
							<input type="text" name="username" class="form-control" value="<?php echo $this->session->userdata('user'); ?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Password</label>
						<div class="controls">
							<input type="password" name="password" class="form-control" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<div class="controls">
							<input type="password" name="repassword" class="form-control" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Role</label>
						<div class="controls">
							<select name="role" class="form-control">
								<option value="">-- PILIH --</option>
								<option value="admin">ADMIN</option>
								<option value="biro1">BIRO 1</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="form-group">
				<a href="<?php echo base_url().'manajemen/user' ?>" class="btn btn-med gray-bg">Kembali</a>
				<input type="submit" name="submit" class="btn btn-med blue-bg" value="simpan" />
			</div>
		</div>
	</form>
</div>
 