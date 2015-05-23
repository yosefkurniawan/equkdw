<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPageOrientation('P');
$title = "DAFTAR MAHASISWA BELUM SELESAI MENGISI KUISIONER";
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

    // we can have any view part here like HTML, PHP etc
	if (empty($data_evaluasi)){	
		$hasil = '<tr><td colspan="5"></td></tr><tr><td colspan="5" class="center"><span class="italic">Tidak ada mahasiswa</span></td></tr>';
	}
	else{
		foreach ($data_evaluasi as $row){
			$hasil .= '<tr>
					<td width="15%" style="text-align:center">'.$row->nim.'</td>
					<td width="40%">'.$row->nama_lengkap.'</td>
					<td width="15%" style="text-align:center">'.$row->matakuliah_diambil.'</td>
					<td width="15%" style="text-align:center">'.$row->matakuliah_berkuisioner.'</td>
					<td width="15%" style="text-align:center">'.$row->kuisioner_terisi.'</td>
					</tr>';
		}
	}

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
    </style>
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<h2>Daftar Mahasiswa yang Belum Selesai Mengisi Kuisioner</h2>
		<h4>Unit/Prodi : '.$unit['unit'].' </h4>
		<h4></h4>
		<h4></h4>
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr class="header">
					<th width="15%" style="text-align:center">NIM</th>
					<th width="40%">Nama Mahasiswa</th>
					<th width="15%" style="text-align:center">Matakuliah</th>
					<th width="15%" style="text-align:center">Berkuisioner</th>
					<th width="15%" style="text-align:center">Mengisi</th>
				</tr>
			</thead>
			<tbody>
				'.$hasil.'
			</tbody>
		</table>
	</div>
	';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hasil_rangkuman_isi_kuisioner_mtk.pdf', 'I');
?>