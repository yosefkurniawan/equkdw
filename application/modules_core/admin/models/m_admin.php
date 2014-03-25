<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_admin extends CI_Model
{
	function admin_login($username,$password){
		$result		= array();
		$sql 		= "SELECT * FROM eva_user u WHERE u.username='$username' AND u.password=MD5('$password')";
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

	function cek_admin_login(){
		if ( (isset($this->session->userdata['is_super_admin']) && $this->session->userdata['is_super_admin']) ||
			 (isset($this->session->userdata['is_admin']) && $this->session->userdata['is_admin']) ) {
			return true;
		}
		else
			return false;
	}	
}


/* End of file m_admin.html */
/* Location: ./application/modules_core/admin/models/m_admin.html */