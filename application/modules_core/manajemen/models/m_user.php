<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_user extends CI_Model
{
	// get all user
	function get_all_user() {
        $sql = "SELECT *
            FROM eva_user WHERE status != 'dihapus' ORDER BY username";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
	}

    // get user detail
    function get_user_detail($params) {
        $sql = "SELECT *
            FROM eva_user
            WHERE id=?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    // tambah user
    function tambah_user($params) {
        $sql = "INSERT INTO eva_user(email, username, password, role, date_created) VALUES(?,?,?,?,NOW())";
        return $this->db->query($sql, $params);
    }

    // ubah user
    function ubah_user($params) {
        $sql = "UPDATE eva_user SET role=? WHERE id=?";
        return $this->db->query($sql, $params);
    }

    // delete account
    function delete_user($params) {
        $sql = "UPDATE eva_user SET status='dihapus' WHERE id=?";
        return $this->db->query($sql, $params);
    }

    // activated account
    function activated($params) {
        $sql = "UPDATE eva_user SET status='aktif' WHERE id=?";
        return $this->db->query($sql, $params);
    }

    // deactivated account
    function deactivated($params) {
        $sql = "UPDATE eva_user SET status='tidak aktif' WHERE id=?";
        return $this->db->query($sql, $params);
    }
}
