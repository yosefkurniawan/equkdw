<?php 

class M_olahan extends CI_Model
{

	function getKelasAll($id_paket='',$clean=true)
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

		if ($clean == true) {
			$sql = "SELECT * FROM kelas_all 
					WHERE semester = $semester AND thn_ajaran = $thn_ajaran AND eva_status = 1";			
		} else {
			//cek if the data is clean or not
			$sql = "SELECT * FROM kelas_all 
					WHERE semester = $semester AND thn_ajaran = $thn_ajaran 
					AND (nik IS NULL OR nama_dsn IS NULL)
					";			
		}

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getPersenBaikData($id_paket='',$clean=true)
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

		if ($clean == true) {
		$sql = "SELECT * FROM o2_persenbaik 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran AND eva_status = 1";
		} else {
			//cek if the data is clean or not
		$sql = "SELECT * FROM o2_persenbaik 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran
					AND nik IS NULL
					";			
		}

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getEClassData($id_paket='',$clean=true)
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

		if ($clean == true) {
		$sql = "SELECT * FROM o5_eclass 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran AND eva_status = 1";
		} else {
			//cek if the data is clean or not
		$sql = "SELECT * FROM o5_eclass 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran
					AND nik IS NULL
					";			
		}

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getPresensiDosenRaw($id_paket='')
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

		$sql = "SELECT o1.*,m.eva_status FROM o1_raw o1
				LEFT JOIN ec_matkul m ON o1.kode = m.kode
				WHERE o1.semester = $semester AND o1.th_ajaran = $thn_ajaran AND m.eva_status = 1";

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getNilaiKelulusanRaw($id_paket='')
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

		$sql = "SELECT o3.*,m.eva_status FROM o3_raw_nilai o3
				LEFT JOIN ec_matkul m ON o3.kode = m.kode
				WHERE o3.semester = $semester AND o3.th_ajaran = $thn_ajaran AND m.eva_status = 1";

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function delete_o1_raw($th_ajaran,$semester) {
		$this->db->where('semester',$semester);
		$this->db->where('th_ajaran',$th_ajaran);
		$delete = $this->db->delete('o1_raw');
		if ($delete) {
		 	return false;
		} else {
		 	return true;
		}						
	}

	function delete_o3_raw_nilai($th_ajaran,$semester) {
		$this->db->where('semester',$semester);
		$this->db->where('th_ajaran',$th_ajaran);
		$delete = $this->db->delete('o3_raw_nilai');
		if ($delete) {
		 	return false;
		} else {
		 	return true;
		}						
	}

	//this is saving result from csv text for o1
	function save_input_presensi_dosen($value,$replace=false)
	{
		if ($replace == true) {
			$this->db->where('kode',$value['kode']);
			$this->db->where('grup',$value['grup']);
			$query = $this->db->get('o1_raw');
			if ($query->num_rows == 1) {
				$this->db->where('kode',$value['kode']);
				$this->db->where('grup',$value['grup']);
				$update = $this->db->update('o1_raw',$value);
				if ($update) {
				 	return false;
				} else {
				 	return true;
				}				
			} else {
				$insert = $this->db->insert('o1_raw',$value);
				if ($insert) {
				 	return false;
				} else {
				 	return true;
				}				
			}
		}
		else {
			//insert
			$insert = $this->db->insert('o1_raw',$value);
			if ($insert) {
			 	return false;
			} else {
			 	return true;
			}				
		}
	}

	function save_input_sistem_o1($param)
	{
		//search dulu
		$this->db->where('kode',$param['kode']);
		$this->db->where('grup',$param['grup']);		
		$this->db->where('semester',$param['semester']);		
		$this->db->where('th_ajaran',$param['th_ajaran']);
		$query = $this->db->get('o1_raw');
		if ($query->num_rows() == 1 ){
			$this->db->where('kode',$param['kode']);
			$this->db->where('grup',$param['grup']);		
			$this->db->where('semester',$param['semester']);		
			$this->db->where('th_ajaran',$param['th_ajaran']);
			$update = $this->db->update('o1_raw',$param);
			if ($update) {
				return true;
			}
		}	
		else {
			$insert = $this->db->insert('o1_raw',$param);
			if ($insert) {
				return true;
			}

		}
		return false;	
	}

	function hapus_sistem_o1($param) {
			$this->db->where('kode',$param['kode']);
			$this->db->where('grup',$param['grup']);		
			$this->db->where('semester',$param['semester']);		
			$this->db->where('th_ajaran',$param['th_ajaran']);
			$delete = $this->db->delete('o1_raw');
			if ($delete) {
				return true;
			} else {
				return false;
			}
	}

	//these2 below are saving result from csv text for o3
	/* upload1: nilai */
	function save_input_o3_nilai($value,$replace=false)
	{
		if ($replace == true) {
			$this->db->where('nim',$value['nim']);
			$this->db->where('kode',$value['kode']);
			$this->db->where('grup',$value['grup']);
			$query = $this->db->get('o3_raw_nilai');
			if ($query->num_rows == 1) {
				$this->db->where('nim',$value['nim']);
				$this->db->where('kode',$value['kode']);
				$this->db->where('grup',$value['grup']);
				$update = $this->db->update('o3_raw_nilai',$value);
				if ($update) {
				 	return false;
				} else {
				 	return true;
				}				
			} else {
				$insert = $this->db->insert('o3_raw_nilai',$value);
				if ($insert) {
				 	return false;
				} else {
				 	return true;
				}				
			}
		}
		else {
			//insert
			$insert = $this->db->insert('o3_raw_nilai',$value);
			if ($insert) {
			 	return false;
			} else {
			 	return true;
			}				
		}
	}

	/* upload2: presensi */
	function save_input_o3_presensi($value,$replace=false)
	{
		if ($replace == true) {
			$this->db->where('nim',$value['nim']);
			$this->db->where('kode',$value['kode']);
			$this->db->where('grup',$value['grup']);
			$query = $this->db->get('o3_raw_kehadiran');
			if ($query->num_rows == 1) {
				$this->db->where('nim',$value['nim']);
				$this->db->where('kode',$value['kode']);
				$this->db->where('grup',$value['grup']);
				$update = $this->db->update('o3_raw_kehadiran',$value);
				if ($update) {
				 	return false;
				} else {
				 	return true;
				}				
			} else {
				$insert = $this->db->insert('o3_raw_kehadiran',$value);
				if ($insert) {
				 	return false;
				} else {
				 	return true;
				}				
			}
		}
		else {
			//insert
			$insert = $this->db->insert('o3_raw_kehadiran',$value);
			if ($insert) {
			 	return false;
			} else {
			 	return true;
			}				
		}
	}

	function get_sks_info($kode) {
		$this->db->where('kode',$kode);
		$query = $this->db->get('ec_matkul');
		if ($query->num_rows == 1) {
			$data =  $query->row_array();
			return $data['sks'];
		} else {
			return 0;
		}
	}

	function getPresensiDosenList($th_ajaran,$semester) {
		$sql = "SELECT k.*, o1.tot_hadir, o1.rencana, m.nama'nama_mtk', o1.prodi
				FROM (SELECT * FROM kelas_all WHERE thn_ajaran = '$th_ajaran' AND semester = '$semester' AND eva_status = 1
					GROUP BY kode,grup) k
				LEFT JOIN ec_matkul m ON k.kode = m.kode
				LEFT JOIN o1_raw o1 ON k.kode = o1.kode AND k.grup = o1.grup AND k.thn_ajaran = o1.th_ajaran AND k.semester = o1.semester";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}

	}
}

