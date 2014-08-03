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
} // end of class