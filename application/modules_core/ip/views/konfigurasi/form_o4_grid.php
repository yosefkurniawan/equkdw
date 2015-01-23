<div id="ip_form_o4">

	<div class="page-header">
	    <h1><strong><?php echo $title ?></strong></h1>
	</div>
	<ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>">Dashboard</a></li>
	    <li class="active"><?php echo $title ?></li>
	</ol>

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
        <div class="col-md-12">
            <div class="panel colored">
                <div class="panel-heading blue-bg">
                    <h3 class="panel-title">Daftar Kelas <?php echo $semester.' - '.$thn_ajaran ?></h3>
                </div>

                <div class="panel-body">
					
					<br/>
					
					<form role="form" id="form-select-prodi" class="form-horizontal" method="GET">
						<div class="form-group">
							<div class="col-lg-1"><label>Prodi</label></div>
							<div class="col-lg-4">
								<select id="select-prodi" name="prodi" class="full-width" onchange="selectProdi(this.value)">
							        <option value="">-- Pilih Prodi --</option>
							        <?php foreach ($list_prodi as $prodi): ?>
							        	<?php $selected = ($selected_prodi == $prodi['prodi'])? 'selected="selected"' : ''; ?>
							        	<option value="<?php echo $prodi['prodi'] ?>" <?php echo $selected ?>><?php echo $prodi['nama_prodi']; ?></option>
							        <?php endforeach ?>
							        <option value="others">Lainnya</option>
							    </select>
							</div>
						</div>
					</form>
                    <?php //echo "<pre>";print_r($list_prodi); ?>
					
					<br/>
					
					<p>Total: <strong><?php echo count($list_matkul) ?></strong> baris</p>

                    <table border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" id="tabelInputO4">
                        <thead>
                            <tr>
                                <th style="text-align:center;vertical-align:middle"><strong>Kode Mtk</strong></th>
                                <th style="text-align:center;vertical-align:middle"><strong>Nama Mtk</strong></th>
                                <th style="text-align:center;vertical-align:middle"><strong>Grup</strong></th>
                                <th style="text-align:center;vertical-align:middle"><strong>NIK</strong></th>
                                <th style="text-align:center;vertical-align:middle"><strong>Status</strong></th>
                                <th style="text-align:center;vertical-align:middle"><strong>Tanggal Masuk</strong></th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if (count($list_matkul) > 0): ?>
                        	<?php foreach ($list_matkul as $matkul): ?>
								<form role="form" id="form-o4-grid" method="POST">
                                	<input type="hidden" name="flag_tepat[]" value="N">
                                	<tr class="row-<?php echo $matkul['kode'] ?>">
                                		<td><?php echo $matkul['kode'] ?></td>
                                		<td><?php echo $matkul['nama_mtk'] ?></td>
                                		<td><?php echo $matkul['grup'] ?></td>
                                		<td><?php echo $matkul['nik'] ?></td>
                                		<td>
                                			<span class="label status label-warning">Belum mengumpulkan</span>
                                			<input type="hidden" name="flag_tepat[]" class="flag_tepat" value="N">
                                		</td>
                                		<td>
                                			<input type="text" class="form-control datepicker" name="tgl_masuk[]" onchange="cekFlagTepat(<?php echo $deadline; ?> , getTimeStamp(this.value), '<?php echo $matkul['kode'] ?>')" />
                                		</td>		
                                	</tr>	
                				</form>
                        	<?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" style="text-align:center">Tidak ada kelas...</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($j) { 

    	// datetime picker
    	jQuery('.datepicker').datetimepicker({
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

    	// check wheter deadline is exist.
    	var deadline = '<?php echo ($deadline)? $deadline: 0 ?>';
    	if (!deadline || deadline=='' || deadline=='0') {
    		alert('Deadline belum disetting.');
    		window.location.href = "<?php echo base_url() ?>";
    	}else{
    		// set status. compare deadline with today for default
	    	var now = new Date();
			var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
			var timestampToday = today/1000;
	    	cekFlagTepat(deadline,timestampToday);
    	}
    });
	
	function selectProdi(prodi) {
		window.location.href = '<?php echo $page_url ?>'+prodi; 
	}

    function getTimeStamp(date) {
    	var myDate = date.split("/");
		var newDate = myDate[1]+"/"+myDate[0]+"/"+myDate[2];
		return new Date(newDate)/1000;
    }

    function cekFlagTepat(deadline,tgl_masuk,kode) {
    	if(tgl_masuk > deadline) {
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').removeClass('label-success').removeClass('label-warning').addClass('label-danger').text('Telat');
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').val('F');
    	}else if (tgl_masuk < deadline) {
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Tepat Waktu');
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').val('T');
    	}else{
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').removeClass('label-danger').removeClass('label-success').addClass('label-warning').text('Belum Mengumpulkan');
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').val('N');
    	}
    }
</script>