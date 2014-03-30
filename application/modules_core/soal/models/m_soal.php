<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_soal extends CI_Model {

	function getPaketSoal($kode=NULL){
		if ($kode != NULL) {
			$sql	= "SELECT * FROM eva_paket WHERE id_paket='$kode'";
		}else{
			$sql	= "SELECT * FROM eva_paket ORDER BY thn_ajaran DESC, semester DESC";
		}
		$sql_result = $this->db->query($sql);

		$result = array();
		if ($sql_result->num_rows() == 1) {
			$result = $sql_result->row();
		}elseif($sql_result->num_rows() > 1){
			$result = $sql_result->result_array();
		}

		return $result;
	}	

	function getPertanyaanByKode($kode){
		$sql		= "SELECT * FROM eva_pertanyaan WHERE id_paket = '$kode' ORDER BY urutan ASC";
		$sql_result = $this->db->query($sql);

		$result = array();
		if ($sql_result->num_rows() > 0) {
			$result = $sql_result->result_array();
		}
		return $result;
	}

	function getAspek(){
		$sql = "SELECT * FROM eva_ref_aspek ORDER BY keterangan ASC";
		$sql_result = $this->db->query($sql);

		$result = array();
		if ($sql_result->num_rows() > 0) {
			$result = $sql_result->result_array();
		}
		return $result;
	}

	function save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan){
		$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$urutan')";
		$result = $this->db->query($sql);

		return $result;
	}
}

/* End of file m_soal.php */
/* Location: ./application/modules_core/soal/models/m_soal.php */