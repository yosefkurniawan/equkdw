<?php 

class ip_model extends CI_Model
{
	function get_thn_ajaran_periode(){

		$sql = "SELECT semester,th_ajaran FROM kelas_all GROUP BY semester, th_ajaran";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}
	} // end of function get_thn_ajaran_periode()

	function get_dosen_info($nik) {
		$sql = "SELECT d.*,d.nama'nama_dsn',u.unit FROM user_dosen_karyawan d, ref_unit u WHERE d.nik = '$nik' AND d.id_unit = u.id_unit";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->row();
		} // end of if
		else 
		{
			return array();
		}
	}

	function convertIdUnitToProdi($id_unit) {
		$sql = "SELECT * FROM o9_prodi WHERE id_unit = $id_unit";
		$query = $this->db->query($sql);

		if ($query->num_rows() == 1 ) 
		{	
			return $query->row_array();
		} 
		else 
		{
			//in case something suspicious, ex : dosen with no id_unit
			$sql = "SELECT * FROM o9_prodi WHERE id_unit = '0000'";
			$query = $this->db->query($sql);
			return $query->row_array();
		}		
	}

	function get_info_ref_unit($id_unit) {
		$sql = "SELECT * FROM ref_unit WHERE id_unit = '$id_unit' LIMIT 1";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->row()); die;
		if ($query->num_rows() == 1 ) 
		{
			return $query->row();
		} // end of if
		else 
		{
			return array();
		}		
	}

	function get_info_prodi($prodi) {
		$sql = "SELECT * FROM o9_prodi WHERE prodi.prodi = '$prodi' LIMIT 1";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->row()); die;
		if ($query->num_rows() == 1 ) 
		{
			return $query->row();
		} // end of if
		else 
		{
			return array();
		}		
	}

	function getProdiList(){
		$sql = "SELECT * FROM o9_prodi";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->row()); die;
		if ($query->num_rows() > 1 ) 
		{
			return $query->result_array();
		} // end of if
		else 
		{
			return array();
		}
	}

	function get_ip_list($id_unit,$th_ajaran,$semester) {
		// echo $id_unit; echo $th_ajaran; echo $semester; die;
		$sql = "SELECT * FROM user_dosen_karyawan dsn WHERE dsn.id_unit = '$id_unit' ";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;

		$dosen = array();
		foreach ($query->result_array() as $key) {
			$nik = $key['nik'];
			$sql = "SELECT id_kelasb, gelar_prefix, gelar_suffix, nik_baru, nidn, nama_dsn, id_unit, nama_prodi,
					SUM(total_ip/jmlh_mtk)'total_ip',
					COUNT(jmlh_mtk)'jmlh_mtk',
					ROUND(SUM(total_ip/jmlh_mtk) / COUNT(jmlh_mtk),2)'ip_dosen'
					FROM (SELECT kls.id_kelasb,dsn.gelar_prefix,dsn.gelar_suffix,
					dsn.nik'nik_baru',dsn.nidn,dsn.nama'nama_dsn',p.id_unit,p.unit'nama_prodi',
					-- IF(o1.persen_hadir > 90, 4, IF(o1.persen_hadir > 80, 3, 2))'persen_hadir'
					SUM(IF(o1.persen_hadir > 90, 4, IF(o1.persen_hadir > 80, 3, 2))*0.2 + 
					IF(o2.baik > 90, 4, IF(o2.baik > 80, 3, 2))*0.35 + 
					IF(o3.persen_lulus > 60, 4, IF(o3.persen_lulus > 50 , 3, 2))*0.1 + 
					IF(o4.flag_tepat = 'T', 4, 2)*0.15 + 
					o5.eclass*0.2) as total_ip, 
					COUNT(dsn.nik) as jmlh_mtk,
					ROUND(SUM(IF(o1.persen_hadir > 90, 4, IF(o1.persen_hadir > 80, 3, 2))*0.2 + 
					IF(o2.baik > 90, 4, IF(o2.baik > 80, 3, 2))*0.35 + 
					IF(o3.persen_lulus > 60, 4, IF(o3.persen_lulus > 50 , 3, 2))*0.1 + 
					IF(o4.flag_tepat = 'T', 4, 2)*0.15 + 
					o5.eclass*0.2) / COUNT(dsn.nik),2) as ip_dosen
					FROM (SELECT * FROM kelas_all
					WHERE semester = '$semester' AND thn_ajaran = '$th_ajaran' AND eva_status = '1' AND nik = '$nik') kls
					LEFT JOIN user_dosen_karyawan dsn ON kls.nik = dsn.nik
					LEFT JOIN ref_unit p ON dsn.id_unit = p.id_unit
					LEFT JOIN o1_presensi o1 ON kls.mykey = o1.mykey
					LEFT JOIN o2_persenbaik o2 ON kls.mykey = o2.mykey AND kls.nik = o2.nik
					LEFT JOIN o3_nilailulus o3 ON kls.mykey = o3.mykey
					LEFT JOIN o4_nilaimasuk o4 ON kls.mykey = o4.mykey
					LEFT JOIN o5_eclass o5 ON kls.mykey = o5.mykey AND kls.nik = o5.nik
					GROUP BY kls.mykey) x GROUP BY nik_baru";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$dosen[$key['nik']] = $query->row_array();
			}
		}

		$data = $this->array_multi_subsort($dosen, 'ip_dosen');
		$dosen = array_reverse($data, true);
		// echo "<pre>"; print_r($dosen); die;
		return $dosen;		
	}
	
	function array_multi_subsort($array, $subkey)
	{
	    $b = array(); $c = array();

	    foreach ($array as $k => $v)
	    {
	        $b[$k] = strtolower($v[$subkey]);
	    }

	    asort($b);
	    foreach ($b as $key => $val)
	    {
	        $c[] = $array[$key];
	    }

	    return $c;
	}

	function get_prodi_o1($prodi,$th_ajaran,$semester) {

		// $sql = "SELECT o1.kode, dsn.prodi, o1.persen_hadir FROM o1_presensi o1, dosen_all dsn
		// 		WHERE o1.th_ajaran = '$th_ajaran' AND o1.semester = '$semester' AND o1.nik_baru = dsn.nik_baru AND dsn.prodi = '$prodi'";
		// $sql = "SELECT kode, prodi, persen_hadir FROM o1_presensi 

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o1.persen_hadir,kelas.semester, kelas.thn_ajaran
				FROM
				(SELECT dsn.nik'nik_baru',dsn.nama'nama_dsn', dsn.id_unit'prodi_dosen', k.mykey, k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
				LEFT JOIN user_dosen_karyawan dsn ON k.nik = dsn.nik) kelas, o1_presensi o1 
				WHERE o1.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o2($prodi,$th_ajaran,$semester) {


		// $sql = "SELECT o2.kode, dsn.prodi, o2.baik FROM o2_persenbaik o2, dosen_all dsn 
		// 		WHERE o2.th_ajaran = '$th_ajaran' AND o2.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o2.baik,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik'nik_baru',dsn.nama'nama_dsn', dsn.id_unit'prodi_dosen', k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN user_dosen_karyawan dsn ON k.nik_baru = dsn.nik) kelas, o2_persenbaik o2
					WHERE o2.mykey = kelas.mykey AND o2.nik = kelas.nik_baru AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";
		
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o3($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o3.kode, dsn.prodi, o3.persen_lulus FROM o3_nilailulus o3, dosen_all dsn 
		// 		WHERE o3.th_ajaran = '$th_ajaran' AND o3.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o3.persen_lulus,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik'nik_baru',dsn.nama'nama_dsn', dsn.id_unit'prodi_dosen', k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN user_dosen_karyawan dsn ON k.nik_baru = dsn.nik) kelas, o3_nilailulus o3
					WHERE o3.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o4($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o4.kode, dsn.prodi, o4.flag_tepat FROM o4_nilaimasuk o4, dosen_all dsn
		// 		WHERE o4.th_ajaran = '$th_ajaran' AND o4.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o4.flag_tepat,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik'nik_baru',dsn.nama'nama_dsn', dsn.id_unit'prodi_dosen', k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN user_dosen_karyawan dsn ON k.nik_baru = dsn.nik) kelas, o4_nilaimasuk o4
					WHERE o4.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_prodi_o5($prodi,$th_ajaran,$semester) {
		// $sql = "SELECT o5.kode, dsn.prodi, o5.eclass FROM o5_eclass o5, dosen_all dsn 
		// 		WHERE o5.th_ajaran = '$th_ajaran' AND o5.semester = '$semester' AND dsn.prodi = '$prodi'";

		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,kelas.prodi_dosen,kelas.mykey,kelas.nama_mtk,o5.eclass,kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik'nik_baru',dsn.nama'nama_dsn', dsn.id_unit'prodi_dosen', k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN user_dosen_karyawan dsn ON k.nik_baru = dsn.nik) kelas, o5_eclass o5
					WHERE o5.mykey = kelas.mykey AND kelas.prodi_dosen = '$prodi' AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' ";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}



	function get_univ_o1($th_ajaran,$semester) {
		$sql = "SELECT kode, prodi, persen_hadir FROM o1_presensi 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o2($th_ajaran,$semester) {
		$sql = "SELECT kode, baik FROM o2_persenbaik 
				WHERE thn_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o3($th_ajaran,$semester) {
		$sql = "SELECT kode, persen_lulus FROM o3_nilailulus 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o4($th_ajaran,$semester) {
		$sql = "SELECT kode, flag_tepat FROM o4_nilaimasuk 
				WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}

	function get_univ_o5($th_ajaran,$semester) {
		$sql = "SELECT kode, eclass FROM o5_eclass 
				WHERE thn_ajaran = '$th_ajaran' AND semester = '$semester'";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}				
	}


	function updt_kelass_all(){

		$sql = "SELECT * FROM o5_eclass";
		$query = $this->db->query($sql);
		$data =	$query->result();
		foreach ($data as $key) {
			$newkey = trim($key->kode) . trim($key->grup) . trim($key->prodi) . trim($key->semester) . trim($key->th_ajaran);
			$sql = "UPDATE o5_eclass SET mykey = '$newkey' WHERE mykey = '$key->mykey' ";
			$query = $this->db->query($sql);
		}
		echo "berhasil"; die;
	} // end of function get_thn_ajaran_periode()

	function get_dosen_list($th_ajaran,$semester)
	{
		$sql = "SELECT kelas.nik_baru,kelas.nama_dsn,COUNT(kelas.mykey) as jumlah_matkul_ajar, p.prodi, p.nama_prodi, kelas.semester, kelas.thn_ajaran
					FROM
					(SELECT dsn.nik_baru,dsn.nama_dsn,dsn.prodi as prodi_dosen, k.mykey,k.nama_mtk, k.semester, k.thn_ajaran FROM kelas_all k
					LEFT JOIN dosen_all dsn ON k.nik_baru = dsn.nik_baru) kelas, o9_prodi p
					WHERE p.prodi = kelas.prodi_dosen AND kelas.semester = '$semester' AND kelas.thn_ajaran = '$th_ajaran' 
					GROUP BY nama_dsn
					ORDER BY p.prodi ASC";

		// $sql = "SELECT nik_baru, nama_dsn, COUNT(kode) as jumlah_matkul_ajar,k.prodi,nama_prodi FROM kelas_all k
		// 		JOIN prodi p ON k.prodi = p.prodi
		// 		WHERE th_ajaran = '$th_ajaran' AND semester = '$semester'
		// 		GROUP BY nama_dsn";

		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		
		$listDosen = array();
		if ($query->num_rows() > 0) {
			$listDosen = $query->result_array();
		}

		$_result = array();
		// Listing the units
		if ($listDosen) {
			foreach ($listDosen as $key => $dosen) {
				// rename unit if empty
				$prodi 			= $dosen['prodi'];
				$nama_prodi 	= $dosen['nama_prodi'];

				$_result[$prodi]['prodi'] 		= $prodi; 
				$_result[$prodi]['nama_prodi'] 	= $nama_prodi; 
				$_result[$prodi]['listDosen']	= array();
			}
		}

		// Move dosen into unit one by one
		if ($_result) {
			foreach ($_result as $key => $value) {
				foreach ($listDosen as $dosen) {
					if ($dosen['prodi'] == $value['prodi']) {
						$_result[$key]['listDosen'][] = $dosen;
					}
				}
			}
		}
		// echo '<pre>'; print_r($_result); die;
		return $_result;
	} // end of function get_dosen_list

	function get_dosen_ajar($nik,$th_ajaran,$semester)
	{
		$sql = "SELECT matkul.nik as nik_baru, matkul.nama_dsn, matkul.kode, matkul.nama_mtk, matkul.grup, matkul.mykey,
								o1.persen_hadir,o2.baik,o3.persen_lulus,o4.flag_tepat,
								o5.silabus,o5.materi,o5.tugas,o5.nilai,o5.eclass,
								o4.tgl_masuk, 
								o1.rencana,o1.tot_hadir
				FROM
				(SELECT nik, nama_dsn, kode, nama_mtk, grup, mykey FROM kelas_all 
				WHERE thn_ajaran = '$th_ajaran' AND semester = '$semester' AND nik = '$nik' AND eva_status = '1') matkul
				LEFT JOIN o1_presensi o1 ON o1.mykey = matkul.mykey 
				LEFT JOIN o2_persenbaik o2 ON o2.mykey = matkul.mykey AND o2.nik = matkul.nik
				LEFT JOIN o3_nilailulus o3 ON o3.mykey = matkul.mykey 
				LEFT JOIN o4_nilaimasuk o4 ON o4.mykey = matkul.mykey 
				LEFT JOIN o5_eclass o5 ON o5.mykey = matkul.mykey AND o5.nik = matkul.nik
				GROUP BY matkul.mykey
				";
		$query = $this->db->query($sql);
		// echo '<pre>'; print_r($query->result()); die;
		if ($query->num_rows() > 0 ) 
		{
			return $query->result();
		} // end of if
		else 
		{
			return array();
		}		
	} // end of function get_dosen_list

	function convertToOldProdi($new_id) {
		$sql = "SELECT * FROM o9_prodi WHERE prodi = $new_id";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0 ) 
		{	
			return $id = $query->row()->id_unit;
		} 
		else 
		{
			return NULL;
		}		
	}

	function getLastPeriode() {
		$sql_semester 	= "(SELECT MAX(semester) AS semester FROM kelas_all 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM kelas_all))";
		$sql_thn_ajaran = "(SELECT MAX(thn_ajaran) AS thn_ajaran FROM kelas_all 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM kelas_all))";

		$query_semester  = $this->db->query($sql_semester);
		$query_thnAjaran = $this->db->query($sql_thn_ajaran);

		if ($query_semester->num_rows() > 0 && $query_thnAjaran->num_rows() > 0) {	
			$result['semester']   = $query_semester->row()->semester;
			$result['thn_ajaran'] = $query_thnAjaran->row()->thn_ajaran;
			return $result;
		} else {
			return array();
		}	
	}

	function getLastPeriodePaket() {
		$sql_semester 	= "(SELECT MAX(semester) AS semester FROM eva_paket 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket))";
		$sql_thn_ajaran = "(SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket))";
		$sql_deadline = "(SELECT MAX(deadline_o4) AS deadline FROM eva_paket 
						WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM eva_paket))";

		$query_semester  = $this->db->query($sql_semester);
		$query_thnAjaran = $this->db->query($sql_thn_ajaran);
		$query_deadline = $this->db->query($sql_deadline);

		if ($query_semester->num_rows() > 0 && $query_thnAjaran->num_rows() > 0) {	
			$result['semester']   = $query_semester->row()->semester;
			$result['thn_ajaran'] = $query_thnAjaran->row()->thn_ajaran;
			$result['deadline'] = $query_deadline->row()->deadline;
			return $result;
		} else {
			return array();
		}	
	}

	public function getListDosenAktifPerUnit($thn_ajaran,$semester,$id_paket){	
		// set periode
		// if ($id_paket != '') {
		// 	$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
		// 	$query = $this->db->query($sql_latest_paket);
		// 	$semester 	= "'".$query->row()->semester."'";
		// 	$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		// }
		// else{
		// 	$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		// 	$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
		// }

		// echo $semester; echo $thn_ajaran; die;

		// $sql_listDosen 	= "SELECT d.nik,d.nama,d.gelar_suffix,d.gelar_prefix, d.id_unit, IFNULL(u.unit,'zzz') as unit
		// 				FROM ec_kelas_buka k
		// 				JOIN ec_pengajar p ON k.id_kelasb = p.id_kelasb
		// 				JOIN user_dosen_karyawan d ON d.nik = p.nik
		// 				JOIN ec_matkul m ON m.kode = k.kode 
		// 				LEFT JOIN ref_unit u ON u.id_unit = d.id_unit
		// 				WHERE k.semester = $semester
		// 				AND k.thn_ajaran = $thn_ajaran
		// 				AND m.eva_status = 1
		// 				GROUP BY nik, nama, gelar_suffix, gelar_prefix, id_unit, unit
		// 				ORDER BY unit,d.nama ASC";

		$sql_listDosen 	= "SELECT k.nik, k.nama_dsn, d.nama, d.gelar_suffix, d.gelar_prefix, d.id_unit, IFNULL(u.unit,'zzz') as unit
						FROM kelas_all k
						LEFT JOIN user_dosen_karyawan d ON d.nik = k.nik
						LEFT JOIN ref_unit u ON u.id_unit = d.id_unit
						WHERE k.semester = '$semester'
						AND k.thn_ajaran = '$thn_ajaran'
						AND k.eva_status = 1
						AND k.nik != ''
						GROUP BY nik, nama, gelar_suffix, gelar_prefix, id_unit, unit
						ORDER BY unit, k.nik, d.nama ASC";

		// $sql_listDosen 	= "SELECT * FROM kelas_all WHERE nik = '201204178' AND semester = 'GASAL' AND thn_ajaran='2014/2015'";

		$_listDosen = $this->db->query($sql_listDosen);

		// echo "<pre>:"; print_r($_listDosen->result_array());die;


		$listDosen = array();
		if ($_listDosen->num_rows() > 0) {
			$listDosen = $_listDosen->result_array();
		}


		$_result = array();
		// Listing the units
		if ($listDosen) {
			foreach ($listDosen as $key => $dosen) {
				// rename unit if empty
				$id_unit 	= $dosen['id_unit'];
				$unit 		= $dosen['unit'];
				if ($dosen['unit']=='zzz') {
					$id_unit 	= '-';
					$unit 		= 'Tidak Terdaftar';
					$listDosen[$key]['id_unit'] = $id_unit;
					$listDosen[$key]['unit'] 	= $unit;
				}

				$_result[$id_unit]['id_unit'] 	= $id_unit; 
				$_result[$id_unit]['unit'] 		= $unit; 
				$_result[$id_unit]['listDosen']	= array();

				if ($id_paket != '') {
					// create button print laporan per unit
					$_result[$id_unit]['btn_print']	= "<a href='".base_url()."laporan/pdf_hasil_evaluasi_dosen_per_prodi/".$dosen['id_unit']."/".$id_paket."' class='btn btn-med blue-bg btn-print-evaluasi' target='_blank' title='Mencetak hasil evaluasi semua dosen ".$dosen['unit']."'><i class='icon-print'></i> Cetak</a>";				
				}
				else{
					// create button print laporan per unit
					$_result[$id_unit]['btn_print']	= "<a href='".base_url()."laporan/pdf_hasil_evaluasi_dosen_per_prodi/".$dosen['id_unit']."' class='btn btn-med blue-bg btn-print-evaluasi' target='_blank' title='Mencetak hasil evaluasi semua dosen ".$dosen['unit']."'><i class='icon-print'></i> Cetak</a>";				

				}
			}
		}

		// Move dosen into unit one by one
		if ($_result) {
			foreach ($_result as $key => $value) {
				foreach ($listDosen as $dosen) {
					if ($dosen['id_unit'] == $value['id_unit']) {
						$_result[$key]['listDosen'][] = $dosen;
					}
				}
			}
		}

		return $_result;
	}

	function getDosenListPerProdi($id_unit, $semester, $thn_ajaran) {

		$sql_dosen_list = "SELECT d.*, u.unit FROM user_dosen_karyawan d
							JOIN ref_unit u ON u.id_unit = d.id_unit
							JOIN kelas_all k ON k.nik = d.nik AND k.semester = '$semester' AND k.thn_ajaran = '$thn_ajaran'
							WHERE d.id_unit = '$id_unit'
							GROUP BY d.nik";
		
		$query = $this->db->query($sql_dosen_list);
		if ($query->num_rows() > 0 ) {
			return $query->result_array();
		}
		else {
			return array();
		}				

	}

} // end of class