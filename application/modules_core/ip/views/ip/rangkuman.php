<div class="col-md-12">

<h1>Rangkuman IP Dosen Prodi : .... (2013/2014 GENAP)</h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<div class="panel colored">
	<div class="panel-heading blue-bg">
		<h3 class="panel-title">Daftar Dosen</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
				    <td width="15%">NIK</td>
				    <td width="20%">Nama Dosen</td>
				    <td width="7%">Total IP</td>
				    <td width="7%">Jumlah Mtk</td>
				    <td width="7%">IP Final</td>
				    <!-- <td width="44%"></td> -->
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list_ip_dosen_prodi as $dosen): ?>
				<tr>
				    <td width="15%"><?php echo $dosen->nik_baru?> / <?php if($dosen->nidn != '') : echo $dosen->nidn; else : echo '-'; endif; ?></td>
				    <td width="20%"><?php echo $dosen->nama_dsn?> </td>
				    <td width="7%" style="text-align:right"><?php echo $dosen->total_ip?> </td>
				    <td width="7%" style="text-align:center"><?php echo $dosen->jmlh_mtk?> </td>
				    <td width="7%" style="text-align:right"><?php echo $dosen->ip_dosen?> </td>
				    <!-- <td width="44%"></td> -->
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>

	</div>
</div>