<h1>Daftar User</h1>

<a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a>

<table class="metro-table">
	<thead>
	  <tr>
	    <td width="4%">No</td>
	    <td width="31%">Username</td>
	    <td width="30%">Role</td>
	    <td width="20%">Status</td>
	    <td width="15%">Action</td>
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
					<?php if ($result['status'] == 'aktif'): ?>
						<a href="<?php echo base_url(); ?>manajemen/user/deactivated/<?php echo $result['id']; ?>" class="btn btn-med blue-bg" onclick="return confirm('Apakah user ini akan dinonaktifkan?');"><?php echo $result['status']; ?></a>
					<?php elseif ($result['status'] == 'tidak aktif') : ?>
						<a href="<?php echo base_url(); ?>manajemen/user/activated/<?php echo $result['id']; ?>" class="btn btn-med yellow-bg" onclick="return confirm('Apakah user ini akan diaktifkan?');"><?php echo $result['status']; ?></a>
					<?php else : ?>
						<a class="btn btn-med red-bg"><?php echo $result['status']; ?></a>
					<?php endif ; ?>
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
	<tfoot>
	  <tr>
	    <td colspan="4"><ul class="pagination pull-right hidden-xs">
	        <li><a href="#"><i class="icon-">&#xf104;</i></a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li>...</li>
	        <li><a href="#">17</a></li>
	        <li><a href="#"><i class="icon-">&#xf105;</i></a></li>
	      </ul></td>
	  </tr>
	</tfoot>
</