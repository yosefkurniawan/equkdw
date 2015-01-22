<?php 

class ip_model extends CI_Model
{
	function get_thn_ajaran_periode(){

		$sql = "SELECT semester,th_ajaran FROM kelas_all GROUP BY semester, th_ajaran";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}
	} // end of function get_thn_ajaran_periode()

	function get_dosen_info($nik) {
		$sql = "SELECT * FROM dosen_all, prodi WHERE dosen_all.nik_baru = '$nik' AND dosen_all.prodi = prodi.prodi";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->row();
		} // end of if
		else 
		{
			return array();
		}
	}

	function get_info_prodi($prodi) {
		$sql = "SELECT * FROM prodi WHERE prodi.prodi = '$prodi' LIMIT 1";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->row()); die;
		if ($query->num_rows() == 1 ) 
		{
			return $query->row();
		} // end of if
		else 
		{
			return array();
		}		
	}

	function getProdiList(){
		$sql = "SELECT * FROM prodi";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->row()); die;
		if ($query->num_rows() > 1 ) 
		{
			return $query->result_array();
		} // end of if
		else 
		{
			return array();
		}
	}

	function get_ip_list($prodi,$th_ajaran,$semester) {
		$sql = "SELECT dsn.nik_baru,dsn.nidn,dsn.nama_dsn,dsn.prodi,p.nama_prodi,
				SUM(IF(o1.persen_hadir > 90, 4, IF(o1.persen_hadir > 80, 3, 2))*0.2 + 
				IF(o2.baik > 90, 4, IF(o2.baik > 80, 3, 2))*0.35 + 
				IF(o3.persen_lulus > 60, 4, IF(o3.persen_lulus > 50 , 3, 2))*0.1 + 
				IF(o4.flag_tepat = 'T', 4, 2)*0.15 + 
				o5.eclass*0.2) as total_ip, 
				COUNT(dsn.nik_baru) as jmlh_mtk,
				ROUND(SUM(IF(o1.persen_hadir > 90, 4, IF(o1.persen_hadir > 80, 3, 2))*0.2 + 
				IF(o2.baik > 90, 4, IF(o2.baik > 80, 3, 2))*0.35 + 
				IF(o3.persen_lulus > 60, 4, IF(o3.persen_lulus > 50 , 3, 2))*0.1 + 
				IF(o4.flag_tepat = 'T', 4, 2)*0.15 + 
				o5.eclass*0.2) / COUNT(dsn.nik_baru),2) as ip_dosen
				FROM (SELECT * FROM kelas_all
				WHERE semester = '$semester' AND thn_ajaran = '$th_ajaran') kls
				LEFT JOIN dosen_all dsn ON kls.nik_baru = dsn.nik_baru
				LEFT JOIN prodi p ON dsn.prodi = p.prodi
				LEFT JOIN o1_presensi o1 ON kls.mykey = o1.mykey
				LEFT JOIN o2_persenbaik o2 ON kls.mykey = o2.mykey
				LEFT JOIN o3_nilailulus o3 ON kls.mykey = o3.mykey
				LEFT JOIN o4_nilaimasuk o4 ON kls.mykey = o4.mykey
				LEFT JOIN o5_eclass o5 ON kls.mykey = o5.mykey
				WHERE dsn.prodi = '$prodi'
				GROUP BY dsn.nik_baru
				ORDER BY ip_dosen DESC, jmlh_mtk DESC";
			$query = $this->db->query($sql);
			// echo '<pre>'; print_r($query->result()); die;
			if ($query->num_rows() > 0 ) 
			{
				return $query->result();
			} // end of if
			else 
			{
				return array();
			}					
	}

	function get_prodi_o1($prodi,$th_ajaran,$semester) {

		// $sql = "SELECT o1.kode, dsn.prodi, o1.persen_hadir FROM o1_presensi o1, dosen_all dsn
		// 		WHERE o1.th_ajaran = '$th_ajaran' AND o1.semester = '$semester' AND o1.nik_baru = dsn.nik_baru AND dsn.prodi = '$prodi'";
		// $sql = "SELECT kode, prodi, persen_hadir FROM o1_presensi 

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o1.persen_hadir,kelas.semester, kelas.thn_ajaran
				FROM
				(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
				LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o1_presensi o1 
				WHERE o1.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o2($prodi,$th_ajaran,$semester) {


		// $sql = "SELECT o2.kode, dsn.prodi, o2.baik FROM o2_persenbaik o2, dosen_all dsn 
		// 		WHERE o2.th_ajaran = '$th_ajaran' AND o2.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o2.baik,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o2_persenbaik o2
					WHERE o2.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";
		
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o3($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o3.kode, dsn.prodi, o3.persen_lulus FROM o3_nilailulus o3, dosen_all dsn 
		// 		WHERE o3.th_ajaran = '$th_ajaran' AND o3.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o3.persen_lulus,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o3_nilailulus o3
					WHERE o3.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o4($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o4.kode, dsn.prodi, o4.flag_tepat FROM o4_nilaimasuk o4, dosen_all dsn
		// 		WHERE o4.th_ajaran = '$th_ajaran' AND o4.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o4.flag_tepat,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o4_nilaimasuk o4
					WHERE o4.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o5($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o5.kode, dsn.prodi, o5.eclass FROM o5_eclass o5, dosen_all dsn 
		// 		WHERE o5.th_ajaran = '$th_ajaran' AND o5.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o5.eclass,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o5_eclass o5
					WHERE o5.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}



	function get_univ_o1($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, persen_hadir FROM o1_presensi 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o2($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, baik FROM o2_persenbaik 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o3($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, persen_lulus FROM o3_nilailulus 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o4($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, flag_tepat FROM o4_nilaimasuk 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o5($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, eclass FROM o5_eclass 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}


	function updt_kelass_all(){

		$sql = "SELECT * FROM o5_eclass";
		$query = $this->db->query($sql);
		$data =	$query->result();
		foreach ($data as $key) {
			$newkey = trim($key->kode) . trim($key->grup) . trim($key->prodi) . trim($key->semester) . trim($key->th_ajaran);
			$sql = "UPDATE o5_eclass SET mykey = '$newkey' WHERE mykey = '$key->mykey' ";
			$query = $this->db->query($sql);
		}
		echo "berhasil"; die;
	} // end of function get_thn_ajaran_periode()

	function get_dosen_list($th_ajaran,$semester)
	{
		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,COUNT(kelas.mykey) as jumlah_matkul_ajar, p.prodi, p.nama_prodi, kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, prodi p
					WHERE p.prodi = kelas.prodi_dosen AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' 
					GROUP BY nama_dsn
					ORDER BY p.prodi ASC";

		// $sql = "SELECT nik_baru, nama_dsn, COUNT(kode) as jumlah_matkul_ajar,k.prodi,nama_prodi FROM kelas_all k
		// 		JOIN prodi p ON k.prodi = p.prodi
		// 		WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'
		// 		GROUP BY nama_dsn";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		
		$listDosen = array();
		if ($query->num_rows() > 0) {
			$listDosen = $query->result_array();
		}

		$_result = array();
		// Listing the units
		if ($listDosen) {
			foreach ($listDosen as $key => $dosen) {
				// rename unit if empty
				$prodi 			= $dosen['prodi'];
				$nama_prodi 	= $dosen['nama_prodi'];

				$_result[$prodi]['prodi'] 		= $prodi; 
				$_result[$prodi]['nama_prodi'] 	= $nama_prodi; 
				$_result[$prodi]['listDosen']	= array();
			}
		}

		// Move dosen into unit one by one
		if ($_result) {
			foreach ($_result as $key => $value) {
				foreach ($listDosen as $dosen) {
					if ($dosen['prodi'] == $value['prodi']) {
						$_result[$key]['listDosen'][] = $dosen;
					}
				}
			}
		}
		// echo '<pre>'; print_r($_result); die;
		return $_result;
	} // end of function get_dosen_list

	function get_dosen_ajar($nik,$th_ajaran,$semester)
	{
		$sql = "SELECT matkul.nik_baru, matkul.nama_dsn, matkul.kode, matkul.nama_mtk, matkul.grup, matkul.mykey,
								o1.persen_hadir,o2.baik,o3.persen_lulus,o4.flag_tepat,
								o5.silabus,o5.materi,o5.tugas,o5.nilai,o5.eclass
				FROM
				(SELECT nik_baru, nama_dsn, kode, nama_mtk, grup, mykey FROM kelas_all 
				WHERE thn_ajaran = '$th_ajaran' AND semester = '$semester' AND nik_baru = '$nik') matkul
				LEFT JOIN o1_presensi o1 ON o1.mykey = matkul.mykey 
				LEFT JOIN o2_persenbaik o2 ON o2.mykey = matkul.mykey 
				LEFT JOIN o3_nilailulus o3 ON o3.mykey = matkul.mykey 
				LEFT JOIN o4_nilaimasuk o4 ON o4.mykey = matkul.mykey 
				LEFT JOIN o5_eclass o5 ON o5.mykey = matkul.mykey 
				";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}		
	} // end of function get_dosen_list

} // end of class