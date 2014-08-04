
<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">IP Dosen</li>
</ol>

<div class="page-header">
    <h1>Tahun Ajaran 2013/2014 "GENAP"</h1>
</div>

<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($dosen as $key => $prodi): ?>
			<div class="panel-heading green-bg">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"><?= $prodi['nama_prodi'] ?></a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse collapse" style="height: 0px;">
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