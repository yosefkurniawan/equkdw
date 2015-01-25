<?php 

class M_o4 extends CI_Model{

	function getListMtk($prodi = NULL, $semester = NULL, $thn_ajaran = NULL) {

		if ($semester) {
			$where_semester = " AND k.semester = '$semester'";			
		}else{
			$where_semester = " AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka 
							WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}

		if ($thn_ajaran) {
			$where_thn_ajaran = " AND k.thn_ajaran = '$thn_ajaran'";			
		}else{
			$where_thn_ajaran = " AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka 
								WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		}

		if ($prodi) { $where_prodi = " AND k.prodi = $prodi"; }

		$sql = "SELECT k.*, o4.tgl_masuk, o4.flag_tepat FROM kelas_all k
				LEFT JOIN o4_nilaimasuk o4 ON o4.mykey = k.id_kelasb
				WHERE 1 = 1 $where_semester $where_thn_ajaran $where_prodi
				GROUP BY k.kode";

		$query = $this->db->query($sql);
		// echo "<pre>"; print_r($sql); die;
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

	function save_2015_01_24() {
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
			$mykey 		= $mtk->id_kelasb;

			
			// check is it exist already?
			$sql_cek = "SELECT * FROM o4_nilaimasuk WHERE mykey = '$mykey'";
			$query_cek = $this->db->query($sql_cek);

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

	function save_ajax() {
		if ($_POST) {
			$kode 		= $_POST['kode'];
			$grup 		= $_POST['grup'];
			$prodi 		= $_POST['prodi'];
			$semester 	= $_POST['semester'];
			$thn_ajaran = $_POST['thn_ajaran'];
			
			$tgl_masuk  = '';
			if ($_POST['tgl_masuk'] != '' || !empty($_POST['tgl_masuk'])) {
				$tgl_masuk 	= $_POST['tgl_masuk'];
				$tgl_masuk 	= explode('/', $tgl_masuk);
				$tgl_masuk 	= $tgl_masuk[2].'-'.$tgl_masuk[1].'-'.$tgl_masuk[0];
			}
			
			$flag_tepat = $_POST['flag_tepat'];
			$mykey 		= $_POST['id_kelasb'];

			// check is it exist already?
			$sql_cek = "SELECT * FROM o4_nilaimasuk WHERE mykey = '$mykey'";
			$query_cek = $this->db->query($sql_cek);

			if (!$query_cek->num_rows() > 0) {
				
				$sql = "INSERT INTO o4_nilaimasuk (kode,grup,prodi,tgl_masuk,flag_tepat,semester,th_ajaran,mykey) VALUES
						('$kode','$grup','$prodi','$tgl_masuk','$flag_tepat','$semester','$thn_ajaran','$mykey')";

				$result = $this->db->query($sql);
			}else{
				if ($tgl_masuk != '' || !empty($tgl_masuk)) {
					$sql = "UPDATE o4_nilaimasuk SET tgl_masuk = '$tgl_masuk', flag_tepat = '$flag_tepat'
							WHERE mykey = '$mykey'";

					$result = $this->db->query($sql);
				}else{
					// if tgl_masuk is empty, it means delete it
					$sql = "DELETE FROM o4_nilaimasuk
							WHERE mykey = '$mykey'";

					$result = $this->db->query($sql);
				}

			}

			if ($result) {
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}

	function saveGrid() {
		if ($_POST) {
			// echo "<pre>"; print_r($_POST);die;

			$countSaved 	= 0;
			$countUpdated 	= 0;
			$countFailed	= 0;

			foreach ($_POST['flag_tepat'] as $key => $flag_tepat) {
				
				$semester 	= $_POST['semester'];
				$thn_ajaran = $_POST['thn_ajaran'];
				$kode 		= $_POST['kode'][$key];
				$grup 		= $_POST['grup'][$key];
				
				if ($_POST['tgl_masuk'][$key]) {
					$tgl_masuk_raw = $_POST['tgl_masuk'][$key];
					$tgl_masuk_exp = explode('/', $tgl_masuk_raw);
					$tgl_masuk     = $tgl_masuk_exp[2].'-'.$tgl_masuk_exp[1].'-'.$tgl_masuk_exp[0];
				}else{
					$tgl_masuk = '';
				}
				
				$mykey 		= $_POST['id_kelasb'][$key];

				// prodi id mapping
				if ($_POST['prodi'] != 'others') {
					$prodi = $_POST['prodi'];
				}else{
					$alt_id = substr($kode, 0, 2);
					
					if (strtoupper($alt_id) == 'PB') {
						$prodi = 'PA';
					}else{
						$prodi = '99';
					}
				}


				// check does it exist already?
				$sql_cek = "SELECT * FROM o4_nilaimasuk WHERE mykey = '$mykey'";
				$query_cek = $this->db->query($sql_cek);
				$result_row = $query_cek->row();

				if (!$query_cek->num_rows() > 0) {
					
					// save data with flag 'T' or 'F' only
					if ($flag_tepat == 'T' || $flag_tepat == 'F') {
						
						$sql = "INSERT INTO o4_nilaimasuk (kode,grup,prodi,tgl_masuk,flag_tepat,semester,th_ajaran,mykey) VALUES
								('$kode','$grup','$prodi','$tgl_masuk','$flag_tepat','$semester','$thn_ajaran','$mykey')";

						$result = $this->db->query($sql);

						if ($result) {
							$countSaved++;
						}else{
							$countFailed++;
						}
					}
				}else{
					
					if ($tgl_masuk != '' || !empty($tgl_masuk)) {
						$sql = "UPDATE o4_nilaimasuk SET tgl_masuk = '$tgl_masuk', flag_tepat = '$flag_tepat'
								WHERE mykey = '$mykey'";

						$result = $this->db->query($sql);
					}else{
						// if tgl_masuk is empty, it means delete it
						$sql = "DELETE FROM o4_nilaimasuk
								WHERE mykey = '$mykey'";

						$result = $this->db->query($sql);
					}

					if ($result) {
						$countUpdated++;
					}else{
						$countFailed++;
					}

				}
			}

			$data = array();
			if ($countSaved > 0 || $countUpdated > 0 || $countFailed > 0) {

				if ($countSaved > 0) {
					$data['alert']['status'][] 	= 'success';
					$data['alert']['msg'][] = $countSaved.' data berhasil disimpan.';
				}
				if ($countUpdated > 0) {
					$data['alert']['status'][] 	= 'success';
					$data['alert']['msg'][] = $countUpdated.' data berhasil diperbarui.';
				}
				if ($countFailed > 0) {
					$data['alert']['status'][] 	= 'danger';
					$data['alert']['msg'][] = $countFailed.' data gagal disimpan.';
				}
			}else{
				$data['alert']['status'][] 	= 'warning';
				$data['alert']['msg'][] 	= 'Tidak ada data yang disimpan.';
			}

			return $data;
		}else{
			$data['alert']['status'][] 	= 'warning';
			$data['alert']['msg'][] 	= 'Tidak ada data yang disimpan.';
		
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