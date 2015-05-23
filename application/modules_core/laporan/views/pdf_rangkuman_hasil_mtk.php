<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPageOrientation('L');
$title = "RANGKUMAN EVALUASI UNIT ".$unit['unit'];
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
		$hasil = '<tr><td colspan="10" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>';
	}
	else{
		foreach ($data_evaluasi as $row){
			$hasil .= '<tr>
					<td width="10%" style="text-align:center">'.$row['kode'].'</td>
					<td width="35%">'.$row['nama'].'</td>
					<td width="6%" style="text-align:center">'.$row['grup'].'</td>
					<td width="7%" style="text-align:center">'.$row['jml_peserta'].'</td>
					<td width="7%" style="text-align:center">'.$row['terisi'].'</td>
					<td width="7%" style="text-align:center">'.$row['seratus_persen'].'</td>
					<td width="7%" style="text-align:center">'.$row['sembilanpuluh_persen'].'</td>
					<td width="7%" style="text-align:center">'.$row['delapanpuluh_persen'].'</td>
					<td width="7%" style="text-align:center">'.$row['tujuhpuluh_persen'].'</td>
					<td width="7%" style="text-align:center">'.$row['dibawah_persen'].''.$row['nol_persen'].'</td>
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
		<h2>Hasil Rangkuman Pengisian Kuisioner Dosen per Matakuliah</h2>
		<h4>Unit/Prodi : '.$unit['unit'].' </h4>
		<h4></h4>
		<h4>Jumlah Matakuliah : '.$mtk_overview['jumlah_matakuliah'].' | Berkuisioner : '
		.$mtk_overview['mtk_berkuis'].' | Opsional : '.$mtk_overview['mtk_berkuis_tdk_wajib'].' | Tidak Ada : '.$mtk_overview['mtk_tdk_berkuis'].'</h4>
		<h4>Terisi 100%: '.$mtk_persen['seratus_persen'].' | Terisi 90% : '
		.$mtk_persen['sembilanpuluh_persen'].' | Terisi 80% : '.$mtk_persen['delapanpuluh_persen'].' | Terisi 70% : '.$mtk_persen['tujuhpuluh_persen'].' | Terisi  70% kurang : '
		.($mtk_persen['dibawah_persen']+$mtk_persen['nol_persen']).'</h4>
		<h4></h4>
		<h4></h4>
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
				'.$hasil.'
			</tbody>
		</table>
	</div>
	';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hasil_rangkuman_isi_kuisioner_mtk.pdf', 'I');
?>