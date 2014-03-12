<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_admin extends CI_Model
{
	function admin_login($username,$password){
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
	}
}


/* End of file m_admin.html */
/* Location: ./application/modules_core/admin/models/m_admin.html */