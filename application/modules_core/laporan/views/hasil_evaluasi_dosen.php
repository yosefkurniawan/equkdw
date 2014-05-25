<div class="page-header">
	<h1>
		Hasil Evaluasi
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?></small>
	</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
	<li><a href="<?= base_url().'laporan' ?>">Hasil Evaluasi</a></li>
	<li class="active"><?= $dosen->nama ?></li>
</ol>

<h4>Dosen : <?= $dosen->gelar_prefix.$dosen->nama.$dosen->gelar_suffix ?> / <?= $dosen->nik ?></h4>

<!-- Hasil evaluasi kelas -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Hasil kuisioner kelas</h3></div>
	<div class="panel-body table-responsive">
		<table class="table table-hover" id="hasil-evaluasi-dosen">
			<thead>
				<tr>
					<td colspan='6'></td>
					<td colspan='12' class="grup-pertanyaan">Index Atas Kuisioner 1 s/d 12</td>
				</tr>
				<tr>
					<th>Kode</th>
					<th>Matakuliah</th>
					<th>Kuisioner</th>
					<th>Grup</th>
					<th>Terisi</th>
					<th>Pengisi</th>
					<th>% Baik</th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[0]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q1</i> </th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[1]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q2</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[2]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q3</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[3]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q4</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[4]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q5</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[5]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q6</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[6]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q7</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[7]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q8</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[8]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q9</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[9]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q10</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[10]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q11</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=$pertanyaan[11]->pertanyaan?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q12</i> </th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($hasil_evaluasi)): ?>
					<tr><td colspan="18" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>
				<?php endif ?>
				<?php foreach ($hasil_evaluasi as $key => $hasil): ?>
					<tr>
						<td><?= $hasil['kode'] ?></td>
						<td><?= $hasil['nama'] ?></td>
						<td><span class="label <?= ($hasil['status_kuisioner']=='Ada')?'label-success':'label-danger' ?>"><?= $hasil['status_kuisioner'] ?></span></td>
						<td><?= $hasil['grup'] ?></td>
						<td><?= $hasil['terisi'] ?></td>
						<td><?= $hasil['pengisi'] ?></td>
						<td><?= $hasil['baik'] ?></td>
						<td><?= $hasil['Q1'] ?></td>
						<td><?= $hasil['Q2'] ?></td>
						<td><?= $hasil['Q3'] ?></td>
						<td><?= $hasil['Q4'] ?></td>
						<td><?= $hasil['Q5'] ?></td>
						<td><?= $hasil['Q6'] ?></td>
						<td><?= $hasil['Q7'] ?></td>
						<td><?= $hasil['Q8'] ?></td>
						<td><?= $hasil['Q9'] ?></td>
						<td><?= $hasil['Q10'] ?></td>
						<td><?= $hasil['Q11'] ?></td>
						<td><?= $hasil['Q12'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Masukan Dosen -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Masukan Untuk Dosen</h3></div>
	<div class="panel-body">
		<dl>
			<?php foreach ($hasil_evaluasi as $key => $value): ?>
				<dt><?= $value['nama'] ?></dt>
				<dd><?= $value['masukan_dosen'] ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
</div>

<!-- Masukan Matkul -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Masukan Untuk Matakuliah</h3></div>
	<div class="panel-body">
		<dl>
			<?php foreach ($hasil_evaluasi as $key => $value): ?>
				<dt><?= $value['nama'] ?></dt>
				<dd><?= $value['masukan_matkul'] ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
</div>
<?php echo $btn_print; ?>