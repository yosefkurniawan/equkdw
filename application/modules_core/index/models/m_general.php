<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_general extends CI_Model {

	public function getDetailUserByStatus($username,$status){
		$result = array();

		if (strtolower($status) == strtolower('Mahasiswa')){
			$tabel 	= 'user_mhs_alumni';
			$id 	= 'nim';
		}else{
			$tabel 	= 'user_dosen_karyawan';
			$id 	= 'nik';
		}
			

		$sql 	= "SELECT * FROM $tabel WHERE $id = '$username'";
		$user 	= $this->db->query($sql);

		if ($user->num_rows() > 0) {
			$result = $user->row();
		}

		return $result;
	}

}

/* End of file m_general.php */
/* Location: ./application/modules_core/user/models/m_general.php */