<?php date_default_timezone_set('Asia/Jakarta');?>
<?php $today = date("Y-m-d"); ?>
<?php 

	$x = 0; $y = 0; $percent = 0;
	foreach ($list_krs as $course) {
		if ($course->jawaban != '-' AND $course->eva_status == 1) {
			$x = $x + 1;
		}
		if ($course->eva_status == 1) {
			$y = $y + 1;
		}
	}
	if ($y == 0) {
		$percent = 100;
	} else {
		$percent = ($x / $y) * 100;
	}
?>
<div class="col-md-12">

<h1>Dashboard Daftar Kuisioner</h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<?php if($message != NULL || $message !='') : ?>
<div class="alert alert-info"> Info : <?php echo $message; ?> </div>
<?php endif ?>

<div class="panel colored">
	<div class="panel-heading blue-bg">
		<h3 class="panel-title">Informasi Umum</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-3">
		Tahun Ajaran	: <strong><?=$thn_ajaran->thn_ajaran?></strong> 
		</div>
		<div class="col-md-3">
		Semester		: <strong><?=$thn_ajaran->semester?></strong> <br>
		</div>
		<div class="col-md-6">
		<?php if ($percent == 100) : ?>
			Selamat! Anda sudah mengisi semua kuisioner wajib yang ada!<br> 
		<?php else : ?>
			Anda sudah mengisi	<strong> <?= $x ?> </strong> dari <strong> <?= $y ?> </strong> Matakuliah yang memiliki Kuisioner untuk diisi&nbsp;(<strong><?=$percent?>%</strong>)<br> 
		<?php endif; ?>
		</div>

	</div>
</div>


<div class="panel colored">
	<div class="panel-heading red-bg">
		<h3 class="panel-title">Kuisioner Wajib</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
				    <td width="25%">Matakuliah</td>
				    <td width="5%">Grup</td>
				    <td width="5%">Status</td>
				    <td width="10%">Jadwal Pengisian</td>
				    <td width="10%">Action</td>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($list_krs as $course): ?>
			<tr>
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
					<?php if ($course->eva_status == 0) : ?>					
						<span class="label label-info">tidak ada jadwal</span>						
					<?php elseif ($course->status == 'public') : ?>					
						<?= date('j F Y',strtotime($course->mulai)) ?> - <?= date('j F Y',strtotime($course->akhir)) ?>
					<?php elseif ($course->status == 'draft') : ?>					
						<span class="label label-info">belum ada informasi</span>						
					<?php elseif ($course->status == 'end') : ?>					
						<span class="label label-info">jadwal pengisian berakhir</span>						
					<?php endif ?>
				</td>
				<td>
					<?php if ($course->status == 'public') : ?>
						<?php if ($course->eva_status == 1) : ?>
							<?php if ($today >= $course->mulai AND $today <= $course->akhir) : ?>
								<!-- bila sudah waktunya -->
								<?php if ($course->jawaban == '-') : ?>
									<a href="<?=base_url()?>mahasiswa/kuisioner/jawab/<?=$course->id_kelasb?>" 
										class="blue-bg btn btn-xs showcase-btn"><i class="icon-pencil"></i></a>	
								<?php elseif ($course->jawaban != '-') : ?>
									Telah Diisi pada tanggal <br> <?= date('j F Y',strtotime($course->tanggal_pengisian)) ?>
								<?php endif ?>

							<?php else : ?>
								<!-- bila belum waktunya -->
								<span class="label label-info">belum dapat mengisi</span>
							<?php endif ?>
						<?php else : ?>						
							<!-- bila tidak ada -->
							<span class="label label-info">tidak ada kuisioner</span>
						<?php endif ?>
					<?php elseif ($course->status == 'draft') : ?>
							<span class="label label-info">belum dapat mengisi</span>
					<?php endif ?>					
				</td>
			</tr>
		<?php endforeach ?>
			</tbody>
		</table>
</diV>

<br>

<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Kuisioner Tambahan</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<h1>Coming Soon</h1>
		<div>

	</div>
</div>


