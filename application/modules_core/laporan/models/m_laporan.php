<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function getListDosenByIdUnit($id_unit){
		$sql 	= "SELECT * FROM user_dosen_karyawan WHERE id_unit = '$id_unit' ORDER BY nama ASC";
		$result = $this->db->query($sql);

		$dosen = array();
		if ($result->num_rows() > 0) {
			$dosen = $result->result_array();
		}

		return $dosen;
	}

}

/* End of file m_laporan.php */
/* Location: ./application/modules_core/laporan/models/m_laporan.php */