<div class="col-md-12">

<h1>Dashboard Daftar Kuisioner</h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<div class="panel colored">
	<div class="panel-heading red-bg">
		<h3 class="panel-title">Status Pengisian Kuisioner Wajib</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
				    <td width="4%">No</td>
				    <td width="41%">Matakuliah</td>
				    <td width="10%">Grup</td>
				    <td width="30%">Status</td>
				    <td width="15%">Action</td>
				</tr>
			</thead>
			<tbody>
		<?php $x = 1; ?>
		<?php foreach ($list_krs as $course): ?>
			<tr>
				<td><?php echo $x; ?></td>
				<td><strong><?php echo $course->nama_matkul ?></strong><br>
					<?php echo $course->nama_dosen ?></td>
				<td><?php echo $course->grup ; ?></td>
				<td>
					<!-- belum waktunya / belum / sudah -->
					<!-- // <?php echo $course->eva_status ?> -->
					<span class="label label-info">tidak ada</span>
					<span class="label label-warning">belum diisi</span>
					<span class="label label-success">sudah diisi</span>
				</td>
				<td>
					<!-- HANYA DITAMPILKAN APABILA : EVA STATUS = 1 , JADWAL PENGISIAN , DAN BELUM MENGISI -->
					<a href="<?=base_url()?>mahasiswa/kuisioner/index/<?=$course->id_kelasb?>" class="purple-bg btn btn-xs showcase-btn"><i class="icon-plus-sign"></i></a>	
			</td>
			</tr>
			<?php $x++; ?>
		<?php endforeach ?>
			</tbody>
		</table>
</diV>



