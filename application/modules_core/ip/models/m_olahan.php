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

	function delete_o1_raw($th_ajaran,$semester) {
		$this->db->where('semester',$th_ajaran);
		$this->db->where('th_ajaran',$semester);
		$delete = $this->db->delete('o1_raw');
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
}

