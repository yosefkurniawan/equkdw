<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_soal_tambahan extends CI_Model {

	function getAllMatkul(){
		$sql = "SELECT * FROM ec_matkul 
				WHERE kode != ''
				AND status_matkul = 1";

		$sql_result = $this->db->query($sql);

		$result = array();
		if($sql_result->num_rows() > 0){
			$result = $sql_result->result_array();
		}

		return $result;
	}

	function save_info () {
		$form_type	= $_POST['form_type'];
		$mulai 	= $_POST['mulai'];
		$akhir 	= $_POST['akhir'];
		$nik 	= $_POST['nik'];
		$judul 	= $_POST['judul'];
		$status = $_POST['status'];
		if (!empty($mulai)) {
			$mulai_expl = explode('/', $mulai);
			$mulai 		= $mulai_expl[2].'-'.$mulai_expl[1].'-'.$mulai_expl[0];
		}else{
			$mulai 		= '';
		}
		if (!empty($akhir)) {
			$akhir_expl = explode('/', $akhir);
			$akhir 		= $akhir_expl[2].'-'.$akhir_expl[1].'-'.$akhir_expl[0];
		}else{
			$akhir 		= '';
		}

		$filter_unit 	= $_POST['filter_unit'];
		$filter_kelas 	= $_POST['filter_kelas'];
		$filter_angkatan 	= $_POST['filter_angkatan'];
		$filter_mahasiswa 	= $_POST['filter_mahasiswa'];
		if ($form_type=="new"){
			$sql 	= "INSERT INTO eva_paket_unit_dosen (nik,judul,tgl_mulai,tgl_akhir,id_unit,kode,angkatan,mhs,status) VALUES
					  ('$nik','$judul','$mulai','$akhir','$filter_unit','$filter_kelas','$filter_angkatan','$filter_mahasiswa','$status')";
		}
		else {
			$edit_id_paket = $_POST['edit_id_paket'];
			$sql 	= "UPDATE eva_paket_unit_dosen 
						SET judul 	= '$judul',
						tgl_mulai 	= '$mulai', 
						tgl_akhir	= '$akhir',
						id_unit 	= '$filter_unit',
						kode 		= '$filter_kelas',
						angkatan 	= '$filter_angkatan',
						mhs 		= '$filter_mahasiswa',
						status 		= '$status'
						WHERE id_paket = '$edit_id_paket'";
		}

		$result = $this->db->query($sql);

		$data = array();
		if ($result) {
			$data['success'] 		= true;
			if ($form_type=="new") {
				$data['inserted_id'] 	= $this->db->insert_id();
			}else{
				$data['edited_id'] 		= $edit_id_paket;
			}
		}
		
		return $data;
	}

	function save_pertanyaanTambahan(){
		$form_type		= $_POST['form_type'];
		$id_paket 		= $_POST['id_paket'];
		$listPertanyaan = $_POST['listPertanyaan'];
		$result 		= false;

		// delete pertanyaan if there any of it be deleted when paket is edited
		if ($form_type=="edit") {
			$sql_pertanyaan_old = "SELECT * FROM `eva_pertanyaan_paket_unit_dosen` WHERE id_paket = $id_paket";
			$res_pertanyaan_old = $this->db->query($sql_pertanyaan_old);
			$list_pertanyaan_old = array();
			if ($res_pertanyaan_old->num_rows() > 0) {
				$listPertanyaan_old = $res_pertanyaan_old->result_array();
			}
			if (!empty($listPertanyaan)) {
				foreach ($listPertanyaan_old as $pertanyaan_old) {
					$is_delete = true;
					foreach ($listPertanyaan as $pertanyaan) {
						if ($pertanyaan['id_pertanyaan'] == $pertanyaan_old['id_pertanyaan']) {
							$is_delete = false;
							break;
						}
					}

					$del_id = $pertanyaan_old['id_pertanyaan'] ;
					if ($is_delete) {
						$sql_del_pertanyaan = "DELETE FROM `eva_pertanyaan_paket_unit_dosen` WHERE id_pertanyaan = $del_id";
						$this->db->query($sql_del_pertanyaan);
					}	
				}
			}
		}

		foreach ($listPertanyaan as $key => $pertanyaan) {
			$jenis 			= $pertanyaan['jenis'];
			$isi_pertanyaan	= $pertanyaan['isi_pertanyaan'];
			$pilihan		= $pertanyaan['pilihan'];
			$is_required 	= $pertanyaan['is_required'];
			if (!isset($pertanyaan['id_pertanyaan'])) {
				$sql 	= "INSERT INTO eva_pertanyaan_paket_unit_dosen (id_paket,jenis,isi_pertanyaan,pilihan,required) VALUES
						  ($id_paket,'$jenis','$isi_pertanyaan','$pilihan',$is_required)";
			}else{
				$id_pertanyaan = $pertanyaan['id_pertanyaan'];
				$sql 	= "UPDATE eva_pertanyaan_paket_unit_dosen SET
							jenis 			= '$jenis',
							isi_pertanyaan	= '$isi_pertanyaan',
							pilihan			= '$pilihan',
							required 		= '$is_required'
							WHERE id_paket = $id_paket AND id_pertanyaan = $id_pertanyaan";
			}
			$result = $this->db->query($sql);
			if (!$result) {
				break;
			}
		}

		$data = array();
		if ($result) {
			$data['success'] 		= true;
			if ($form_type=="new") {
				$data['inserted_id'] 	= $this->db->insert_id();
			}else{
				$data['edited_id'] 	= $id_paket;
			}
		}else{
			hapusPaket($id_paket);
		}
		
		return $data;
	}

	function getPaketTambahanByNik($nik){
		$sql = "SELECT * FROM `eva_paket_unit_dosen`
				WHERE nik = '$nik' 
				ORDER BY id_paket DESC";
		$sql_result = $this->db->query($sql);

		$result = array();
		if($sql_result->num_rows() > 0){
			$result = $sql_result->result_array();
		}

		return $result;
	}

	function getInfoPaket($id_paket){
		$sql = "SELECT * FROM `eva_paket_unit_dosen`
				WHERE id_paket = '$id_paket'";
		$sql_result = $this->db->query($sql);

		$result = array();
		if($sql_result->num_rows() > 0){
			$info = $sql_result->row();
			$result['judul']	= $info->judul;
			$result['tgl_mulai']= date("d/m/Y", strtotime($info->tgl_mulai));
			$result['tgl_akhir']= date("d/m/Y", strtotime($info->tgl_akhir));
			$result['status']	= $info->status;
			$result['unit']		= array();
			$result['angkatan']	= array();
			$result['kelas']	= array();
			$result['mahasiswa']= array();

			if (!empty($info->id_unit)) {
				$id_units = explode(',', $info->id_unit);
				foreach ($id_units as $id_unit) {
					$sql_unit = "SELECT id_unit, unit FROM ref_unit WHERE id_unit = $id_unit";
					$res = $this->db->query($sql_unit);
					$unit = array();
					if ($res->num_rows > 0) {
						$unit = $res->row();
					}
					$result['unit'][] = $unit;
				}
			}

			if (!empty($info->angkatan)) {
				$angkatans = explode(',', $info->angkatan);
				$result['angkatan'] = $angkatans;
			}

			if (!empty($info->kode)) {
				$kodes = explode(',', $info->kode);
				foreach ($kodes as $kode) {
					$sql_kelas = "SELECT kode, nama FROM ec_matkul WHERE kode = '$kode'";
					$res = $this->db->query($sql_kelas);
					$unit = array();
					if ($res->num_rows > 0) {
						$kelas = $res->row();
					}
					$result['kelas'][] = $kelas;
				}
			}

			if (!empty($info->mhs)) {
				$nims = explode(',', $info->mhs);
				$result['mahasiswa'] = $nims;
			}
		}
		return $result;
	}

	function getListPertanyaan($id_paket){
		$sql = "SELECT * FROM `eva_pertanyaan_paket_unit_dosen`
				WHERE id_paket = '$id_paket'";
		$sql_result = $this->db->query($sql);

		$result = array();
		if($sql_result->num_rows() > 0){
			$result = $sql_result->result_array();
		}

		return $result;
	}

	function hapusPaket($id_paket){
		$sql_hapus_pertanyaan 	= "DELETE FROM `eva_pertanyaan_paket_unit_dosen` WHERE id_paket = $id_paket";
		$sql_hapus_paket_info 	= "DELETE FROM `eva_paket_unit_dosen` WHERE id_paket = $id_paket";
		$result = $this->db->query($sql_hapus_pertanyaan);
		if ($result) {
			$this->db->query($sql_hapus_paket_info);
		}

		return $result;
	}
}

/* End of file m_soal_tambahan.php */
/* Location: ./application/modules_core/soal/models/m_soal_tambahan.php */