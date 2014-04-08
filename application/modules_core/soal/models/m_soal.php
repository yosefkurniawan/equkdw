<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_soal extends CI_Model {

	function getRowsPaketSoal () {
		$sql = "SELECT * FROM eva_paket";
		$sql_result = $this->db->query($sql);

		$rows = $sql_result->num_rows();

		return $rows;
	}

	function getPaketSoal($page,$limit){
		$sql	= "SELECT * FROM eva_paket ORDER BY id_paket DESC LIMIT $page,$limit";
		$sql_result = $this->db->query($sql);

		$result = array();
		if($sql_result->num_rows() > 1){
			$result = $sql_result->result_array();
		}

		return $result;
	}

	function getPaketSoalByKode($kode){
		$sql	= "SELECT * FROM eva_paket WHERE id_paket='$kode'";
		$sql_result = $this->db->query($sql);

		$result = array();
		if ($sql_result->num_rows() > 0) {
			$result = $sql_result->row();
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

	function getJadwalByKode($kode){
		$sql		= "SELECT * FROM eva_deadline WHERE id_paket = '$kode'";
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

	function save_info($thn_ajaran, $semester, $status){
		$sql 	= "INSERT INTO eva_paket (thn_ajaran,semester,status) VALUES
				  ('$thn_ajaran',UPPER('$semester'),'$status')";
		$result = $this->db->query($sql);

		$data = array();
		if ($result) {
			$data['success'] 		= true;
			$data['inserted_id'] 	= $this->db->insert_id();

		}
		return $data;
	}

	function save_edit_info($id_paket, $thn_ajaran, $semester, $status){
		$sql 	= "UPDATE eva_paket SET thn_ajaran='$thn_ajaran', semester='$semester',status='$status'
				   WHERE id_paket='$id_paket'";
		$result = $this->db->query($sql);
		return $data;
	}

	function save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan){
		$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$urutan')";
		$result = $this->db->query($sql);

		return $result;
	}

	function save_edit_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan){
		$check 	= "SELECT * FROM eva_pertanyaan WHERE urutan='$urutan' AND id_paket='$id_paket'";
		$result_check = $this->db->query($check);

		#Check whether reow is exist or not
		if ($result_check->num_rows() > 0) {
			# exist, update the old one
			$sql 	= "UPDATE eva_pertanyaan SET isi_pertanyaan='$isi_pertanyaan',id_aspek='$id_aspek'
					   WHERE urutan='$urutan' AND id_paket='$id_paket'";
			$result = $this->db->query($sql);
		}else{
			# not exist, create new one
			$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$urutan')";
			$result = $this->db->query($sql);
		}

		return $result;
	}

	function save_jadwal($id_paket, $id_unit, $tgl_mulai, $tgl_akhir){
		if (!empty($tgl_mulai)) {
			$tgl_mulai_expl = explode('/', $tgl_mulai);
			$tgl_mulai 		= $tgl_mulai_expl[2].'-'.$tgl_mulai_expl[1].'-'.$tgl_mulai_expl[0];
		}else{
			$tgl_mulai 		= '';
		}
		if (!empty($tgl_mulai)) {
			$tgl_akhir_expl = explode('/', $tgl_akhir);
			$tgl_akhir 		= $tgl_akhir_expl[2].'-'.$tgl_akhir_expl[1].'-'.$tgl_akhir_expl[0];
		}else{
			$tgl_akhir 		= '';
		}

		$sql 	= "INSERT INTO eva_deadline (id_paket,id_unit,tgl_mulai,tgl_akhir) VALUES
				  ('$id_paket','$id_unit','$tgl_mulai','$tgl_akhir')";
		$result = $this->db->query($sql);

		return $result;
	}

	function save_edit_jadwal($id_paket, $id_unit, $tgl_mulai, $tgl_akhir){
		if (!empty($tgl_mulai)) {
			$tgl_mulai_expl = explode('/', $tgl_mulai);
			$tgl_mulai 		= $tgl_mulai_expl[2].'-'.$tgl_mulai_expl[1].'-'.$tgl_mulai_expl[0];
		}else{
			$tgl_mulai 		= '';
		}
		if (!empty($tgl_mulai)) {
			$tgl_akhir_expl = explode('/', $tgl_akhir);
			$tgl_akhir 		= $tgl_akhir_expl[2].'-'.$tgl_akhir_expl[1].'-'.$tgl_akhir_expl[0];
		}else{
			$tgl_akhir 		= '';
		}

		# First, check whether row is exist or not
		$check 	= "SELECT * FROM eva_deadline WHERE id_paket = '$id_paket' AND id_unit='$id_unit'";
		$result_check = $this->db->query($check);

		if ($result_check->num_rows() > 0) {
			# exist, update the old one
			$sql 	= "UPDATE eva_deadline SET tgl_mulai='$tgl_mulai',tgl_akhir='$tgl_akhir'
					   WHERE id_paket='$id_paket' AND id_unit='$id_unit'";
			$result = $this->db->query($sql);
		}
		else{
			# not exist, create new
			$sql 	= "INSERT INTO eva_deadline (id_paket,id_unit,tgl_mulai,tgl_akhir) VALUES
				  ('$id_paket','$id_unit','$tgl_mulai','$tgl_akhir')";
			$result = $this->db->query($sql);
		}
		
		return $result;
	}

	function allowCreateNewPaket(){
		$sql = "SELECT * FROM eva_paket WHERE UPPER(status) != 'END'";
		$sql_result = $this->db->query($sql);

		if ($sql_result->num_rows() > 0) {
			$result = false;
		}
		else{
			$result = true;
		}
		return $result;
	}

	# This function used for check and update status of on going paket
	function updateStatusLastPaket(){
		# check paket with status public
		$sql_public = "SELECT * FROM eva_paket WHERE UPPER(`status`)=UPPER('public')";
		$sql_public_result = $this->db->query($sql_public);
		if ($sql_public_result->num_rows() > 0) {
			$public_paket = $sql_public_result->result_array();
			# check every public paket
			foreach ($public_paket as $key => $paket) {
				# get latest period
				$id_paket = $paket['id_paket'];
				$sql_last_period 	= "SELECT MAX(`tgl_akhir`) as 'last_period' FROM eva_deadline WHERE `id_paket`='$id_paket'";
				$last_period 		= strtotime($this->db->query($sql_last_period)->row()->last_period);
				$today 				= strtotime(date('Y-m-d'));

				if ($today > $last_period) {
					$sql_update = "UPDATE eva_paket SET status = 'end' WHERE id_paket = '$id_paket'";
					$update 	= $this->db->query($sql_update);
				}
			}
		}
	}
}

/* End of file m_soal.php */
/* Location: ./application/modules_core/soal/models/m_soal.php */