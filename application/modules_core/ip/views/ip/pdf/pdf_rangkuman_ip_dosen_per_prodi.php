<?php 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->setPageOrientation('P');
$title = "RANGKUMAN IP DOSEN";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData('logo.png', '10px', $title, 'PERIODE '.strtoupper($periode).' - '.$thn_ajaran);
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
	if (empty($list_ip_dosen_prodi)){	
		$data_hasil_kelas = '<tr><td colspan="5" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>';
	}
	else{
		foreach ($list_ip_dosen_prodi as $dosen){
			$nama = '';
			if (str_replace(" ", "",$dosen['gelar_prefix']) != '' AND str_replace(" ", "",$dosen['gelar_prefix']) != NULL) {
				$nama = $dosen['gelar_prefix'] . ' ';
			}
			$nama = $nama . $dosen['nama_dsn'];
			if ($dosen['gelar_suffix'] != '' AND $dosen['gelar_suffix'] != NULL) {
				$nama = $nama . ' ' . $dosen['gelar_suffix'] ;
			}

			$ip = $dosen['total_ip'] / $dosen['jmlh_mtk'];
			$data_hasil_kelas .= '<tr>
			    <td width="20%">'.$dosen['nik_baru'].'</td>
			    <td width="50%">'.$nama.'</td>
			    <td width="10%" style="text-align:right">'.$dosen['total_ip'].'</td>
			    <td width="10%" style="text-align:right">'.$dosen['jmlh_mtk'].'</td>
			    <td width="10%" style="text-align:right">'.number_format(ROUND($ip,2),2).'</td>
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
			border-bottom: solid 1px #000;
			font-weight: bold;
			vertical-align:middle;
			line-height:20px;
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
	<!-- Hasil Evaluasi Kelas -->
	<div class="hasil_kelas">
		<h2>Hasil Rangkuman IP Dosen</h2>
		<h4>Asal Program Studi / Unit : '.$prodi->unit.'</h4>
		<h4></h4>
		<h4></h4>
		<table class="table" id="hasil-evaluasi-dosen">
			<thead>
				<tr class="header">
					<th width="20%">NIK</th>
					<th width="50%">Nama Dosen</th>
					<th width="10%" style="text-align:right">Total IP</th>
					<th width="10%" style="text-align:right">Total Mtk</th>
					<th width="10%" style="text-align:right">IP Dosen</th>
				</tr>
			</thead>
			<tbody>
				'.$data_hasil_kelas.'
			</tbody>
		</table>
	</div>
	';

ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('hasil_rangkuman_ip_dosen_'.$prodi->unit.'.pdf', 'I');
 ?>