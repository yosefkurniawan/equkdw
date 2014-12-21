<?php

$thn = preg_replace('/\s+/', '_', $periode['thn_ajaran']);

$title = 'Rekap_o1'.'_'.$thn.'_'.$periode['semester'];

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rekap O1 <?php echo $periode['thn_ajaran']; echo $periode['semester']?> </title>

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
		table th {
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
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr>
					<th width="10%" style="text-align:center">kode</th>
					<th width="30%">nama matakuliah</th>
					<th width="10%" style="text-align:center">grup</th>
					<th width="10%" style="text-align:center">prodi</th>
					<th width="10%" style="text-align:center">rencana</th>
					<th width="10%" style="text-align:center"> tot_hadir </th>
					<th width="10%" style="text-align:center"> semester </th>
					<th width="10%" style="text-align:center"> thn_ajaran </th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($o1_rekap as $row) : ?>
			<tr>
					<td width="10%" style="text-align:center"><?php echo $row['kode'] ?></td>
					<td width="30%"><?php echo $row['nama_mtk'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['grup'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['prodi'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['rencana'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['tot_hadir'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['semester'] ?></td>
					<td width="10%" style="text-align:center"><?php echo $row['thn_ajaran'] ?></td>
			</tr>	
		<?php endforeach; ?>		
		</tbody>
		</table>
	</div>
</body>
</html>