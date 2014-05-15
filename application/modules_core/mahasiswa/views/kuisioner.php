<?php date_default_timezone_set('Asia/Jakarta');?>
<div class="col-md-12">

<h1>Form Kuisioner Evaluasi Dosen Matakuliah </h1>
<br>

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
	</div>
</div>

<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Kehadiran di Kelas</h3>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			Anda hadir dalam <?=$kehadiran->num_rows()?> dari <?=$pertemuan->num_rows()?> yang diselenggarakan (<?=$presensi?>%)
		</div>
	</div>
<div>

<br><br>

<?php if (validation_errors() != NULL) : ?>
	<div class="alert alert-danger"><strong>Attention Message</strong> : <br> <?php echo validation_errors(); ?> </div>
<?php endif; ?>



<input type="hidden" value="<?= count($list_dosen) ?>" id="jumlah_dosen">

<?php $y = 1 ?>
<?php $aspek = '' ?>
<?php foreach ($list_dosen as $dosen): ?>

<form role="form" class="form-horizontal form-bordered left-label form-kuisioner" id="form-kuisioner-<?= $y ?>">


<div class="row" >

	<div class="panel colored col-md-12" id="box-form-dosen-<?php echo $y?>">
		<div class="panel-heading blue-bg">
			<h3 class="panel-title"><?=$dosen->nama_dosen?></h3>
		</div>
		
		<!-- HIDDEN VALUE -->
			<input type="hidden" name="input[<?=$dosen->nik?>][nik]" class="nik" value="<?=$dosen->nik?>">		
			<input type="hidden" name="input[<?=$dosen->nik?>][id_kelasb]" class="id_kelasb" value="<?=$row_matakuliah->id_kelasb?>">		
			<input type="hidden" name="input[<?=$dosen->nik?>][nim]" class="nim" value="<?=$this->session->userdata('username')?>">				
			<input type="hidden" name="input[<?=$dosen->nik?>][presensi]" class="presensi" value="<?=$presensi?>">				

			<div class="panel-body no-padding">

			<table class="table table-hover">
				<thead>
					<tr>
					    <td width="56%" style="text-align:center"><strong>Aspek Yang dinilai</td>
					    <td ></td>
					    <td width="12%" style="text-align:center"><strong>Setuju</strong></td>
					    <td width="12%" style="text-align:center"><strong>Ragu-ragu</strong></td>
					    <td width="12%" style="text-align:center"><strong>Tidak Setuju</strong></td>
					</tr>
				</thead>
				<tbody>
					<?php $x = 1 ?>
					<?php foreach ($list_soal as $pertanyaan): ?>
					<?php if ($aspek != $pertanyaan->aspek) : ?>
					<tr>
						<td colspan="5" style="text-align:left">						
							<br>
							<strong><?=$pertanyaan->aspek?><strong>
					</td>
					</tr>
					<?php endif;?>
					<?php $aspek = $pertanyaan->aspek ?>
					<tr class="q<?=$pertanyaan->no?>">
						<td>
							<?=$pertanyaan->pertanyaan?><br/>
							<span class="pertanyaan-error-notif" style="display:none">Jawaban tidak boleh kosong!</span>
						</td>
						<td> 
							<i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan->keterangan?>"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 
								
						</td>
						<td style="text-align:center">
							<input type="radio" id="" 
							name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="2" class="a<?=$pertanyaan->no?>"/>
						</td>
						<td style="text-align:center">
							<input type="radio" id="" 
							name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="1" class="a<?=$pertanyaan->no?>" />
						</td>
						<td style="text-align:center">
							<?php if ($presensi < 75) : ?>
								<input type="radio" id="" 
								name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="1" class="a<?=$pertanyaan->no?>" />
							<?php else : ?>
								<input type="radio" id="" 
								name="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" value="0" class="a<?=$pertanyaan->no?>" />
							<?php endif ?>

						</td>

						<!-- <span class="help-block has-error" for="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" generated="false">Harus diisi</span> -->
						<input type="hidden" name="input[<?=$dosen->nik?>][id_paket]" class="id_paket" value="<?=$pertanyaan->kode?>">		
					</tr>
					<?php $x = $x + 1 ?>
					<?php endforeach ?>
				</tbody>
			</table>
			</div>
			<div class="panel-body no-padding">
				<div class="form-group">
					<label class="col-lg-2 control-label"><strong>Masukan untuk Dosen</strong></label>
					<div class="col-lg-10">
						<textarea class="form-control masukan_dosen isi_masukan" name="input[<?=$dosen->nik?>][masukan_dosen]"></textarea>
						<span class="pertanyaan-error-notif"></span>
						<span class="help-block">Masukan yang berhubungan dengan dosen misal : cara mengajar. <br>Berikan tanda "-" bila tidak ada</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"><strong>Masukan mengenai Materi Perkuliahan</strong></label>
					<div class="col-lg-10">
						<textarea class="form-control masukan_matkul isi_masukan" name="input[<?=$dosen->nik?>][masukan_matkul]"></textarea>
						<span class="pertanyaan-error-notif"></span>
						<span class="help-block">Masukan yang berhubungan dengan materi yang diberikan misal : kurang update, dsb. <br>Berikan tanda "-" bila tidak ada</span>
					</div>
				</div>
			</div>
	</div>

</div>

<br><br>

</form>


<?php $y = $y + 1 ?>
<?php endforeach ?>

				<div class="row">
					<div class="col-lg-offset-2 col-lg-10">
					<!-- <a href="javascript:void(0)" class="blue-bg btn" id="submit-kuisioner">Simpan</a> -->
						<a href="javascript:void(0)" class="blue-bg btn" id="save-jawaban">Simpan</a>
						<div id="save-jawaban-loading">
							<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
						</div>
						<a href="<?=base_url()?>mahasiswa/dashboard" class="btn btn-med gray-bg">Batal</a>
					</div>
				</div>

				<div class="jawaban-error-notif"></div>


</div>




