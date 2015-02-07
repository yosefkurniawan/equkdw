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

<!-- <div class="page-header">
    <h1><strong>Tahun Ajaran 2013/2014 "GENAP"</strong></h1>
    <h5>Catatan : Untuk sementara, fasilitas cetak per dosen hanya bisa dilakukan dengan browser CHROME</h5>
</div>
 -->
<!-- <div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($dosen as $key => $prodi): ?>
			<div class="panel-heading black-bg">
				<h4 class="panel-title">
					<span class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" ><?= $prodi['nama_prodi'] ?>						
					</span>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?>ip/ip/rangkuman/<?php echo $prodi['prodi']?>" class="btn btn-info">Cetak Rangkuman</a>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?>ip/ip/export_to_excel/<?php echo $prodi['prodi']?>" class="btn btn-info">Export Ke Excel</a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse in" style="height: auto;">
				<div class="panel-body">
					<ul class="list_dosen list-unstyled">
						<?php foreach ($prodi['listDosen'] as $dsn): ?>
							<li class="col-md-4">
								<?= $dsn['nama_dsn'] ?> <a href ="<?php echo base_url(); ?>ip/ip/detail_dosen_pdf/<?php echo $dsn['nik_baru']?>"><i class="icon-print"></i></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div> -->

<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($listDosenPerUnit as $key => $unit): ?>
			<div class="panel-heading black-bg">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?= $unit['unit'] ?></a>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?>ip/ip/rangkuman/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" class="btn btn-info">Cetak Rangkuman</a>
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() ?>ip/ip/export_to_excel/<?php echo $unit['id_unit']?>/<?php echo $id_paket ?>" class="btn btn-info">Export Ke Excel</a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse in" style="height: auto;">
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
    });
    
</script>
