<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function getListDosenByIdUnit($id_unit){
		// set periode
		if (isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$semester 	= "'".$this->session->userdata['periode_laporan_evaluasi']['semester']."'";
			$thn_ajaran	= "'".$this->session->userdata['periode_laporan_evaluasi']['thn_ajaran']."'";
		}
		else{
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}

		$sql 	= "SELECT d.nik,d.nama,d.gelar_suffix,d.gelar_prefix,m.id_unit, IFNULL(u.unit,'zzz') as unit
						FROM ec_kelas_buka k
						JOIN ec_pengajar p ON k.id_kelasb = p.id_kelasb
						JOIN user_dosen_karyawan d ON d.nik = p.nik
						JOIN ec_matkul m ON m.kode = k.kode 
						LEFT JOIN ref_unit u ON u.id_unit = m.id_unit
						WHERE k.semester = $semester
						AND k.thn_ajaran = $thn_ajaran
						AND m.id_unit = '$id_unit'
						GROUP BY nik, nama, gelar_suffix, gelar_prefix, id_unit,unit
						ORDER BY unit,d.nama ASC";
		$result = $this->db->query($sql);

		$dosen = array();
		if ($result->num_rows() > 0) {
			$dosen = $result->result_array();
		}

		return $dosen;
	}

	public function getListDosenAktifPerUnit(){	
		// set periode
		if (isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$semester 	= "'".$this->session->userdata['periode_laporan_evaluasi']['semester']."'";
			$thn_ajaran	= "'".$this->session->userdata['periode_laporan_evaluasi']['thn_ajaran']."'";
		}
		else{
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}

		$sql_listDosen 	= "SELECT d.nik,d.nama,d.gelar_suffix,d.gelar_prefix,m.id_unit, IFNULL(u.unit,'zzz') as unit
						FROM ec_kelas_buka k
						JOIN ec_pengajar p ON k.id_kelasb = p.id_kelasb
						JOIN user_dosen_karyawan d ON d.nik = p.nik
						JOIN ec_matkul m ON m.kode = k.kode 
						LEFT JOIN ref_unit u ON u.id_unit = m.id_unit
						WHERE k.semester = $semester
						AND k.thn_ajaran = $thn_ajaran
						GROUP BY nik, nama, gelar_suffix, gelar_prefix, id_unit,unit
						ORDER BY unit,d.nama ASC";
		$_listDosen = $this->db->query($sql_listDosen);

		$listDosen = array();
		if ($_listDosen->num_rows() > 0) {
			$listDosen = $_listDosen->result_array();
		}

		$_result = array();
		// Listing the units
		if ($listDosen) {
			foreach ($listDosen as $key => $dosen) {
				// rename unit if empty
				$id_unit 	= $dosen['id_unit'];
				$unit 		= $dosen['unit'];
				if ($dosen['unit']=='zzz') {
					$id_unit 	= '-';
					$unit 		= 'Tidak Terdaftar';
					$listDosen[$key]['id_unit'] = $id_unit;
					$listDosen[$key]['unit'] 	= $unit;
				}

				$_result[$id_unit]['id_unit'] 	= $id_unit; 
				$_result[$id_unit]['unit'] 		= $unit; 
				$_result[$id_unit]['listDosen']	= array();

				// create button print laporan per unit
				$_result[$id_unit]['btn_print']	= "<a href='".base_url()."laporan/pdf_hasil_evaluasi_dosen_per_prodi/".$dosen['id_unit']."' class='btn btn-med blue-bg btn-print-evaluasi' target='_blank' title='Mencetak hasil evaluasi semua dosen ".$dosen['unit']."'><i class='icon-print'></i> Cetak</a>";				
			}
		}

		// Move dosen into unit one by one
		if ($_result) {
			foreach ($_result as $key => $value) {
				foreach ($listDosen as $dosen) {
					if ($dosen['id_unit'] == $value['id_unit']) {
						$_result[$key]['listDosen'][] = $dosen;
					}
				}
			}
		}

		return $_result;
	}

	# NOTE: $showAllMatkul = false --> hide all subjects that do not have questionnaire
	public function getHasilEvaluasi($nik, $showAllMatkul=false){
		// get latest paket
		$sql_latest_paket = "SELECT id_paket FROM eva_paket ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC LIMIT 1";
		$id_paket 		  = $this->db->query($sql_latest_paket)->row()->id_paket;

		if (!$showAllMatkul) {
			$sql_showAllMatkul = "AND m.`eva_status` = 1";
		}
		else{
			$sql_showAllMatkul = "";
		}

		// set periode
		if (isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$semester 	= "'".$this->session->userdata['periode_laporan_evaluasi']['semester']."'";
			$thn_ajaran	= "'".$this->session->userdata['periode_laporan_evaluasi']['thn_ajaran']."'";
		}
		else{
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}

		// get hasil evaluasi
		$sql	= "SELECT 
					k.id_kelasb, m.nama, k.grup, m.kode,
					COUNT(j.`id_jawaban`) AS pengisi,
					IFNULL(	case (SUM(a1)*100/(COUNT(a1)*2) mod 1 > 0)  
							  when true then round(SUM(a1)*100/(COUNT(a1)*2), 2)   
							  else round(SUM(a1)*100/(COUNT(a1)*2),0) 
							end,'-') AS Q1,
					IFNULL(	case (SUM(a2)*100/(COUNT(a2)*2) mod 1 > 0)  
							  when true then round(SUM(a2)*100/(COUNT(a2)*2), 2)   
							  else round(SUM(a2)*100/(COUNT(a2)*2),0) 
							end,'-') AS Q2,
					IFNULL(	case (SUM(a3)*100/(COUNT(a3)*2) mod 1 > 0)  
							  when true then round(SUM(a3)*100/(COUNT(a3)*2), 2)   
							  else round(SUM(a3)*100/(COUNT(a3)*2),0) 
							end,'-') AS Q3,
					IFNULL(	case (SUM(a4)*100/(COUNT(a4)*2) mod 1 > 0)  
							  when true then round(SUM(a4)*100/(COUNT(a4)*2), 2)   
							  else round(SUM(a4)*100/(COUNT(a4)*2),0) 
							end,'-') AS Q4,
					IFNULL(	case (SUM(a5)*100/(COUNT(a5)*2) mod 1 > 0)  
							  when true then round(SUM(a5)*100/(COUNT(a5)*2), 2)   
							  else round(SUM(a5)*100/(COUNT(a5)*2),0) 
							end,'-') AS Q5,
					IFNULL(	case (SUM(a6)*100/(COUNT(a6)*2) mod 1 > 0)  
							  when true then round(SUM(a6)*100/(COUNT(a6)*2), 2)   
							  else round(SUM(a6)*100/(COUNT(a6)*2),0) 
							end,'-') AS Q6,
					IFNULL(	case (SUM(a7)*100/(COUNT(a7)*2) mod 1 > 0)  
							  when true then round(SUM(a7)*100/(COUNT(a7)*2), 2)   
							  else round(SUM(a7)*100/(COUNT(a7)*2),0) 
							end,'-') AS Q7,
					IFNULL(	case (SUM(a8)*100/(COUNT(a8)*2) mod 1 > 0)  
							  when true then round(SUM(a8)*100/(COUNT(a8)*2), 2)   
							  else round(SUM(a8)*100/(COUNT(a8)*2),0) 
							end,'-') AS Q8,
					IFNULL(	case (SUM(a9)*100/(COUNT(a9)*2) mod 1 > 0)  
							  when true then round(SUM(a9)*100/(COUNT(a9)*2), 2)   
							  else round(SUM(a9)*100/(COUNT(a9)*2),0) 
							end,'-') AS Q9,
					IFNULL(	case (SUM(a10)*100/(COUNT(a10)*2) mod 1 > 0)  
							  when true then round(SUM(a10)*100/(COUNT(a10)*2), 2)   
							  else round(SUM(a10)*100/(COUNT(a10)*2),0) 
							end,'-') AS Q10,
					IFNULL(	case (SUM(a11)*100/(COUNT(a11)*2) mod 1 > 0)  
							  when true then round(SUM(a11)*100/(COUNT(a11)*2), 2)   
							  else round(SUM(a11)*100/(COUNT(a11)*2),0) 
							end,'-') AS Q11,
					IFNULL(	case (SUM(a12)*100/(COUNT(a12)*2) mod 1 > 0)  
							  when true then round(SUM(a12)*100/(COUNT(a12)*2), 2)   
							  else round(SUM(a12)*100/(COUNT(a12)*2),0) 
							end,'-') AS Q12,
					IFNULL(GROUP_CONCAT( j.`masukan_dosen` ORDER BY RAND() SEPARATOR ';'), 'Tidak ada masukan') as masukan_dosen,
					IFNULL(GROUP_CONCAT( j.`masukan_matkul` ORDER BY RAND() SEPARATOR ';'), 'Tidak ada masukan') as masukan_matkul,
					IF(m.`eva_status`,'Ada','Tidak Ada') as status_kuisioner
					FROM ec_kelas_buka k
					JOIN ec_pengajar p ON k.id_kelasb = p.id_kelasb AND p.nik = '$nik'
					JOIN ec_matkul m ON m.kode = k.kode
					JOIN user_dosen_karyawan d ON d.nik = p.nik
					LEFT JOIN `eva_jawaban_paket` j ON j.id_kelasb = k.id_kelasb AND j.`id_paket` = $id_paket 
					AND j.nik = '$nik'
					WHERE k.aktif = 1
					$sql_showAllMatkul
					AND k.semester = $semester
					AND k.thn_ajaran = $thn_ajaran
					GROUP BY j.id_kelasb,m.nama,k.grup,m.kode,status_kuisioner";
		$result = $this->db->query($sql);
		$hasil_evaluasi = array();
		if ($result->num_rows() > 0 ) {
			$hasil_evaluasi = $result->result_array();
		}

		// hitung % baik & hitung jml peserta kelas
		if (!empty($hasil_evaluasi)) {
			foreach ($hasil_evaluasi as $key => $hasil) {

				// hitung % baik
				$count=0;
				if ($hasil['Q1'] > 80) {$count++;}
				if ($hasil['Q2'] > 80) {$count++;}
				if ($hasil['Q3'] > 80) {$count++;}
				if ($hasil['Q4'] > 80) {$count++;}
				if ($hasil['Q5'] > 80) {$count++;}
				if ($hasil['Q6'] > 80) {$count++;}
				if ($hasil['Q7'] > 80) {$count++;}
				if ($hasil['Q8'] > 80) {$count++;}
				if ($hasil['Q9'] > 80) {$count++;}
				if ($hasil['Q10'] > 80) {$count++;}
				if ($hasil['Q11'] > 80) {$count++;}
				if ($hasil['Q12'] > 80) {$count++;}
				
				$baik = ($count*100)/12;
				$hasil_evaluasi[$key]['baik'] = round($baik,2);

				// get jml peserta
				$id_kelasb = $hasil['id_kelasb'];
				$sql_jml_peserta 	= "SELECT COUNT(nim) as jml_peserta FROM ec_peserta WHERE id_kelasb = '$id_kelasb'";
				$result_jml_peserta = $this->db->query($sql_jml_peserta);
				$terisi = 0;
				if ($result_jml_peserta->num_rows() > 0) {
					$terisi = $result_jml_peserta->row()->jml_peserta;
				}
				$hasil_evaluasi[$key]['terisi'] = $terisi;

			}
		}

		return $hasil_evaluasi;
	}

	public function getDetailDosen($nik){
		$sql = "SELECT*FROM user_dosen_karyawan WHERE nik='$nik'";
		$result = $this->db->query($sql);

		$dosen = array();
		if ($result->num_rows() > 0) {
			$dosen = $result->row();
		}

		return $dosen;
	}

	public function getMasukanDosen($nik){
		$sql 		= "SELECT GROUP_CONCAT(`masukan_dosen` SEPARATOR ';') as masukan FROM `eva_jawaban_paket` WHERE `nik` = '$nik' ORDER BY RAND()";
		$result 	= $this->db->query($sql);
		$masukan 	= array();
		
		if ($result->num_rows() > 0) {
			$masukan = $result->row()->masukan;
		}
		return $masukan;
	}

	public function getMasukanMatkul($nik){
		$sql 		= "SELECT m.nama,m.kode,GROUP_CONCAT(j.`masukan_matkul` SEPARATOR ';') as masukan 
						FROM `eva_jawaban_paket` j 
						JOIN `ec_kelas_buka` b ON b.id_kelasb = j.id_kelasb
						JOIN `ec_matkul` m ON m.kode = b.kode
						WHERE `nik` = '$nik' ORDER BY RAND()";
		$result 	= $this->db->query($sql);
		$masukan 	= array();
		if ($result->num_rows() > 0) {
			$masukan = $result->result_array();
		}
		return $masukan;
	}
}

/* End of file m_laporan.php */
/* Location: ./application/modules_core/laporan/models/m_laporan.php */