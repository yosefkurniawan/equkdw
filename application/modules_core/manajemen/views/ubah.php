<div class="page-header">
	<h1>Ubah Role User</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url() ?>manajemen/user">Manajemen User</a></li>
	<li class="active">Ubah role user</li>
</ol>
<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Informasi User</h3>
	</div>
	<form method="POST" action="<?php echo base_url(); ?>manajemen/user/ubah_proses">
		<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
		<input type="hidden" name="id" value="<?php echo $user['id']; ?>">
		<div class="panel-body">
			<?php echo $this->session->userdata('message'); ?>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<label>Username</label>
						<div class="controls">
							<input class="form-control" type="text" disabled value="<?= $user['username'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Role</label>
						<div class="controls">
							<select name="role" class="form-control">
								<option value="">-- PILIH --</option>
								<option value="admin" <?php $user['role'] == 'admin' ? print "selected='selected'" : '' ?>>ADMIN</option>
								<option value="biro1" <?php $user['role'] == 'biro1' ? print "selected='selected'" : '' ?>>BIRO 1</option>
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
 