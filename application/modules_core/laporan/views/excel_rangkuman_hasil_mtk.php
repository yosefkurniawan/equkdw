<?php

$string = preg_replace('/\s+/', '_', $unit['unit']);
$thn = preg_replace('/\s+/', '_', $periode['thn_ajaran']);

$title = 'Laporan_Rangkuman_Pengisian_Kuisioner_Matakuliah_'.$string.'_'.$thn.'_'.$periode['semester'];

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
			<td colspan="10" style="text-align:center;border-bottom:none;"><strong>Universitas Kristen Duta Wacana</strong></td>
		</tr>
		<tr>
			<td colspan="10" style="text-align:center;border-bottom:none;"><strong>Laporan Rangkuman Pengisian Kuisioner per Matakuliah</strong></td>
		</tr>
	</table>

	<br/>
	<strong>Tahun Ajaran : </strong> <?php echo $periode['thn_ajaran'] ?>
	<br/>
	<strong>Periode :</strong> <?php echo $periode['semester'] ?>
	<br/>
	<strong>Program Studi :</strong> <?php echo $unit['unit'] ?>
	<br/>
	<br/>
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr class="header">
					<th width="10%" style="text-align:center">Kode</th>
					<th width="35%">Nama Mtk</th>
					<th width="6%" style="text-align:center">Grup</th>
					<th width="7%" style="text-align:center">Peserta</th>
					<th width="7%" style="text-align:center">Terisi</th>
					<th width="7%" style="text-align:center"> >100% </th>
					<th width="7%" style="text-align:center"> >90% </th>
					<th width="7%" style="text-align:center"> >80% </th>
					<th width="7%" style="text-align:center"> >70% </th>
					<th width="7%" style="text-align:center"> less 70% </th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($data_evaluasi as $row) : ?>
			<tr>
					<td width="10%" style="text-align:center"><?php echo $row['kode'] ?></td>
					<td width="35%"><?php echo $row['nama'] ?></td>
					<td width="6%" style="text-align:center"><?php echo $row['grup'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['jml_peserta'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['terisi'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['seratus_persen'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['sembilanpuluh_persen'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['delapanpuluh_persen'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['tujuhpuluh_persen'] ?></td>
					<td width="7%" style="text-align:center"><?php echo $row['dibawah_persen'].''.$row['nol_persen'] ?></td>
			</tr>	
		<?php endforeach; ?>		
		</tbody>
		</table>
	</div>
</body>
</html>