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
}

