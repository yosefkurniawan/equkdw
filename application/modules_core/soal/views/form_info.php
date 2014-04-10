<?php 
	$cur_semester 	= $last_periode->semester;
	$cur_thn_ajaran = $last_periode->thn_ajaran;

	$explode_thn_ajaran 	= explode('/', $cur_thn_ajaran);	
	$next_thn_ajaran_start	= ((int)$explode_thn_ajaran[0])+1;
	$next_thn_ajaran_end	= ((int)$explode_thn_ajaran[1])+1;
	$next_thn_ajaran 		= $next_thn_ajaran_start.'/'.$next_thn_ajaran_end;
	// $prev_thn_ajaran_start	= ((int)$explode_thn_ajaran[0])-1;
	// $prev_thn_ajaran_end	= ((int)$explode_thn_ajaran[1])-1;
	// $prev_thn_ajaran 		= $prev_thn_ajaran_start.'/'.$prev_thn_ajaran_end;

	if ($form_type == 'edit') {
		$val_thn_ajaran 	= $info_paket->thn_ajaran;
		$val_semester	 	= $info_paket->semester;
		$val_status		 	= $info_paket->status;
	} 
	else{
		if (strtoupper($cur_semester) == 'GENAP') {
			$val_thn_ajaran	= $next_thn_ajaran;
			$val_semester	= 'GASAL';
		}
		else{
			$val_thn_ajaran = $cur_thn_ajaran;
			$val_semester	= 'GENAP';
		}
	}
?>

<input type="hidden" value="<?= $form_type ?>" id="form_type">

<div class="page-header">
	<h1>Pengaturan Paket</h1>
</div>

<div class="alert fade in" id="soal-alert">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<p></p>
</div>

<div class="panel colored" id="box-form-info">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Informasi Paket</h3>
	</div>
	<form role="form" id="form-info" class="form-horizontal left-label">
		<?php if ($form_type=='edit'): ?>
			<input type="hidden" value="<?= $kode ?>" name="id_paket">
		<?php endif ?>
		<div class="panel-body">
			<div class="form-group">
				<label class="control-label col-lg-2">Tahun Ajaran</label>
				<div class="col-lg-6">
					<input type="text" name="thn_ajaran" value="<?=$val_thn_ajaran ?>" disabled class="form-control" id="thn_ajaran">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Semester</label>
				<div class="col-lg-6">
					<input type="text" name="semester" value="<?=$val_semester ?>" disabled class="form-control" id="semester">
				</div>
			</div>
			<?php if ($form_type=='edit'): ?>
			<div class="form-group">
				<label class="control-label col-lg-2">Status</label>
				<div class="col-lg-6">
					<select name="status" class="form-control">
						<option value="draft">Draft</option>
						<option value="public">Public</option>
					</select>
				</div>
			</div>
			<?php else: ?>
				<input type="hidden" name="status" value="draft">
			<?php endif ?>
			<?php if ($form_type=='new'): ?>
			<div class="form-group">
				<label class="control-label col-lg-2">Paket Pertanyaan</label>
				<div class="col-lg-6">
					<label class="radio">
						<input type="radio" checked name="pilih_paket" value='salin'> Salin paket pertanyaan semester sebelumnya
					</label>
					<label class="radio">
						<input type="radio" name="pilih_paket" value='baru'> Buat paket pertanyaan baru
					</label>
				</div>
			</div>
			<?php endif ?>
		</div>
	</form>
	<?php if ($form_type != "view"): ?>
		<div class="panel-footer clearfix">
			<div class="form-group">
				<div class="col-lg-12">
					<a href="javascript:void(0)" class="blue-bg btn" id="save-info">Simpan</a>
					<div id="save-info-loading">
						<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>
