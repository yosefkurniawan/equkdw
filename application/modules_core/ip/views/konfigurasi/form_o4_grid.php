<div id="ip_form_o4">

	<div class="page-header">
	    <h1><strong><?php echo $title ?></strong></h1>
	</div>
	<ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>">Dashboard</a></li>
	    <li class="active"><?php echo $title ?></li>
	</ol>

	<?php if ($this->session->flashdata('alert')): ?>
		<?php  
			$alert = $this->session->flashdata('alert');
		?>
		<?php if (count($alert['status'])): ?>
			<?php foreach ($alert['status'] as $key => $value): ?>			
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-<?php echo $value ?> fade in">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<p><?php echo $alert['msg'][$key] ?></p>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		<?php endif ?>
	<?php endif ?>

	<div class="row">
        <div class="col-md-12">
            <div class="panel colored">
                <div class="panel-heading blue-bg">
                    <h3 class="panel-title">Daftar Kelas</h3>
                </div>

                <div class="panel-body">
					
					<br/>
					
					<form role="form" id="form-periode-prodi" class="form-horizontal" method="GET">
						<div class="form-group">
							<div class="col-lg-2"><label>Semester</label></div>
							<div class="col-lg-4">
								<select id="select-prodi" name="semester" class="full-width">
							        <option value="GASAL" <?php echo (strtoupper($semester) == 'GASAL')? 'selected="selected"' : ''; ?>>GASAL</option>
							        <option value="GENAP" <?php echo (strtoupper($semester) == 'GENAP')? 'selected="selected"' : ''; ?>>GENAP</option>
							    </select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"><label>Tahun Ajaran</label></div>
							<div class="col-lg-4">
								<?php  
								$thn_ajaran_exp = explode('/', $last_thn_ajaran);
								$thn_ajaran_a	= $thn_ajaran_exp[0];
								$thn_ajaran_b	= $thn_ajaran_exp[1];
								?>
								<select id="select-prodi" name="thn_ajaran" class="full-width">
							        <?php for ($i=1; $i >= 0; $i--): ?>
							        	<option value="<?php echo ((int)$thn_ajaran_a - $i) .'-'. ((int)$thn_ajaran_b - $i) ?>" 
								        	<?php echo (((int)$thn_ajaran_a - $i) .'/'. ((int)$thn_ajaran_b - $i) == $thn_ajaran)? 'selected="selected"': '' ?> >
								        	<?php echo ($thn_ajaran_a - $i) .'/'. ($thn_ajaran_b - $i) ?>
								        </option>
							        <?php endfor ?>
							    </select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"><label>Prodi</label></div>
							<div class="col-lg-4">
								<select id="select-prodi" name="prodi" class="full-width">
							        <option value="">-- Pilih Prodi --</option>
							        <?php foreach ($list_prodi as $prodi): ?>
							        	<?php $selected = ($selected_prodi == $prodi['prodi'])? 'selected="selected"' : ''; ?>
							        	<option value="<?php echo $prodi['prodi'] ?>" <?php echo $selected ?>><?php echo $prodi['nama_prodi']; ?></option>
							        <?php endforeach ?>
							        <option value="others" <?php echo ($selected_prodi == 'others')? 'selected="selected"' : ''; ?>>Lainnya</option>
							    </select>
							</div>
						</div>
	                    <button type="submit"class="btn btn-med blue-bg">Reset</button> 
					</form>
                    <?php //echo "<pre>";print_r($list_prodi); ?>
					
					<br/>
					<br/>
					
					<p>Total: <strong><?php echo count($list_matkul) ?></strong> baris</p>

					<form role="form" id="form-o4-grid" method="POST">
	                    <table border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" id="tabelInputO4">
	                        <thead>
	                            <tr>
	                                <th style="text-align:center;vertical-align:middle"><strong>Kode Mtk</strong></th>
	                                <th style="text-align:center;vertical-align:middle"><strong>Nama Mtk</strong></th>
	                                <th style="text-align:center;vertical-align:middle"><strong>Grup</strong></th>
	                                <th style="text-align:center;vertical-align:middle"><strong>NIK</strong></th>
	                                <th style="text-align:center;vertical-align:middle"><strong>Status</strong></th>
	                                <th style="text-align:center;vertical-align:middle"><strong>Tanggal Masuk</strong></th>
	                                <th></strong></th>
	                            </tr>
	                        </thead>

	                        <tbody>
	                        <?php if (count($list_matkul) > 0): ?>
	                        	<?php foreach ($list_matkul as $matkul): ?>
                                	<input type="hidden" name="prodi" value="<?php echo $selected_prodi ?>">
                                	<input type="hidden" name="semester" value="<?php echo $semester ?>">
                                	<input type="hidden" name="thn_ajaran" value="<?php echo $thn_ajaran ?>">
                                	<input type="hidden" name="id_kelasb[]" value="<?php echo $matkul['id_kelasb'] ?>">
                                	<input type="hidden" name="kode[]" value="<?php echo $matkul['kode'] ?>">
                                	<input type="hidden" name="grup[]" value="<?php echo $matkul['grup'] ?>">
                                	<tr class="row-<?php echo $matkul['kode'] ?>">
                                		<td><?php echo $matkul['kode'] ?></td>
                                		<td><?php echo $matkul['nama_mtk'] ?></td>
                                		<td><?php echo $matkul['grup'] ?></td>
                                		<td><?php echo $matkul['nik'] ?></td>
                                		<td>
                                			<?php $flag_tepat = ($matkul['flag_tepat'])? $matkul['flag_tepat'] : 'N'; ?>
                                			<?php if ($flag_tepat == 'N'): ?>
	                                			<span class="label status label-warning">Belum mengumpulkan</span>                            				
                                			<?php elseif ($flag_tepat == 'T') : ?>
	                                			<span class="label status label-success">Tepat Waktu</span>                            				
                                			<?php else: ?>
	                                			<span class="label status label-danger">Telat</span>                            				
                                			<?php endif ?>
                                			<input type="hidden" name="flag_tepat[]" class="flag_tepat" value="<?php echo $flag_tepat ?>">
                                		</td>
                                		<td>
                                			<?php  
                                				$tgl_masuk = '';
	                                			if ($matkul['tgl_masuk']) {
	                                				$_tgl_masuk = explode('-', $matkul['tgl_masuk']);
	                                				$tgl_masuk 	= $_tgl_masuk[2].'/'.$_tgl_masuk[1].'/'.$_tgl_masuk[0];
	                                			}
                                			?>
                                			<input type="text" class="form-control datepicker" name="tgl_masuk[]" value="<?php echo $tgl_masuk ?>" onchange="cekFlagTepat(<?php echo $deadline; ?> , getTimeStamp(this.value), '<?php echo $matkul['kode'] ?>')" />
                                		</td>
                                		<td style="text-align:center;vertical-align:middle">
                    						<a href="javascript:void(0)" class="btn btn-med blue-bg"><i class="icon-save"></i></a> 
                                		</td>		
                                	</tr>	
	                        	<?php endforeach ?>
	                        <?php else : ?>
	                            <tr>
	                                <td colspan="7" style="text-align:center">Tidak ada kelas...</td>
	                            </tr>
	                        <?php endif; ?>
	                        </tbody>
	                    </table>
                    
	                    <?php if (count($list_matkul) > 0): ?>
	                    	<button type="submit"class="btn btn-med blue-bg">Simpan Semua</button> 
	                    <?php endif; ?>
	                </form>
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

    	jQuery('#form-o4-grid').submit(function(e) {
    		saveAll(e);
    	})
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
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.flag_tepat').val('F');
    	}else if (tgl_masuk < deadline) {
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Tepat Waktu');
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.flag_tepat').val('T');
    	}else{
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.status').removeClass('label-danger').removeClass('label-success').addClass('label-warning').text('Belum Mengumpulkan');
    		jQuery('#tabelInputO4').find('.row-'+kode).find('.flag_tepat').val('N');
    	}
    }

    function saveAll(e) {
    	var countNull = 0;
    	jQuery('#tabelInputO4 tr .datepicker').each(function() {
    		if (jQuery(this).val()) {
    			countNull++;
    		};
    	})

    	var r = confirm("Anda akan menyimpan "+countNull+" dari "+<?php echo count($list_matkul) ?>);
		if (!r) {
		    e.preventDefault();
		    return false;
		}
    }
</script>