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
								<strong><?php echo date('d-m-Y', $deadline) ?></strong>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-lg-3"><label>Tgl Masuk</label></div>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="tgl_masuk" id="deadline" value="<?php echo date('d/m/Y') ?>" onchange="cekFlagTepat(<?php echo $deadline; ?> , getTimeStamp(this.value))" />
							</div>
						</div>

						<div class="form-group flag_status">
							<div class="col-lg-3"><label>Status</label></div>
							<div class="col-lg-9">
								<span class="label label-success">Tepat Waktu</span>
								<input type="hidden" name="flag_tepat" value="T">
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
    jQuery(document).ready(function($j) { 
    	jQuery("#select-matkul").select2(); 

    	jQuery('#deadline').datetimepicker({
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


    	// set status. compare deadline with today for default
    	var now = new Date();
		var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
		var timestampToday = today/1000;
    	cekFlagTepat(<?php echo $deadline; ?>,timestampToday);
    });

    function getTimeStamp(date) {
    	var myDate = date.split("/");
		var newDate = myDate[1]+"/"+myDate[0]+"/"+myDate[2];
		return new Date(newDate)/1000;
    }

    function cekFlagTepat(deadline,tgl_masuk) {
    	if(tgl_masuk > deadline) {
    		jQuery('.form-group.flag_status .label').removeClass('label-success').addClass('label-danger').text('Telat');
    		jQuery('.form-group.flag_status input').val('F');
    	}else{
    		jQuery('.form-group.flag_status .label').removeClass('label-danger').addClass('label-success').text('Tepat Waktu');
    		jQuery('.form-group.flag_status input').val('T');
    	}
    }
</script>