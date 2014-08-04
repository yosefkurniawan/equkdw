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

	function get_prodi_o1($prodi,$th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, persen_hadir FROM o1_presensi 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND prodi = '$prodi'";
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
		$sql = "SELECT kode, prodi, baik FROM o2_persenbaik 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND prodi = '$prodi'";
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
		$sql = "SELECT kode, prodi, persen_lulus FROM o3_nilailulus 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND prodi = '$prodi'";
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
		$sql = "SELECT kode, prodi, flag_tepat FROM o4_nilaimasuk 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND prodi = '$prodi'";
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
		$sql = "SELECT kode, prodi, eclass FROM o5_eclass 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND prodi = '$prodi'";
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
		$sql = "SELECT nik_baru, nama_dsn, COUNT(kode) as jumlah_matkul_ajar FROM kelas_all 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'
				GROUP BY nama_dsn";
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

	function get_dosen_ajar($nik,$th_ajaran,$semester)
	{
		$sql = "SELECT matkul.nik_baru, matkul.nama_dsn, matkul.kode, matkul.nama_mtk, matkul.grup, matkul.mykey,
								o1.persen_hadir,o2.baik,o3.persen_lulus,o4.flag_tepat,
								o5.silabus,o5.materi,o5.tugas,o5.nilai,o5.eclass
				FROM
				(SELECT nik_baru, nama_dsn, kode, nama_mtk, grup, mykey FROM kelas_all 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester' AND nik_baru = '$nik') matkul
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