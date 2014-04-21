<div class="page-header">
	<h1>Hasil Evaluasi</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
	<li class="active">Hasil Evaluasi</li>
</ol>
<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($listDosenByProdi as $key => $prodi): ?>
			<div class="panel-heading green-bg">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"><?= $prodi['unit'] ?></a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<ul class="list_dosen list-unstyled">
						<?php foreach ($prodi['listDosen'] as $dosen): ?>
							<li class="col-md-4">
								<a href="<?= base_url().'laporan/hasil_evaluasi_dosen/'.$dosen['nik'] ?>"><?= $dosen['gelar_prefix'].$dosen['nama'].$dosen['gelar_suffix'] ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>