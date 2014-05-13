<div class="page-header">
	<h1>Hasil Evaluasi</h1>
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
					<th>Grup</th>
					<th>Terisi</th>
					<th>Pengisi</th>
					<th>% Baik</th>
					<th>Q1</th>
					<th>Q2</th>
					<th>Q3</th>
					<th>Q4</th>
					<th>Q5</th>
					<th>Q6</th>
					<th>Q7</th>
					<th>Q8</th>
					<th>Q9</th>
					<th>Q10</th>
					<th>Q11</th>
					<th>Q12</th>
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
		<p><?= $masukan_dosen ?></p>
	</div>
</div>

<!-- Masukan Matkul -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Masukan Untuk Matakuliah</h3></div>
	<div class="panel-body">
		<dl>
			<?php foreach ($masukan_matkul as $key => $value): ?>
				<dt><?= $value['nama'] ?></dt>
				<dd><?= $value['masukan'] ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
</div>

<a href="<?php echo base_url().'laporan/pdf_hasil_evaluasi_dosen/'.$dosen->nik ?>" class="btn btn-med blue-bg" target="_blank"><i class="icon-print"></i> Print</a>
