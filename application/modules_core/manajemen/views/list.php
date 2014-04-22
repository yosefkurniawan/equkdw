<div class="page-header">
	<h1>Daftar User</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Manajemen User</li>
</ol>


<a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a>

<table class="table table-hover">
	<thead>
	  <tr>
	    <td width="5%">No</td>
	    <td width="30%">Username</td>
	    <td width="30%">Role</td>
	    <td width="15%">Status</td>
	    <td width="10%">Action</td>
	  </tr>
	</thead>
	<tbody>
		<?php $x = 1; ?>
		<?php foreach ($user as $result): ?>
			<tr>
				<td><?php echo $x; ?></td>
				<td><?php echo $result['username'] ?></td>
				<td><?php echo $result['role']; ?></td>
				<td>
					<?php if ( $result['username'] != $this->session->userdata('username') ): ?>
						<?php if ($result['status'] == 'aktif'): ?>
							<a href="<?php echo base_url(); ?>manajemen/user/deactivated/<?php echo $result['id']; ?>" class="btn btn-med blue-bg" onclick="return confirm('Apakah user ini akan dinonaktifkan?');"><?php echo $result['status']; ?></a>
						<?php else: ?>
							<a href="<?php echo base_url(); ?>manajemen/user/activated/<?php echo $result['id']; ?>" class="btn btn-med red-bg" onclick="return confirm('Apakah user ini akan diaktifkan?');"><?php echo $result['status']; ?></a>
						<?php endif ; ?>
					<?php endif ?>
				</td>
				<td>
					<?php if ($result['status'] != 'dihapus'): ?>
					<a href="<?php echo base_url(); ?>manajemen/user/ubah/<?php echo $result['id']; ?>" class="btn btn-med yellow-bg"><i class="icon-">&#xf0ad;</i></a>
					<a href="<?php echo base_url(); ?>manajemen/user/hapus/<?php echo $result['id']; ?>" class="btn btn-med red-bg" onclick="return confirm('Apakah user ini akan dihapus?');"><i class="icon-">&#xf014;</i></a>
					<?php endif ; ?>
				</td>
			</tr>
			<?php $x++; ?>
		<?php endforeach ?>
	</tbody>
</table>