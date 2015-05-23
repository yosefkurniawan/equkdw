<div class="page-header">
	<h1>Pengaturan Akun</h1>
</div>
<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Ubah Password</h3>
	</div>
	<?php echo $this->session->flashdata('message'); ?>
	<form method="POST" action="<?php echo base_url(); ?>account/proses_pengaturan_akun">
		<input type="hidden" name="user" value="<?php echo $this->session->userdata('username'); ?>">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Password Lama</label>
						<div class="controls">
							<input type="password" name="oldpassword" class="form-control" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Password Baru</label>
						<div class="controls">
							<input type="password" name="password" class="form-control" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Konfirmasi Password Baru</label>
						<div class="controls">
							<input type="password" name="repassword" class="form-control" value="" />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="form-group">
				<input type="submit" name="submit" class="btn btn-med blue-bg" value="simpan" />
			</div>
		</div>
	</form>
</div>
 