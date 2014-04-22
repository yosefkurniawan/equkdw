<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function getListDosenByIdUnit($id_unit){
		$sql 	= "SELECT * FROM user_dosen_karyawan WHERE id_unit = '$id_unit' ORDER BY nama ASC";
		$result = $this->db->query($sql);

		$dosen = array();
		if ($result->num_rows() > 0) {
			$dosen = $result->result_array();
		}

		return $dosen;
	}

	public function getHasilEvaluasi($nik){
		// get latest paket
		$sql_latest_paket = "SELECT id_paket FROM eva_paket ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC LIMIT 1";
		$id_paket 		  = $this->db->query($sql_latest_paket)->row()->id_paket;

		// get hasil evaluasi
		$sql	= "SELECT 
					j.id_kelasb, m.nama, b.grup, m.kode,
					COUNT(j.`id_jawaban`) AS pengisi,
					SUM(a1)*100/(COUNT(a1)*2) AS Q1,
					SUM(a2)*100/(COUNT(a2)*2) AS Q2,
					SUM(a3)*100/(COUNT(a3)*2) AS Q3,
					SUM(a4)*100/(COUNT(a4)*2) AS Q4,
					SUM(a5)*100/(COUNT(a5)*2) AS Q5,
					SUM(a6)*100/(COUNT(a6)*2) AS Q6,
					SUM(a7)*100/(COUNT(a7)*2) AS Q7,
					SUM(a8)*100/(COUNT(a8)*2) AS Q8,
					SUM(a9)*100/(COUNT(a9)*2) AS Q9,
					SUM(a10)*100/(COUNT(a10)*2) AS Q10,
					SUM(a11)*100/(COUNT(a11)*2) AS Q11, 
					SUM(a12)*100/(COUNT(a12)*2) AS Q12
					FROM `eva_jawaban_paket` j 
					JOIN `ec_kelas_buka` b ON j.id_kelasb = b.id_kelasb
					JOIN `ec_matkul` m ON b.kode = m.kode
					WHERE j.`id_paket` = $id_paket AND j.nik = '$nik'
					GROUP BY j.id_kelasb,m.nama,b.grup,m.kode";
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