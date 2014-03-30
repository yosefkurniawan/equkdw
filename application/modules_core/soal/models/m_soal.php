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

	function getProdi(){
		$sql 	= "SELECT * FROM ref_unit WHERE sifat LIKE 'Akademis' AND id_parent != '0000'";
		$sql_result = $this->db->query($sql);

		$result = array();
		if ($sql_result->num_rows() > 0) {
			$result = $sql_result->result_array();
		}
		return $result;
	}

	function save_info($id_paket, $thn_ajaran, $semester, $status){
		$sql 	= "INSERT INTO eva_paket (id_paket,thn_ajaran,semester,status) VALUES
				  ('$id_paket','$thn_ajaran',UPPER('$semester'),'$status')";
		$result = $this->db->query($sql);

		return $result;
	}

	function save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan){
		$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$urutan')";
		$result = $this->db->query($sql);

		return $result;
	}

	function save_jadwal($id_paket, $id_unit, $tgl_mulai, $tgl_akhir){
		$tgl_mulai_expl = explode('/', $tgl_mulai);
		$tgl_mulai 		= $tgl_mulai_expl[2].'-'.$tgl_mulai_expl[1].'-'.$tgl_mulai_expl[0];
		$tgl_akhir_expl = explode('/', $tgl_akhir);
		$tgl_akhir 		= $tgl_akhir_expl[2].'-'.$tgl_akhir_expl[1].'-'.$tgl_akhir_expl[0];
		$sql 	= "INSERT INTO eva_deadline (id_paket,id_unit,tgl_mulai,tgl_akhir) VALUES
				  ('$id_paket','$id_unit','$tgl_mulai','$tgl_akhir')";
		$result = $this->db->query($sql);

		return $result;
	}
}

/* End of file m_soal.php */
/* Location: ./application/modules_core/soal/models/m_soal.php */