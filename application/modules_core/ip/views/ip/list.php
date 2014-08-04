
<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">IP Dosen</li>
</ol>

<div class="page-header">
    <h1>Tahun Ajaran 2013/2014 "GENAP"</h1>
</div>

	<table class="table">
		<thead>
			<th><strong>Nama Dosen</strong></th>
			<th><strong>Lihat Laporan</strong></th>
		</thead>
		<tbody>
		<?php $i=0; while($i < count($dosen)) : ?>
			<tr>
				<td><?php echo $dosen[$i]->nama_dsn ?></td>
				<td><a href ="<?php echo base_url(); ?>ip/ip/detail_dosen_pdf/<?php echo $dosen[$i]->nik_baru?>">Lihat Laporan</a> </td>
			</tr>
		<?php $i++; endwhile; ?>
		</tbody>
	</table>