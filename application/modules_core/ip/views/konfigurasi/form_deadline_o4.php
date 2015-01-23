<div id="ip_form_deadline_o4">

	<div class="page-header">
	    <h1><strong><?php echo $title ?></strong></h1>
	</div>
	<ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>">Dashboard</a></li>
	    <li class="active"><?php echo $title ?></li>
	</ol>

	<form role="form" id="form-deadline-o4" class="form-horizontal" method="POST">
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
						<?php echo $title ?> Periode <?php echo $semester.' - '.$thn_ajaran ?>
					</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-lg-3"><label>Deadline</label></div>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="deadline" id="deadline" value="<?php echo $deadline ?>" placeholder="Masukkan tanggal..." />
						</div>
					</div>
				</div>
				<div class="panel-footer clearfix">
					<div class="form-group">
						<div class="col-lg-12">
							<button type="submit" class="btn btn-med blue-bg">Simpan</button> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($j) { 

    	jQuery('#deadline').datetimepicker({
	   		lang:'de',
			 i18n:{
			  de:{
			   months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
			   dayOfWeek:['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']
			  }
			 },
			 timepicker:false,
			 format:'d/m/Y'
	   });

    	jQuery('#form-deadline-o4').submit(function(e) {
    		var deadline = '<?php echo $deadline ?>';
	    	if (deadline) {
	    		if (confirm("Anda yakin ingin mengubah deadline?")) {
	    			return true;
	    		}else{
	    			return false;
	    		}
	    	}else{
	    		return true;
	    	}
    	}) 
    });
</script>