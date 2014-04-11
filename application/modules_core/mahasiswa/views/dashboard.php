<?php $today = date("Y-m-d"); ?>
<div class="col-md-12">

<h1>Dashboard Daftar Kuisioner</h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<?php if($message != NULL || $message !='') : ?>
<div class="alert alert-info"> Info : <?php echo $message; ?> </div>
<?php endif ?>

<div class="panel colored">
	<div class="panel-heading red-bg">
		<h3 class="panel-title">Status Pengisian Kuisioner Wajib</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
				    <td width="4%">No</td>
				    <td width="36%">Matakuliah</td>
				    <td width="15%">Grup</td>
				    <td width="10%">Status</td>
				    <td width="20%">Jadwal Pengisian</td>
				    <td width="10%">Action</td>
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
					<?php if ($course->eva_status == 1) : ?>
						<!-- bila ada pengisian -->
						<?php if ($course->jawaban != '-') : ?>
							<span class="label label-success">sudah diisi</span>
						<?php else : ?>
							<span class="label label-warning">belum diisi</span>
						<?php endif ?>
					<?php else : ?>						
						<!-- tidak ada kuisioner untuk matakuliah -->
						<span class="label label-info">tidak ada kuisioner</span>
					<?php endif ?>
				</td>
				<td>
					<?= date('j F Y',strtotime($course->mulai)) ?> - <?= date('j F Y',strtotime($course->akhir)) ?>
				</td>
				<td>
					<?php if ($course->eva_status == 1) : ?>
						<?php if ($today >= $course->mulai AND $today <= $course->akhir) : ?>
							<!-- bila sudah waktunya -->
							<?php if ($course->jawaban == '-') : ?>
								<a href="<?=base_url()?>mahasiswa/kuisioner/jawab/<?=$course->id_kelasb?>" 
									class="blue-bg btn btn-xs showcase-btn"><i class="icon-pencil"></i></a>	
							<?php endif ?>
						<?php else : ?>
							<!-- bila belum waktunya -->
							<span class="label label-info">belum dapat mengisi</span>
						<?php endif ?>
					<?php else : ?>						
						<!-- bila tidak ada -->
						<span class="label label-info">tidak ada kuisioner</span>
					<?php endif ?>

			</td>
			</tr>
			<?php $x++; ?>
		<?php endforeach ?>
			</tbody>
		</table>
</diV>



