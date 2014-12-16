<?php 

class M_dosen extends CI_Model
{
	function getAllKelasProblem($id_paket='')
	{
		if ($id_paket != '') {
			$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' 
						ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
			$query = $this->db->query($sql_latest_paket);
			$semester 	= "'".$query->row()->semester."'";
			$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		}
		else{
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka 
							WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka 
							WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}		

		// $sql = "SELECT k.id_kelasb, k.kode, m.nama'nama_mtk', k.grup, 
		// 			m.id_unit'prodi', ru.unit,
		// 			p.nik, d.nama'nama_dsn',
		// 			k.semester, k.thn_ajaran
		// 			-- CONCAT(k.kode,k.grup,IFNULL(p.nik,''),k.semester,k.thn_ajaran)'mykey'
		// 		FROM ec_kelas_buka k
		// 		LEFT JOIN ec_matkul m ON m.kode = k.kode
		// 		LEFT JOIN ref_unit ru ON ru.id_unit = m.id_unit
		// 		LEFT JOIN ec_pengajar p ON p.id_kelasb = k.id_kelasb
		// 		LEFT JOIN user_dosen_karyawan d ON d.nik = p.nik
		// 		WHERE k.semester = 'GASAL' 
		// 		AND k.thn_ajaran = '2014/2015'
		// 		AND (p.nik IS NULL OR d.nama IS NULL)
		// 		-- GROUP BY mykey
		// 		ORDER BY nik";

		$sql = "SELECT * FROM kelas_all 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran 
				AND (nik IS NULL OR nama_dsn IS NULL)
				";			


		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	function getDosen($keyword) {
		$keyword = strtolower($keyword);
		$sql = "SELECT nik, nama, gelar_prefix, gelar_suffix FROM user_dosen_karyawan WHERE jenis_kerja = 'DOSEN' 
					AND ( LOWER(nik) LIKE '%$keyword%' OR LOWER(nama) LIKE '%$keyword%' ) LIMIT 10";
		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
	}

	function createDosen($params) {
		$insert = $this->db->insert('user_dosen_karyawan',$params);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	function addPengajar($params) {
		$insert = $this->db->insert('ec_pengajar',$params);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	

}