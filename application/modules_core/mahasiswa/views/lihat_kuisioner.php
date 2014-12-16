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
						</td>
						<td> 
							<i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan->keterangan?>"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 
								
						</td>
						<?php $jwb = 'a'.$x; ?>
						<td style="text-align:center">
							<?php if($dosen->$jwb == "2") : ?> 
							<i class="icon-ok"></i>					
							<?php else : ?>
							<i class="icon-remove"></i>					
							<?php endif; ?>
						</td>
						<td style="text-align:center">
							<?php if($dosen->$jwb == "1") : ?> 
							<i class="icon-ok"></i>					
							<?php else : ?>
							<i class="icon-remove"></i>					
							<?php endif; ?>
						</td>
						<td style="text-align:center">
							<?php if($dosen->$jwb == "0") : ?> 
							<i class="icon-ok"></i>					
							<?php else : ?>
							<i class="icon-remove"></i>					
							<?php endif; ?>
						</td>

						<!-- <span class="help-block has-error" for="input[<?=$dosen->nik?>][a<?=$pertanyaan->no?>]" generated="false">Harus diisi</span> -->
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
							<?= $dosen->masukan_dosen ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label"><strong>Masukan mengenai Materi Perkuliahan</strong></label>
					<div class="col-lg-10">
							<?= $dosen->masukan_matkul ?>
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
						<a href="<?=base_url()?>mahasiswa/dashboard" class="btn btn-med blue-bg">Kembali</a>
					</div>
				</div>
				<br><br><br>

</div>




