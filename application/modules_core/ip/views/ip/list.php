<div class="page-header">
	<h1>
		Laporan IP Dosen
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?> &nbsp; <a href="" id="change-period"> <i class="icon-cog"></i></a> &nbsp;
		<select id="id_paket" style="width:160px;display:none">
			<?php foreach($paket_list as $item) : ?>
				<option value="<?php echo $item['id_paket']?>">
					<?php echo $item['thn_ajaran']?> <?php echo $item['semester']?></option>
			<?php endforeach; ?>
		</select>
		&nbsp;&nbsp;<a href="#" id="change_period_process" style="display:none"><i class='icon-save'> </i></a>
		&nbsp;&nbsp;<a href="#" id="tutup_period_form" style="display:none"><i class='icon-remove'> </i></a>
		</small>
	</h1>
</div>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">IP Dosen</li>
</ol>



<div class="panel-body">

    <?php if (!isset($this->session->userdata['unit_kepala_unit'])) : ?>
	<div class="row">
		<div class="form-group">
			<div class="col-lg-2"><label>Prodi Dosen</label></div>
			<div class="col-lg-4">
				<select id="select-prodi" name="prodi" class="full-width">
			        <option value="semua" selected>Semua Unit</option>
				        <?php foreach ($listDosenPerUnit as $key => $unit): ?>
				        	<option value="<?php echo $unit['id_unit'] ?>"><?php echo $unit['unit']; ?></option>
				        <?php endforeach ?>			
			    </select>
			</div>
		</div>
	</div>
    <?php endif; ?>			        

	<br/>
	<br/>

	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($listDosenPerUnit as $key => $unit): ?>
				<?php if (!isset($this->session->userdata['unit_kepala_unit'])) : ?>
					<div class="panel-heading black-bg header-unit <?= $key ?>" value="<?php echo $unit['id_unit']?>">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?= $unit['unit'] ?></a>
							<a href="<?php echo base_url() ?>ip/ip/rangkuman/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
							class="btn btn-info btn-xs pull-right" target="_blank" style="margin-left:10px;">Cetak Rangkuman</a>
							<a href="<?php echo base_url() ?>ip/ip/export_to_excel/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
							class="btn btn-info btn-xs pull-right" style="margin-left:10px;">Export Ke Excel</a>
							<a href="<?php echo base_url() ?>ip/ip/detail_dosen_perprodi_pdf/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
							class="btn btn-info btn-xs pull-right" target="_blank" style="margin-left:10px;">Print Semua Dosen</a>
						</h4>
					</div>
					<div id="collapse-<?= $key ?>" class="panel-collapse in subheader-unit <?= $key ?>" style="height: auto;" value="<?php echo $unit['id_unit']?>">
						<div class="panel-body">
							<ul class="list_dosen list-unstyled">
								<?php foreach ($unit['listDosen'] as $dosen): ?>
									<li class="col-md-4">
										<?= $dosen['gelar_prefix']." ".$dosen['nama']." ".$dosen['gelar_suffix'] ?> 
										<a href ="<?php echo base_url(); ?>ip/ip/detail_dosen_pdf/<?php echo $dosen['nik']?>/<?php echo $id_paket ?>"
										target="_blank"><i class="icon-print"></i></a>
										<a href ="<?php echo base_url(); ?>ip/ip/login_as/<?php echo $dosen['nik']?>/<?php echo $id_paket ?>"
										target="_blank"><i class="icon-eye-open"></i></a>							
										
									</li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
				<?php else : ?>
					<?php if ($key == $this->session->userdata['unit_kepala_unit']) : ?>
						<div class="panel-heading black-bg header-unit <?= $key ?>" value="<?php echo $unit['id_unit']?>">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?= $unit['unit'] ?></a>
								<a href="<?php echo base_url() ?>ip/ip/rangkuman/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
								class="btn btn-info btn-xs pull-right" target="_blank" style="margin-left:10px;">Cetak Rangkuman</a>
								<a href="<?php echo base_url() ?>ip/ip/export_to_excel/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
								class="btn btn-info btn-xs pull-right" style="margin-left:10px;">Export Ke Excel</a>
								<a href="<?php echo base_url() ?>ip/ip/detail_dosen_perprodi_pdf/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" 
								class="btn btn-info btn-xs pull-right" target="_blank" style="margin-left:10px;">Print Semua Dosen</a>
							</h4>
						</div>
						<div id="collapse-<?= $key ?>" class="panel-collapse in subheader-unit <?= $key ?>" style="height: auto;" value="<?php echo $unit['id_unit']?>">
							<div class="panel-body">
								<ul class="list_dosen list-unstyled">
									<?php foreach ($unit['listDosen'] as $dosen): ?>
										<li class="col-md-4">
											<?= $dosen['gelar_prefix']." ".$dosen['nama']." ".$dosen['gelar_suffix'] ?> 
											<a href ="<?php echo base_url(); ?>ip/ip/detail_dosen_pdf/<?php echo $dosen['nik']?>/<?php echo $id_paket ?>"
											target="_blank"><i class="icon-print"></i></a>
											<a href ="<?php echo base_url(); ?>ip/ip/login_as/<?php echo $dosen['nik']?>/<?php echo $id_paket ?>"
											target="_blank"><i class="icon-eye-open"></i></a>							
											
										</li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>					
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach ?>
		</div>
	</div>
</div>

<script>
	CI_ROOT = "<?php echo base_url() ?>";

    jQuery(document).ready(function() {   
		jQuery('#change-period').on('click',function(){
			jQuery('#id_paket').show();
			jQuery('#change_period_process').show();
			jQuery('#tutup_period_form').show();
			return false;
		});	    
		jQuery('#tutup_period_form').on('click',function(){
			jQuery(this).hide();
			jQuery('#change_period_process').hide();
			jQuery('#id_paket').hide();
			return false;
		});	    
		jQuery('#change_period_process').on('click',function(){
			var nik = jQuery('#nik').val();
			var id_paket = jQuery('#id_paket').val();
			var admin = jQuery('#isAdmin').val();
			window.location.replace(CI_ROOT+'ip/ip/index/'+id_paket);
			return false;
		});	   

		var keyword;
		var recent;
		// jQuery('#keyword-o1-btn').on('click',function(){
		jQuery('#select-prodi').on('change',function(){
			
			keyword = jQuery(this).val();
	
			if (keyword == "semua") {
				jQuery('div.header-unit').each(function(){
					jQuery(this).show();								
				});
				jQuery('div.subheader-unit').each(function(){
					jQuery(this).show();								
				});
				return false;
			}
			
			jQuery('div.header-unit').each(function(){
				jQuery('div.header-unit').each(function(){
					recent = jQuery(this).attr('value');
					if (recent == keyword) {
						jQuery(this).show();														
					} else {
						jQuery(this).hide();								
					}
					
				});
				jQuery('div.subheader-unit').each(function(){
					recent = jQuery(this).attr('value');
					if (recent == keyword) {
						jQuery(this).show();														
					} else {
						jQuery(this).hide();								
					}
				});
				return false;

			});
			return false;
	
		});
		
		
		 
    });
    
</script>
