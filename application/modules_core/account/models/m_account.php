<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_account extends CI_Model
{

	// validate email
	function email_validation($params) {
        $sql = "SELECT email
		FROM eva_user
		WHERE email = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
	}

	// password generator
	function update_password($params) {
		$sql = "UPDATE eva_user SET password=? WHERE email=?";
		return $this->db->query($sql, $params);
	}

	// validate password lama
	function validate_password($params) {
        $sql = "SELECT *
		FROM eva_user
		WHERE username = ? AND password = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
	}

	// edit password
	function edit_password($params) {
		$sql = "UPDATE eva_user SET password=? WHERE username=?";
		return $this->db->query($sql, $params);
	}
}


/* End of file m_admin.html */
/* Location: ./application/modules_core/admin/models/m_admin.html */