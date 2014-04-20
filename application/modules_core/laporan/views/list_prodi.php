<div class="page-header">
	<h1>Laporan<small>Pilih prodi</small></h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Laporan</li>
</ol>
<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored">
			<?php foreach ($list_prodi as $key => $prodi): ?>
			<div class="panel-heading brown-bg">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"><?= $prodi['unit'] ?></a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>