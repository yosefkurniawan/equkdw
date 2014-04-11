<div class="col-md-12">

<h1>Form Kuisioner Evaluasi Dosen Matakuliah </h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<div class="panel colored">
	<div class="panel-heading red-bg">
		<h3 class="panel-title">Informasi Umum</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
		Nama Matakuliah : <strong><?=$row_matakuliah->nama_matkul?></strong> <br>
		Grup			: <strong><?=$row_matakuliah->grup?></strong> <br>
		Tahun Ajaran	: <strong><?=$row_matakuliah->thn_ajaran?></strong> <br>
		Semester		: <strong><?=$row_matakuliah->semester?></strong> <br>
		Dosen Pengampu	: <strong><?=$row_matakuliah->nama_dosen?></strong> <br>
		</div>
</diV>

<br><br>

<?php if (validation_errors() != NULL) : ?>
	<div class="alert alert-danger"><strong>Attention Message</strong> : <br> <?php echo validation_errors(); ?> </div>
<?php endif; ?>

<div class="row">
	<div class="panel colored col-md-12">
		<div class="panel-heading blue-bg">
			<h3 class="panel-title">Form Kuisioner Evaluasi Dosen</h3>
		</div>
		<form class="form-horizontal form-bordered left-label" id="basic-validation" name="basic-validation" method="POST" action="<?php echo base_url(); ?>mahasiswa/kuisioner/jawab/<?=$row_matakuliah->id_kelasb?>">
		
		<!-- HIDDEN VALUE -->
		<?php foreach ($list_dosen as $dosen) : ?>
			<input type="hidden" name="input[<?=$dosen->nik?>][nik]" value="<?=$dosen->nik?>">		
			<input type="hidden" name="input[<?=$dosen->nik?>][id_kelasb]" value="<?=$row_matakuliah->id_kelasb?>">		
			<input type="hidden" name="input[<?=$dosen->nik?>][nim]" value="<?=$this->session->userdata('username')?>">				
		<?php endforeach ?>
		
		
			<div class="panel-body no-padding">

			<table class="table table-hover">
				<thead>
					<tr>
					    <td width="20%" rowspan="2">Pertanyaan</td>
						<?php foreach ($list_dosen as $dosen): ?>
						    <td width="20%" colspan="3" style="text-align:center"><?=$dosen->nama_dosen?></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<?php foreach ($list_dosen as $dosen): ?>
						    <td width="7%" style="text-align:center">Tidak Setuju</td>
						    <td width="6%" style="text-align:center">Ragu-ragu</td>
						    <td width="7%" style="text-align:center">Setuju</td>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php $x = 1 ?>
					<?php foreach ($list_soal as $pertanyaan): ?>
					<tr>
						<td><?=$pertanyaan->pertanyaan?></td>
						<?php foreach ($list_dosen as $dosen): ?>
						<td style="text-align:center">
							<input type="radio" id="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" 
							name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="0" >
						</td>
						<td style="text-align:center">
							<input type="radio" id="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" 
							name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="2" >
						</td>
						<td style="text-align:center">
							<input type="radio" id="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" 
							name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="2" >
						</td>
						<!-- <span class="help-block has-error" for="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" generated="false">Harus diisi</span> -->
						<input type="hidden" name="input[<?=$dosen->nik?>][id_paket]" value="<?=$pertanyaan->kode?>">		
						<?php endforeach ?>					
					</tr>
					<?php $x = $x + 1 ?>
					<?php endforeach ?>
				</tbody>
			</table>
			</div>
	</div>
</div>

<br>

<div class="row">
	<div class="panel colored col-md-12">
		<div class="panel-heading blue-bg">
			<h3 class="panel-title">Masukan Tambahan Dosen</h3>
		</div>
			<div class="panel-body no-padding">
				<?php foreach ($list_dosen as $dosen): ?>
				<label class="col-lg-12 control-label"> <strong> <?=$dosen->nama_dosen?> </strong> </label> <br>
				<div class="form-group">
					<label class="col-lg-2 control-label">Masukan Dosen</label>
					<div class="col-lg-10">
						<textarea class="form-control" name="input[<?=$dosen->nik?>][masukan_dosen]"></textarea>
						<span class="help-block">Masukan yang berhubungan dengan dosen misal : cara mengajar. Berikan tanda "-" bila tidak ada</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Masukan Materi</label>
					<div class="col-lg-10">
						<textarea class="form-control" name="input[<?=$dosen->nik?>][masukan_matkul]"></textarea>
						<span class="help-block">Masukan yang berhubungan dengan materi yang diberikan misal : kurang update, dsb. Berikan tanda "-" bila tidak ada</span>
					</div>
				</div>
				<?php endforeach ?>				
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn blue-bg">Submit Kuisioner</button>						
						<a href="<?=base_url()?>mahasiswa/dashboard" class="btn btn-med gray-bg">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

