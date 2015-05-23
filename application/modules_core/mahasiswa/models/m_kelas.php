<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kelas extends CI_Model {

	// getKRS
	public function getPertemuan($id_kelasb)
	{							
		$sql = "SELECT *
				FROM fp_pertemuan
				WHERE kelas_buka_id = $id_kelasb
				";

        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return $query;
        }
	}

	public function getKehadiranKelas($id_kelasb, $nim)
	{
		$sql = "SELECT count(kelas_buka_id)'hadir'
				FROM fp_presensi_mhs
				WHERE kelas_buka_id = $id_kelasb AND user_id = $nim
				";
        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
	}

	public function getKehadiranKelasDosen($id_kelasb)
	{
		$sql = "SELECT COUNT(kelas_buka_id)'temu' FROM (SELECT kelas_buka_id
				FROM fp_presensi_dosen
				WHERE kelas_buka_id = $id_kelasb
				GROUP BY pertemuan_id, sesi_id
				ORDER BY pertemuan_id) x
				";

        $query = $this->db->query($sql);

        #kelas_buka_id
        #pertemuannya berbeda
        // echo '<pre>'; print_r($query->result_array()); die;

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
	}

	public function getMhsApakahTerdaftar($id_kelasb, $nim)
	{
		$sql = "SELECT *
				FROM ec_kelas_buka b, ec_peserta p
				WHERE b.id_kelasb = $id_kelasb AND p.nim = $nim AND b.id_kelasb = p.id_kelasb
				";
        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return $query;
        }
	}


}