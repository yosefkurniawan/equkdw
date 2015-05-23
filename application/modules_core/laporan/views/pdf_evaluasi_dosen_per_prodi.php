<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPageOrientation('L');
$title = "HASIL EVALUASI";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData('logo.png', '10px', $title, 'PERIODE '.strtoupper($periode['semester']).' - '.$periode['thn_ajaran']);
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
$content = '
    <style>
    	.grup-pertanyaan {
			text-align: center;
			border: solid 1px #000;
		}
		table td {
			border-bottom: solid 1px #000;
			font-size: 8pt;
			vertical-align:middle;
			line-height:20px;
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
			font-weight: bold;
		}
		.center {
			text-align:center;
		}
		.italic {
			font-style:italic;
		}
    </style>';

foreach ($data_evaluasi as $key => $evaluasi) {
	$data_hasil_kelas = '';
	$data_masukan_dosen = '';
	$data_masukan_matkul = '';
	
    // we can have any view part here like HTML, PHP etc
	if (empty($evaluasi['hasil_evaluasi'])){	
		$data_masukan_matkul = '<span class="italic">Tidak ada masukan</span></td>';
		$data_masukan_dosen = '<span class="italic">Tidak ada masukan</span></td>';
		$data_hasil_kelas = '<tr><td colspan="18" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>';
	}
	else{
		foreach ($evaluasi['hasil_evaluasi'] as $key => $hasil){
			$hasil_preg_dosen = preg_replace("/[^A-Za-z0-9 !;.-]/", '', $hasil["masukan_dosen"]);
			$hasil_preg_mtk = preg_replace("/[^A-Za-z0-9 !;.-]/", '', $hasil["masukan_matkul"]);
			$data_hasil_kelas .= '<tr>
				<td width="5%">'.$hasil['kode'].'</td>
				<td width="27%">'.$hasil['nama'].'</td>
				<td width="5%">'.$hasil['grup'].'</td>
				<td width="5%">'.$hasil['terisi'].'</td>
				<td width="5%">'.$hasil['pengisi'].'</td>
				<td width="5%">'.$hasil['baik'].'</td>
				<td width="4%">'.$hasil['Q1'].'</td>
				<td width="4%">'.$hasil['Q2'].'</td>
				<td width="4%">'.$hasil['Q3'].'</td>
				<td width="4%">'.$hasil['Q4'].'</td>
				<td width="4%">'.$hasil['Q5'].'</td>
				<td width="4%">'.$hasil['Q6'].'</td>
				<td width="4%">'.$hasil['Q7'].'</td>
				<td width="4%">'.$hasil['Q8'].'</td>
				<td width="4%">'.$hasil['Q9'].'</td>
				<td width="4%">'.$hasil['Q10'].'</td>
				<td width="4%">'.$hasil['Q11'].'</td>
				<td width="4%">'.$hasil['Q12'].'</td>
			</tr>';
			$data_masukan_dosen .= $hasil["nama"].' GROUP '.$hasil["grup"].'<br/><br/>'.$hasil_preg_dosen.'<br/><br/>';
			$data_masukan_matkul .= $hasil["nama"].' GROUP '.$hasil["grup"].'<br/><br/>'.$hasil_preg_mtk.'<br/><br/>';
		}
	}

	// set dosen content
	$dsn = '';
	if (!empty($evaluasi['dosen']['gelar_prefix'])) {
		$dsn .= $evaluasi['dosen']['gelar_prefix'].' ';
	}
	$dsn .= $evaluasi['dosen']['nama'];
	if (!empty($evaluasi['dosen']['gelar_suffix'])) {
		$dsn .= ', '.$evaluasi['dosen']['gelar_suffix'];
	}
	$dsn .= ' / '. $evaluasi['dosen']['nik'];

    $content .= '
	<br/>
	
	<strong>Dosen : '.$dsn.'</strong>
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<h2>Hasil Kuisioner Kelas</h2>
		<table class="table" id="hasil-evaluasi-dosen">
			<tbody>
				<tr>
					<td width="52%" colspan="6"></td>
					<td width="48%" colspan="12" class="grup-pertanyaan">Index Atas Kuisioner 1 s/d 12</td>
				</tr>
				<tr class="header">
					<td width="5%">Kode</td>
					<td width="27%">Matakuliah</td>
					<td width="5%">Grup</td>
					<td width="5%">Terisi</td>
					<td width="5%">Pengisi</td>
					<td width="5%">% Baik</td>
					<td width="4%">Q1</td>
					<td width="4%">Q2</td>
					<td width="4%">Q3</td>
					<td width="4%">Q4</td>
					<td width="4%">Q5</td>
					<td width="4%">Q6</td>
					<td width="4%">Q7</td>
					<td width="4%">Q8</td>
					<td width="4%">Q9</td>
					<td width="4%">Q10</td>
					<td width="4%">Q11</td>
					<td width="4%">Q12</td>
				</tr>
				'.$data_hasil_kelas.'
			</tbody>
		</table>
	</div>
	Keterangan :
	<div class="keterangan_pertanyaan">
	';

	foreach ($pertanyaan as $key => $value) {
		$no = $key+1;
		$content .= 'Q'.$no.' = '.$value->pertanyaan.'<br/>';
	}

	$content .= '</div>
	<br pagebreak="true"/>
	<strong>Dosen : '.$dsn.'</strong>
	<!-- Masukan Dosen -->
	<div class="masukan_dosen">
		<h2>Masukan Untuk Dosen</h2>
		<div class="panel-body">
			<dl>
			'.$data_masukan_dosen.'
			</dl>
		</div>
	</div>
	
	<br pagebreak="true"/>
	<strong>Dosen : '.$dsn.'</strong>
	<!-- Masukan Matkul -->
	<div class="masukan_matkul">
		<h2>Masukan Untuk Matakuliah</h2>
		<div class="panel-body">
			<dl>
			'.$data_masukan_matkul.'
			</dl>
		</div>
	</div>
	<br pagebreak="true"/>';
}
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hasil_evaluasi_dosen_'.$id_unit.'.pdf', 'I');
 ?>