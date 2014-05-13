<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPageOrientation('L');
$title = "Hasil Evaluasi";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData('', '', $title, date('d-m-Y'));
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
	if (empty($hasil_evaluasi)){	
		$data_hasil_kelas = '<tr><td colspan="18" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>';
	}
	else{
		foreach ($hasil_evaluasi as $key => $hasil){
			$data_hasil_kelas = "<tr>
				<td>".$hasil['kode']."</td>
				<td>".$hasil['nama']."</td>
				<td>".$hasil['grup']."</td>
				<td>".$hasil['terisi']."</td>
				<td>".$hasil['pengisi']."</td>
				<td>".$hasil['baik']."</td>
				<td>".$hasil['Q1']."</td>
				<td>".$hasil['Q2']."</td>
				<td>".$hasil['Q3']."</td>
				<td>".$hasil['Q4']."</td>
				<td>".$hasil['Q5']."</td>
				<td>".$hasil['Q6']."</td>
				<td>".$hasil['Q7']."</td>
				<td>".$hasil['Q8']."</td>
				<td>".$hasil['Q9']."</td>
				<td>".$hasil['Q10']."</td>
				<td>".$hasil['Q11']."</td>
				<td>".$hasil['Q12']."</td>
			</tr>";
		}
	}

	if (empty($masukan_matkul)){
		$data_masukan_matkul = '<tr><td colspan="18" class="center"><span class="italic">Tidak ada masukan</span></td></tr>';
	}else{
		foreach ($masukan_matkul as $key => $value){
			$data_masukan_matkul = '<dt>'.$value["nama"].'</dt><dd>'.$value["masukan"].'</dd>';
		}
	}

    $content = '
    <style>
    	.grup-pertanyaan {
			text-align: center;
			border: solid 1px #000;
		}
		table th {
			border-top: solid 1px #000;
			border-bottom: solid 2px #000;
		}
		table td {
			border-bottom: solid 1px #000;
		}
    </style>
	<br/>
	<strong>Dosen : '.$dosen->gelar_prefix.$dosen->nama.$dosen->gelar_suffix .' / '. $dosen->nik .'</strong>

	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<h2>Hasil Kuisioner Kelas</h2>
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr>
					<td colspan="6"></td>
					<td colspan="12" class="grup-pertanyaan">Index Atas Kuisioner 1 s/d 12</td>
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
				'.$data_hasil_kelas.'
			</tbody>
		</table>
	</div>

	<!-- Masukan Dosen -->
	<div class="masukan_dosen">
		<h2>Masukan Untuk Dosen</h2>
		<div class="panel-body">
				'.$masukan_dosen.'
		</div>
	</div>

	<!-- Masukan Matkul -->
	<div class="masukan_matkul">
		<h2>Masukan Untuk Matakuliah</h2>
		<div class="panel-body">
			<dl>
			'.$data_masukan_matkul.'
			</dl>
		</div>
	</div>';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hasil_evaluasi_dosen_'.$dosen->nik.'.pdf', 'I');
 ?>