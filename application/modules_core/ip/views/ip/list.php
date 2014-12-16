
<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">IP Dosen</li>
</ol>

<div class="page-header">
    <h1><strong>Tahun Ajaran 2013/2014 "GENAP"</strong></h1>
    <h5>Catatan : Untuk sementara, fasilitas cetak per dosen hanya bisa dilakukan dengan browser CHROME</h5>
</div>

<div class="panel-body">
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
</div>