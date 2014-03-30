<?php 
	$cur_semester 	= $last_periode->semester;
	$cur_thn_ajaran = $last_periode->thn_ajaran;

	$explode_thn_ajaran 	= explode('/', $cur_thn_ajaran);	
	$next_thn_ajaran_start	= ((int)$explode_thn_ajaran[0])+1;
	$next_thn_ajaran_end	= ((int)$explode_thn_ajaran[1])+1;
	$next_thn_ajaran 		= $next_thn_ajaran_start.'/'.$next_thn_ajaran_end;
	$prev_thn_ajaran_start	= ((int)$explode_thn_ajaran[0])-1;
	$prev_thn_ajaran_end	= ((int)$explode_thn_ajaran[1])-1;
	$prev_thn_ajaran 		= $prev_thn_ajaran_start.'/'.$prev_thn_ajaran_end;
?>

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
	<form role="form" id="form-info">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode</label>
						<div class="controls">
							<input type="text" name="id_paket" class="form-control" value="<?php echo $kode; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Tahun Ajaran</label>
						<div class="controls">
							<select name="thn_ajaran" class="form-control">
								<option value="<?php echo $prev_thn_ajaran?>"><?php echo $prev_thn_ajaran?></option>
								<option value="<?php echo $cur_thn_ajaran?>" selected><?php echo $cur_thn_ajaran?></option>
								<option value="<?php echo $next_thn_ajaran?>"><?php echo $next_thn_ajaran?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Semester</label>
						<div class="controls">
							<select name="semester" class="form-control">
								<option value="GASAL" <?php echo (strtolower($cur_semester)=="gasal")? 'selected' : ''; ?>>GASAL</option>
								<option value="GENAP" <?php echo (strtolower($cur_semester)=="genap")? 'selected' : ''; ?>>GENAP</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Status</label>
						<div class="controls">
							<select name="status" class="form-control">
								<option value="draft" selected>Draft</option>
								<option value="final">Final</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="panel-footer">
		<div class="form-group">
			<a href="javascript:void(0)" class="blue-bg btn" id="save-info">Simpan</a>
			<div id="save-info-loading">
				<img src="/public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
			</div>
		</div>
	</div>
</div>
 