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
			$prodi 		= $mtk->prodi;
			$semester 	= $mtk->semester;
			$thn_ajaran = $mtk->thn_ajaran;
			
			$tgl_masuk 	= $_POST['tgl_masuk'];
			$tgl_masuk 	= explode('/', $tgl_masuk);
			$tgl_masuk 	= $tgl_masuk[2].'-'.$tgl_masuk[1].'-'.$tgl_masuk[0];
			
			$flag_tepat = $_POST['flag_tepat'];
			$mykey 		= $mtk->id_kelasb.$mtk->kode;

			
			// check is it exist already?
			$sql_cek = "SELECT * FROM o4_nilaimasuk WHERE mykey = '$mykey'";
			$query_cek = $this->db->query($sql_cek);

			// echo "<pre>";
			// print_r($mtk);
			// print_r($_POST);die;

			if (!$query_cek->num_rows() > 0) {
				
				$sql = "INSERT INTO o4_nilaimasuk (kode,grup,prodi,tgl_masuk,flag_tepat,semester,th_ajaran,mykey) VALUES
						('$kode','$grup','$prodi','$tgl_masuk','$flag_tepat','$semester','$thn_ajaran','$mykey')";

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

	function setDeadline() {
		if( $this->input->post('deadline')) {
			$dl = $this->input->post('deadline');	
			$dl = explode('/', $dl);
			$deadline = $dl[2].'-'.$dl[1].'-'.$dl[0];
		} else {
			$deadline = '';
		}

		$sql_semester 	= "(SELECT MAX(semester) as semester FROM eva_paket 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket))";
		$sql_thn_ajaran = "(SELECT MAX(thn_ajaran) as thn_ajaran FROM eva_paket)";

		$semester 	= $this->db->query($sql_semester)->row()->semester;
		$thn_ajaran = $this->db->query($sql_thn_ajaran)->row()->thn_ajaran;

		$data = array(
           'deadline_o4' => $deadline,
           'semester' 	=> $semester,
           'thn_ajaran' => $thn_ajaran
        );
		$this->db->where('semester',$semester);
		$this->db->where('thn_ajaran',$thn_ajaran);
		$result = $this->db->update('eva_paket',$data);
		
		if ($result) {
		 	return true;
		} else {
		 	return false;
		}				
	}

	function getDeadline($timestamp = false) {
		/* NOTE::
		 * 2 modes:
		 * - $timestamp = false --> get deadline as a date
		 * - $timestamp = false --> get deadline as a timestamp
		 */

		$semester 	= "(SELECT MAX(semester) FROM eva_paket 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket))";
		$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM eva_paket)";

		$sql = "SELECT deadline_o4 FROM eva_paket WHERE semester = $semester AND thn_ajaran = $thn_ajaran";
		$deadline = $this->db->query($sql);

		if ($deadline->num_rows > 0) {			
			$dl = $deadline->row()->deadline_o4;
			if (!$timestamp) {
				/* if get deadline as date */
				if (!empty($dl)) {
					$dl = explode('-', $dl);
					$deadline = $dl[2].'/'.$dl[1].'/'.$dl[0];	
					return $deadline;
				}else{
					return false;
				}
			}else{
				/* if get deadline as timestamp */

				if (!empty($dl)) {
					return strtotime($dl);
				}else{
					return false;
				}
			}
		} else {
		 	return false;
		}	
	}
}