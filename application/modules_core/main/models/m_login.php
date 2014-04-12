<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	function check_admin($username){
		$result						= array();
		$result['is_super_admin'] 	= 0;
		$result['is_admin'] 		= 0;

		$sql 		= "SELECT * FROM eva_role r WHERE r.username='$username'";
		$account 	= $this->db->query($sql);

		if ($account->num_rows() > 0) {
			$roles = $account->result_array();
			foreach ($roles as $value) {
				if ($value['role'] == 'super admin') {
					$result['is_super_admin'] = 1;
				}
				if ($value['role'] == 'admin') {
					$result['is_admin'] = 1;
				}
			}
		}
		return $result;
	}

	function check_kepala_unit($username){
		$result 	= 0;

		$sql 		= "SELECT * FROM ref_unit WHERE id_kepala='$username'";
		$sql_result	= $this->db->query($sql);

		if ($sql_result->num_rows() > 0) {
			$result = 1;
		}
		return $result;
	}

}

/* End of file m_login.php */
/* Location: ./application/modules_core/main/models/m_login.php */