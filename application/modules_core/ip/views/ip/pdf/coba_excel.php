<?php

$string = preg_replace('/\s+/', '_', $prodi->nama_prodi);

$title = 'Laporan_Rangkuman_IP_Dosen_'.$string.'_2013_2014_Genap';

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pembuatan Laporan</title>

   <style>
    	.grup-pertanyaan {
			text-align: center;
			border: solid 1px #000;
		}
		table td {
			border-bottom: solid 0.5px #000;
			font-size: 12pt;
			vertical-align:middle;
			line-height:40px;
		}
		.keterangan_pertanyaan {
			font-size: 8pt;
		}
		table .nama_matkul{
			text-transform:capitalize;
		}
		table {
			width: 100%;
		}
		table .header {
			background-color: yellow;			
			border-bottom: solid 0.5px #000;
			font-weight: bold;
			vertical-align:middle;
			line-height:40px;
		}
		.center {
			text-align:center;
		}
		.right {
			text-align:right;			
		}
		.italic {
			font-style:italic;
		}
    </style>

</head>

<body>
	<table>
		<tr>
			<td colspan="6" style="text-align:center;border-bottom:none;"><strong>Universitas Kristen Duta Wacana</strong></td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:center;border-bottom:none;"><strong>Laporan Rangkuman IP Dosen</strong></td>
		</tr>
	</table>

	<br/>
	<strong>Tahun Ajaran : </strong> 2014/2015 
	<br/>
	<strong>Periode :</strong> Genap
	<br/>
	<strong>Program Studi :</strong> <?php echo $prodi->nama_prodi ?>
	<br/>
	<br/>
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr class="header">
					<th style="text-align:left;">NIK</th>
					<th style="text-align:left;">Nidn</th>
					<th style="text-align:left;">Nama Dosen</th>
					<th style="text-align:right;width:100px">Total IP</th>
					<th style="text-align:right;width:100px">Total Mtk</th>
					<th style="text-align:right;width:100px">IP Dosen</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($list_ip_dosen_prodi as $dosen) : ?>
			<tr>
			    <td style="text-align:left;width:150px"> <?php echo $dosen->nik_baru ?></td>
			    <td style="text-align:left;width:150px"> <?php echo $dosen->nidn ?></td>
			    <td style="text-align:left;width:300px"> <?php echo $dosen->nama_dsn ?></td>
			    <td style="text-align:right;width:100px"> <?php echo $dosen->total_ip ?></td>
			    <td style="text-align:right;width:100px"> <?php echo $dosen->jmlh_mtk ?></td>
			    <td style="text-align:right;width:100px"> <?php echo $dosen->ip_dosen ?></td>
			</tr>	
		<?php endforeach; ?>		
		</tbody>
		</table>
	</div>
</body>
</html>