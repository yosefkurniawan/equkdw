<div id="ip_form_o4">

	<div class="page-header">
	    <h1><strong>Input Tanggal Penyerahan Berkas</strong></h1>
	</div>
	<ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>">Dashboard</a></li>
	    <li class="active">Input Tanggal Penyerahan Berkas</li>
	</ol>

	<form role="form" id="form-o4" class="form-horizontal" method="POST">
		<?php if (isset($alert)): ?>
			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-<?php echo $alert['status'] ?> fade in">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<p><?php echo $alert['msg'] ?></p>
					</div>
				</div>
			</div>
		<?php endif ?>

		<div class="row">
			<div class="panel colored col-md-7 form-box">
				<div class="panel-heading green-bg">
					<h4 class="panel-title">
						Input Tanggal Penyerahan Berkas
					</h4>
				</div>
				<div class="panel-body">
						<div class="form-group">
							<div class="col-lg-3"><label>Batas Akhir</label></div>
							<div class="col-lg-9">
								<strong><?php echo $deadline ?></strong>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-3"><label>Tgl Masuk</label></div>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="tgl_mulai" id="deadline" value="<?php echo date('d/m/Y') ?>" />
							</div>
						</div>

						<div class="form-group">
							<?php
								$timestampDeadline 	= strtotime($deadline);
								$timestampNow 		= strtotime(date('Y-m-d'));
							?>
							<div class="col-lg-3"><label>Status</label></div>
							<div class="col-lg-9">
								<?php if ($timestampNow > $timestampDeadline): ?>
									<span class="label label-danger">Telat</span>
									<input type="hidden" name="flag_tepat" value="F">
								<?php else: ?>
									<span class="label label-success">Tepat Waktu</span>
									<input type="hidden" name="flag_tepat" value="T">
								<?php endif ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-3"><label>Matakuliah</label></div>
							<div class="col-lg-9">
								<select id="select-matkul" name="id_kelasb" class="full-width">
							        <?php foreach ($list_matkul as $key => $matkul): ?>
							        	<option value="<?php echo $matkul['id_kelasb'] ?>"><?php echo $matkul['kode'] . ' - ' . $matkul['nama_mtk'] . '(' . $matkul['grup'] . ')'; ?></option>
							        <?php endforeach ?>
							    </select>
							</div>
						</div>

						<input type="hidden" name="tgl_masuk" value="<?php echo date('Y-m-d') ?>">
				</div>
				<div class="panel-footer clearfix">
					<div class="form-group">
						<div class="col-lg-12">
							<button type="submit"class="btn btn-med blue-bg">Simpan</button> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
    jQuery(document).ready(function($) { 
    	$("#select-matkul").select2(); 

    	$('#deadline').datetimepicker({
	   		lang:'de',
			 i18n:{
			  de:{
			   months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
			   dayOfWeek:['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']
			  }
			 },
			 timepicker:false,
			 format:'d/m/Y'
	   });
		
    });
</script>