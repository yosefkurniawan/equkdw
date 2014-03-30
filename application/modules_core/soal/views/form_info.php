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
	<h1>Pengaturan Paket Pertanyaan</h1>
</div>
<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Informasi Paket</h3>
	</div>
	<form role="form">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Kode</label>
						<div class="controls">
							<input type="text" class="form-control" value="<?php echo $kode; ?>">
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
								<option value="draft">Final</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="panel-footer">
		<div class="form-group">
			<a href="#" class="btn btn-med blue-bg">Simpan</a> 
			<div id="save-info-loading">
				<img src="/public/assets/images/spinner.gif" alt="Saving..." title="Saving..." />Saving...
			</div>
		</div>
	</div>
</div>
 