<?php 

class M_o4 extends CI_Model{

	function getListMtk() {
		$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";

		$sql = "SELECT * FROM kelas_all 
				WHERE semester = $semester AND thn_ajaran = $thn_ajaran 
				GROUP BY kode";

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getMtk($id_kelasb) {
		$sql = "SELECT * FROM kelas_all 
				WHERE id_kelasb = $id_kelasb";

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($query->result_array()); die;
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return array();
		}
	}

	function save() {
		if ($_POST) {
			
			$id_kelasb = $_POST['id_kelasb'];

			$mtk = $this->getMtk($id_kelasb);
			

			$kode 		= $mtk->kode;
			$grup 		= $mtk->grup;
			$semester 	= $mtk->semester;
			$thn_ajaran = $mtk->thn_ajaran;
			$tgl_masuk 	= $_POST['tgl_masuk'];
			$flag_tepat = $_POST['flag_tepat'];
			$mykey 		= $mtk->id_kelasb.$mtk->kode;

			
			// check is it exist already?
			$sql_cek = "SELECT * FROM o4_nilaimasuk_copy WHERE mykey = '$mykey'";
			$query_cek = $this->db->query($sql_cek);

			// echo "<pre>";
			// print_r($mtk);
			// print_r($_POST);die;

			if (!$query_cek->num_rows() > 0) {
				
				$sql = "INSERT INTO o4_nilaimasuk_copy (kode,grup,tgl_masuk,flag_tepat,semester,th_ajaran,mykey) VALUES
						('$kode','$grup','$tgl_masuk','$flag_tepat','$semester','$thn_ajaran','$mykey')";

				$result = $this->db->query($sql);

				$data = array();
				if ($result) {
					$data['alert']['status'] 	= 'success';
					$data['alert']['msg'] 		= 'Data berhasil disimpan.';
				}else{
					$data['alert']['status'] 	= 'danger';
					$data['alert']['msg'] 		= 'Unknown error.';
				}

				return $data;
			}else{
				
				$data['alert']['status'] 	= 'danger';
				$data['alert']['msg'] 		= 'Matakuliah tersebut sudah pernah diinputkan.';

				return $data;
			}

		}else {
			$data['alert']['status'] 	= 'danger';
			$data['alert']['msg'] 		= 'Tidak ada data yang disimpan.';
		
			return $data;
		}
	}
}