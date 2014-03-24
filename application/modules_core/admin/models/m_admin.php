<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_admin extends CI_Model
{
	/*function admin_login($username,$password){
		$result		= array();
		$sql 		= "SELECT * FROM eva_role r WHERE r.username='$username' AND r.password=MD5('$password')";
		$account 	= $this->db->query($sql);

		if ($account->num_rows() > 0) {
			$result['result']	= 1;
			$result['account']	= $account->row();
		}
		else{
			$result['result']	= 0;
			$result['account']	= array();
		}
		return $result;
	}*/

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
}


/* End of file m_admin.html */
/* Location: ./application/modules_core/admin/models/m_admin.html */