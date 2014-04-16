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
		if($sql_result->num_rows() > 0){
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
		$sql_cek= "SELECT * FROM eva_paket WHERE thn_ajaran = '$thn_ajaran' AND semester = '$semester'";
		$cek 	= $this->db->query($sql_cek);

		if ($cek->num_rows() == 0) {
			$sql 	= "INSERT INTO eva_paket (thn_ajaran,semester,status) VALUES
					  ('$thn_ajaran',UPPER('$semester'),'$status')";
			$result = $this->db->query($sql);

			$data = array();
			if ($result) {
				$data['success'] 		= true;
				$data['inserted_id'] 	= $this->db->insert_id();

			}
		}
		else{
			# data dengan periode yg sama sudah ada
			$data = array();
			if ($result) {
				$data['success'] 		= false;
				$data['error_msg'] 		= "Data dengan periode yang sama sudah ada.";

			}	
		}
		return $data;
	}

	function save_edit_info($id_paket, $thn_ajaran, $semester, $status){
		$sql 	= "UPDATE eva_paket SET thn_ajaran='$thn_ajaran', semester='$semester',status='$status'
				   WHERE id_paket='$id_paket'";
		$result = $this->db->query($sql);
		return $data;
	}

	function save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $keterangan, $urutan){
		$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,keterangan,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$keterangan','$urutan')";
		$result = $this->db->query($sql);

		return $result;
	}

	function save_edit_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $keterangan, $urutan){
		$check 	= "SELECT * FROM eva_pertanyaan WHERE urutan='$urutan' AND id_paket='$id_paket'";
		$result_check = $this->db->query($check);

		#Check whether reow is exist or not
		if ($result_check->num_rows() > 0) {
			# exist, update the old one
			$sql 	= "UPDATE eva_pertanyaan SET isi_pertanyaan='$isi_pertanyaan',id_aspek='$id_aspek',keterangan='$keterangan'
					   WHERE urutan='$urutan' AND id_paket='$id_paket'";
			$result = $this->db->query($sql);
		}else{
			# not exist, create new one
			$sql 	= "INSERT INTO eva_pertanyaan (id_paket,isi_pertanyaan,id_aspek,keterangan,urutan) VALUES
				  ('$id_paket','$isi_pertanyaan','$id_aspek','$keterangan','$urutan')";
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

	function deletePaket($id_paket){
		$sql_del_paket 		= "DELETE FROM eva_paket WHERE id_paket='$id_paket'";
		$sql_del_pertanyaan	= "DELETE FROM eva_pertanyaan WHERE id_paket='$id_paket'";
		$sql_del_deadline	= "DELETE FROM eva_deadline WHERE id_paket='$id_paket'";
		
		$this->db->query($sql_del_deadline);
		$this->db->query($sql_del_pertanyaan);
		$this->db->query($sql_del_paket);
	}

	function allowCreateNewPaket(){
		$sql_empty = "SELECT COUNT(*) AS tot_rows FROM `eva_pertanyaan`";
		$tot_rows = $this->db->query($sql_empty)->row()->tot_rows;

		$sql = "SELECT * FROM eva_paket WHERE UPPER(status) != 'END'";
		$sql_result = $this->db->query($sql);

		if ($sql_result->num_rows() == 0 || $tot_rows == 0) {
			$result = true;
		}
		else{
			$result = false;
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

	function getLatestQuestions(){
		$sql_last_paket 	= "SELECT id_paket FROM eva_paket ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC LIMIT 1";
		$id_paket 			= $this->db->query($sql_last_paket)->row()->id_paket;

		$sql_questions 		= "SELECT per.*,a.`keterangan` as aspek FROM eva_paket pak
								JOIN eva_pertanyaan per ON per.`id_paket` = pak.`id_paket`
								JOIN eva_ref_aspek a ON a.`id_aspek` = per.`id_aspek`
								WHERE pak.`id_paket` = '$id_paket' 
								ORDER BY per.`urutan`";
		$questions 			= $this->db->query($sql_questions);

		$result = array();
		if ($questions->num_rows() > 0) {
			$result = $questions->result_array();
		}

		return $result;
	}

	function getLatestPeriodePaket(){
		$sql_last_periode 	= "SELECT thn_ajaran, semester FROM eva_paket ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC LIMIT 1";
		$periode 			= $this->db->query($sql_last_periode);

		$result = array();
		if ($periode->num_rows() > 0) {
			$result = $periode->result();
		}
		return $result[0];
	}
}

/* End of file m_soal.php */
/* Location: ./application/modules_core/soal/models/m_soal.php */