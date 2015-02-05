<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfigurasi extends MX_Controller {

	public function __construct() {
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('main/page404');	
		} 

		$this->load->model('laporan/m_laporan_matkul');
		$this->load->model('laporan/m_laporan');
		$this->load->model('main/m_general');
		$this->load->model('ip_model');
		$this->load->model('m_dosen');
		$this->load->model('m_olahan');
		$this->load->model('m_o4');
	}

	function index(){
		redirect('ip/konfigurasi/data');
	}

	public function data($id_paket='') 
	{
		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$th_ajaran = $this->m_o4->getLastPeriodeDeadline();
			$periode['thn_ajaran'] 		= $th_ajaran['thn_ajaran'];
			$periode['semester']		= $th_ajaran['semester'];
			$data['kelas_all_check']	= $this->m_olahan->getKelasAll('',false);		
			$data['kelas_all']			= $this->m_olahan->getKelasAll();		
			$data['o5_data']			= $this->m_olahan->getEClassData();		
			$data['o2_persenbaik']		= $this->m_olahan->getPersenBaikData();
			$data['o1_raw']				= $this->m_olahan->getPresensiDosenRaw();
			$data['o3_raw']				= $this->m_olahan->getNilaiKelulusanRaw();
		}
		else {
			$data['id_paket'] 			= $id_paket;
			$periode['thn_ajaran']		= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']		= $this->m_laporan->getPaketList($id_paket)->semester;
			$data['kelas_all_check']	= $this->m_olahan->getKelasAll($id_paket,false);		
			$data['kelas_all']			= $this->m_olahan->getKelasAll($id_paket);		
			$data['o5_data']			= $this->m_olahan->getEClassData($id_paket);		
			$data['o2_persenbaik']		= $this->m_olahan->getPersenBaikData($id_paket);
			$data['o1_raw']				= $this->m_olahan->getPresensiDosenRaw($id_paket);
			$data['o3_raw']				= $this->m_olahan->getNilaiKelulusanRaw($id_paket);
		}

		/* -- Render Layout -- */
		$data['prodi_list']			= $this->ip_model->getProdiList();		
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['periode'] 			= $periode;
		$data['title'] 				= "Konfigurasi IP Dosen";
		$data['content'] 			= 'ip/konfigurasi/form';
		$data['custom_css'][] 		= 'public/assets/css/ip.css';
		$this->load->view('main/render_layout',$data);		
	}

	public function pengajar($id_paket='') {

		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$th_ajaran = $this->m_o4->getLastPeriodeDeadline();
			$periode['thn_ajaran'] 		= $th_ajaran['thn_ajaran'];
			$periode['semester']		= $th_ajaran['semester'];
			$data['dosen_list']			= $this->m_dosen->getAllKelasProblem();		
		}
		else {
			$data['id_paket'] 			= $id_paket;
			$periode['thn_ajaran']		= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']		= $this->m_laporan->getPaketList($id_paket)->semester;
			$data['dosen_list']			= $this->m_dosen->getAllKelasProblem($id_paket);		
		}
		/* -- Render Layout -- */
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['unit_list']			= $this->m_laporan_matkul->getUnitList();
		$data['title'] 		= "Konfigurasi Dosen Pengajar";
		$data['content'] 	= 'ip/konfigurasi/dosen_list';
		// $data['custom_css'][] 	= 'public/assets/css/ip.css';
		$this->load->view('main/render_layout',$data);		
	}

	public function upload_o1() {
		$afterInsert = $_POST['o1'];
	    $status = "";
	    $msg = "";
	    $file_element_name = 'userfile';
	     
	    if ($status != "error")
	    {
	        $config['upload_path'] = './temp_upload/';
	        $config['allowed_types'] = 'csv';
	        $config['encrypt_name'] = TRUE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload())
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	            $data = $this->upload->display_errors('', '');
	        }
	        else
	        {

	            $upload_data = $this->upload->data();
	            $file =  $upload_data['full_path'];

		        $_file 	= file_get_contents($file);
				$result = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $_file));
				$result = $this->reformatArrayOfCsv_o1_presensi($result);
		        // $this->load->library('csvreader');
		        // $result =   $this->csvreader->parse_file($file);
		        $data['csvData'] =  $result;
		        $validasi = true;
		        $row = 0;
		        foreach ($result as $key => $value) {
		        	if ($_POST['methodTerisi'] == '1') {
			            if ( (!isset($value['kode'])) OR (!isset($value['grup'])) OR (!isset($value['prodi'])) OR
			            	(!isset($value['tot_hadir'])) OR (!isset($value['semester'])) OR 
			            	(!isset($value['th_ajaran']))) 
				            {
				            	$validasi = false;
				                $status = "error";
				                $msg = $row." Format CSV Salah (Harus terdiri dari : kode, grup, prodi, tot_hadir, semester, dan thn_ajaran";
				            	break;
				            }
		        	} else {
			            if ( (!isset($value['kode'])) OR (!isset($value['grup'])) OR (!isset($value['prodi'])) OR
				            	(!isset($value['tot_hadir'])) OR (!isset($value['semester'])) OR 
				            	(!isset($value['th_ajaran'])) OR (!isset($value['rencana']))) 
					            {
					            	$validasi = false;
					                $status = "error";
					                $msg = $row." Format CSV Salah (Harus terdiri dari : kode, grup, prodi, tot_hadir, rencana, semester, dan thn_ajaran";
					            	break;
					            }
		        	}

			         $row = $row + 1;
		        }
		        $simpan = 0;
		        if ($validasi == true) {
		        	// echo $_POST['thn_ajaran'].' '.$_POST['semester'] ; die;
		        	//yang kurang
		        	if ($_POST['method'] == '1') {
		        		//delete all value
		        		$this->m_olahan->delete_o1_raw($_POST['thn_ajaran'],$_POST['semester']);
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
						            $sks = $this->m_olahan->get_sks_info($value['kode']);
						        	if ($_POST['methodTerisi'] == '1') {
							            if ($sks <= 3) {						            	
						        			$value['rencana'] = $_POST['rencana'];
							            } else {
						        			$value['rencana'] = $_POST['rencana'] * 2;						            	
							            }
						        	} else {
						        		if ($value['rencana'] != null) {
						        			$value['rencana'] = $value['rencana'];
						        		} else {
								            if ($sks <= 3) {						            	
							        			$value['rencana'] = $_POST['rencana'];
								            } else {
							        			$value['rencana'] = $_POST['rencana'] * 2;						            	
								            }						        			
						        		}
						        	}
				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_presensi_dosen($value);
				        	}				  
				        }
		                $status = "success";
		                $msg = "Data berhasil disimpan di dalam database (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	} elseif ($_POST['method'] == '0') {
			        	//metode : delete all then insert / existing replace + insert
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
						            $sks = $this->m_olahan->get_sks_info($value['kode']);
						        	if ($_POST['methodTerisi'] == '1') {
							            if ($sks <= 3) {						            	
						        			$value['rencana'] = $_POST['rencana'];
							            } else {
						        			$value['rencana'] = $_POST['rencana'] * 2;						            	
							            }
						        	} else {
						        		if ($value['rencana'] != null) {
						        			$value['rencana'] = $value['rencana'];
						        		} else {
								            if ($sks <= 3) {						            	
							        			$value['rencana'] = $_POST['rencana'];
								            } else {
							        			$value['rencana'] = $_POST['rencana'] * 2;						            	
								            }						        			
						        		}
						        	}				        			
						        	$value['rencana'] = $_POST['rencana'];
				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_presensi_dosen($value,true);
				        	}

				        }
		                $status = "success";
		                $msg = "Data berhasil disimpan di dalam database (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	}
		        	else {
		                $status = "error";
		                $msg = "Metode Harus dipilih";
		        	}
			    }
	        }
	        @unlink($_FILES[$file_element_name]);
	    }
		header('Content-Type: application/json');
	    echo json_encode(array('infox' => $data,'status' => $status, 'msg' => $msg, 'rowCount' => $afterInsert));
	}

	public function upload_o3_nilai() {
		header('Content-Type: application/json');
		$afterInsert = $_POST['o3'];
		$prodi = $_POST['prodi'];
	    $status = "";
	    $msg = "";
	    $data = array();
	    $file_element_name = 'userfile_o3_nilai';

	    if ($status != "error")
	    {
	        $config['upload_path'] = './temp_upload/';
	        $config['allowed_types'] = 'csv';
	        $config['encrypt_name'] = TRUE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	            $data = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $upload_data = $this->upload->data();
	            $file =  $upload_data['full_path'];

		        $_file 	= file_get_contents($file);
				$result = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $_file));
				$result = $this->reformatArrayOfCsv_o3_nilai($result);
		        $data['csvData'] =  $result;
		        $validasi = true;
		        $row = 0;

		        foreach ($result as $key => $value) {
		            if ( !isset($value['nim']) OR !isset($value['kode']) OR !isset($value['sks']) OR
		            	!isset($value['harga']) OR !isset($value['grup']) OR 
		            	!isset($value['semester']) OR !isset($value['th_ajaran']))
			            {
			            	$validasi = false;
			                $status = "error";
			                $msg = "Data nilai gagal disimpan. Format CSV Salah (Harus terdiri dari : nim, kode, sks, harga, grup, nilai, semester, dan thn ajaran.)";
			            	break;
			            }

			         $row = $row + 1;
		        }
		        $simpan = 0;
		        if ($validasi == true) {
		        	// echo $_POST['thn_ajaran'].' '.$_POST['semester'] ; die;
		        	//yang kurang
		        	if ($_POST['method'] == '1') {
		        		//delete all value
		        		$this->m_olahan->delete_o3_raw_nilai($prodi,$_POST['thn_ajaran'],$_POST['semester']);
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
					        		// replace empty nilai with 'T'
					        		if (!isset($value['nilai']) || $value['nilai'] == '') {
					        			$value['nilai'] = 'T';
					        		}

					        		// add prodi field
					        		$value['prodi'] = $prodi;

				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_o3_nilai($value);
				        	}				  
				        }
		                $status = "success";
		                $msg = "Data nilai berhasil disimpan (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	} elseif ($_POST['method'] == '0') {
			        	//metode : delete all then insert / existing replace + insert
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
				        			// replace empty nilai with 'T'
					        		if (!isset($value['nilai']) || $value['nilai'] == '') {
					        			$value['nilai'] = 'T';
					        		}

					        		// add prodi field
					        		$value['prodi'] = $prodi;

				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_o3_nilai($value,true);
				        	}

				        }
		                $status = "success";
		                $msg = "Data berhasil disimpan (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	}
		        	else {
		                $status = "error";
		                $msg = "Metode Harus dipilih";
		        	}
			    }
	        }
	        @unlink($_FILES[$file_element_name]);
	    }
	    echo json_encode(array('status' => $status, 'msg' => $msg, 'rowCount' => $afterInsert, 'infox' => $data));
	}

	public function upload_o3_presensi() {
		header('Content-Type: application/json');
		$afterInsert = $_POST['o3'];
		$prodi = $_POST['prodi'];
	    $status = "";
	    $msg = "";
	    $data = array();
	    $file_element_name = 'userfile_o3_presensi';

	    if ($status != "error")
	    {
	        $config['upload_path'] = './temp_upload/';
	        $config['allowed_types'] = 'csv';
	        $config['encrypt_name'] = TRUE;
	 
	        $this->load->library('upload', $config);
	 
	        if (!$this->upload->do_upload($file_element_name))
	        {
	            $status = 'error';
	            $msg = $this->upload->display_errors('', '');
	            $data = $this->upload->display_errors('', '');
	        }
	        else
	        {
	            $upload_data = $this->upload->data();
	            $file =  $upload_data['full_path'];

		        $_file 	= file_get_contents($file);
				$result = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $_file));
				$result = $this->reformatArrayOfCsv_o3_presensi($result);
		        $data['csvData'] =  $result;
		        $validasi = true;
		        $row = 0;

		        foreach ($result as $key => $value) {
		            if ( !isset($value['nim']) OR !isset($value['kode']) OR
		            	!isset($value['grup']) OR !isset($value['absen']) OR
		            	!isset($value['semester']) OR !isset($value['th_ajaran']))
			            {
			            	$validasi = false;
			                $status = "error";
			                $msg = "Data presensi gagal disimpan. Format CSV Salah (Harus terdiri dari : nim, kode, grup, absen, semester, dan thn ajaran.)";
			            	break;
			            }

			         $row = $row + 1;
		        }
		        $simpan = 0;
		        if ($validasi == true) {
		        	// echo $_POST['thn_ajaran'].' '.$_POST['semester'] ; die;
		        	//yang kurang
		        	if ($_POST['method'] == '1') {
		        		//delete all value
		        		$this->m_olahan->delete_o3_raw_kehadiran($prodi,$_POST['thn_ajaran'],$_POST['semester']);
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{	
				        			// add prodi field
					        		$value['prodi'] = $prodi;

				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_o3_presensi($value);
				        	}				  
				        }
		                $status = "success";
		                $msg = "Data presensi berhasil disimpan (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	} elseif ($_POST['method'] == '0') {
			        	//metode : delete all then insert / existing replace + insert
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
				        			// add prodi field
					        		$value['prodi'] = $prodi;
					        		
				        			$simpan = $simpan + 1;
						            $this->m_olahan->save_input_o3_presensi($value,true);
				        	}

				        }
		                $status = "success";
		                $msg = "Data berhasil disimpan (".$simpan." dari ".$row." data)";
				        $afterInsert = $simpan;
		        	}
		        	else {
		                $status = "error";
		                $msg = "Metode Harus dipilih";
		        	}
			    }
	        }
	        @unlink($_FILES[$file_element_name]);
	    }

	    echo json_encode(array('status' => $status, 'msg' => $msg, 'rowCount' => $afterInsert, 'infox' => $data));
	}

	public function o3_olah() {
		header('Content-Type: application/json');
		$result = $this->m_olahan->save_o3($this->input->get('semester'),$this->input->get('thn_ajaran'));
		if ($result) {
		    $status = "success";
			$msg = "Data o3 berhasil disimpan";
		}else{
		    $status = "error";
			$msg = "Data o3 gagal disimpan";
		}
	    echo json_encode(array('status' => $status, 'msg' => $msg));
	}

	private function reformatArrayOfCsv_o1_presensi($result) {

		$new_result = array();

		foreach ($result[0] as $key => $value) {
	       	if (strtolower($value) == "kode") {
	       		$keyKode = $key;
	       	}
	       	if (strtolower($value) == "grup") {
	       		$keyGrup = $key;
	       	}
	       	if (strtolower($value) == "tot_hadir") {
	       		$keyTotHadir = $key;
	       	}
	       	if (strtolower($value) == "semester") {
	       		$keySemester = $key;
	       	}
	       	if (strtolower($value) == "th_ajaran") {
	       		$keyThAjaran = $key;
	       	}
	       	if (strtolower($value) == "prodi") {
	       		$keyProdi = $key;
	       	}
       	}

		foreach ($result as $key => $value) {
			if ($key > 0) { // key = 0 is the csv header
				if (!empty($value[$keyKode]) AND $value[$keyKode] != '') {
					$new_result[$key-1]['kode'] = $value[$keyKode];
					$new_result[$key-1]['grup'] = $value[$keyGrup];
					$new_result[$key-1]['tot_hadir'] = $value[$keyTotHadir];
					$new_result[$key-1]['semester'] = $value[$keySemester];
					$new_result[$key-1]['th_ajaran'] = $value[$keyThAjaran];
					$new_result[$key-1]['prodi'] = $value[$keyProdi];					
				}				
			}
		}

		return $new_result;
	}

	private function reformatArrayOfCsv_o3_presensi($result) {
		$new_result = array();

		foreach ($result[0] as $key => $value) {
	       	if (strtolower($value) == "nim") {
	       		$keyNim = $key;
	       	}
	       	if (strtolower($value) == "kode") {
	       		$keyKode = $key;
	       	}
	       	if (strtolower($value) == "grup") {
	       		$keyGrup = $key;
	       	}
	       	if (strtolower($value) == "absen") {
	       		$keyAbsen = $key;
	       	}
	       	if (strtolower($value) == "semester") {
	       		$keySemester = $key;
	       	}
	       	if (strtolower($value) == "th_ajaran") {
	       		$keyThAjaran = $key;
	       	}
       	}

		foreach ($result as $key => $value) {
			if ($key > 0) { // key = 0 is the csv header
				if ((!empty($value[$keyNim]) AND $value[$keyNim] != '') &&
					(!empty($value[$keyKode]) AND $value[$keyKode] != '') &&
					(!empty($value[$keyGrup]) AND $value[$keyGrup] != '') &&
					(!empty($value[$keyAbsen]) AND $value[$keyAbsen] != '') &&
					(!empty($value[$keySemester]) AND $value[$keySemester] != '') &&
					(!empty($value[$keyThAjaran]) AND $value[$keyThAjaran] != '')) {
					$new_result[$key-1]['nim'] = $value[$keyNim];
					$new_result[$key-1]['kode'] = $value[$keyKode];
					$new_result[$key-1]['grup'] = $value[$keyGrup];
					$new_result[$key-1]['absen'] = $value[$keyAbsen];
					$new_result[$key-1]['semester'] = $value[$keySemester];
					$new_result[$key-1]['th_ajaran'] = $value[$keyThAjaran];
				}
			}
		}

		return $new_result;
	}

	private function reformatArrayOfCsv_o3_nilai($result) {
		$new_result = array();

		foreach ($result[0] as $key => $value) {
	       	if (strtolower($value) == "nim") {
	       		$keyNim = $key;
	       	}
	       	if (strtolower($value) == "kode") {
	       		$keyKode = $key;
	       	}
	       	if (strtolower($value) == "sks") {
	       		$keySks = $key;
	       	}
	       	if (strtolower($value) == "harga") {
	       		$keyHarga = $key;
	       	}
	       	if (strtolower($value) == "grup") {
	       		$keyGrup = $key;
	       	}
	       	if (strtolower($value) == "nilai") {
	       		$keyNilai = $key;
	       	}
	       	if (strtolower($value) == "semester") {
	       		$keySemester = $key;
	       	}
	       	if (strtolower($value) == "th_ajaran") {
	       		$keyThAjaran = $key;
	       	}
       	}

		foreach ($result as $key => $value) {
			if ($key > 0) { // key = 0 is the csv header
				if ((!empty($value[$keyNim]) AND $value[$keyNim] != '') &&
					(!empty($value[$keyKode]) AND $value[$keyKode] != '') &&
					(!empty($value[$keySks]) AND $value[$keySks] != '') &&
					(!empty($value[$keyHarga]) AND $value[$keyHarga] != '') &&
					(!empty($value[$keyGrup]) AND $value[$keyGrup] != '') &&
					(!empty($value[$keyNilai]) AND $value[$keyNilai] != '') &&
					(!empty($value[$keySemester]) AND $value[$keySemester] != '') &&
					(!empty($value[$keyThAjaran]) AND $value[$keyThAjaran] != '')) {
						$new_result[$key-1]['nim'] = $value[$keyNim];
						$new_result[$key-1]['kode'] = $value[$keyKode];
						$new_result[$key-1]['sks'] = $value[$keySks];
						$new_result[$key-1]['harga'] = $value[$keyHarga];
						$new_result[$key-1]['grup'] = $value[$keyGrup];
						$new_result[$key-1]['nilai'] = $value[$keyNilai];
						$new_result[$key-1]['semester'] = $value[$keySemester];
						$new_result[$key-1]['th_ajaran'] = $value[$keyThAjaran];
				}
			}
		}

		return $new_result;
	}

	function get_o3_insertedProdi() {
		$th_ajaran = $this->m_o4->getLastPeriodeDeadline();
		$thn_ajaran 	= $th_ajaran['thn_ajaran'];
		$semester		= $th_ajaran['semester'];
		$insertedProdiList = $this->m_olahan->get_o3_insertedProdi($semester,$thn_ajaran);
	    echo json_encode($insertedProdiList);	    	
	}

	// ajax request
	function cari_dosen() {
		foreach ($_POST as $value => $val) 
		{
			$query = $this->m_dosen->getDosen($val['keyword']);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($query);	    	
	}

	function create_dosen() {
		foreach ($_POST as $value => $val) 
		{
			$status = $this->m_dosen->createDosen($val);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($status);	    	
	}

	function insert_pengajar() {
		foreach ($_POST as $value => $val) 
		{
			$status = $this->m_dosen->addPengajar($val);
		}
		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($status);	    	
	}

	function get_o1() {
		ini_set("memory_limit","512M");

		// if ($this->_is_ajax()) {
			$data = $this->m_olahan->getPresensiDosenList($_POST['thn_ajaran'],$_POST['semester']);
			header('Content-Type: application/json');
		    echo json_encode($data);	    				
		// }
	}

	function save_input_sistem_o1() {
		foreach ($_POST as $value => $val) 
		{
			$status = $this->m_olahan->save_input_sistem_o1($val);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($status);	    	
	}

	function hapus_sistem_o1() {
		foreach ($_POST as $value => $val) 
		{
			$status = $this->m_olahan->hapus_sistem_o1($val);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($status);	    	

	}

	function get_excel_o1($id_paket='') 
	{
		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 		= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']		= $this->m_general->getLastPeriode()->semester;
			$data['o1_rekap']				= $this->m_olahan->getPresensiDosenRekap();
		}
		else {
			$data['id_paket'] 			= $id_paket;
			$periode['thn_ajaran']		= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']		= $this->m_laporan->getPaketList($id_paket)->semester;
			$data['o1_rekap']				= $this->m_olahan->getPresensiDosenRekap($id_paket);
		}
		$data['periode']			= $periode;
		$this->load->view('konfigurasi/excel_rangkuman_o1',$data);
	}



	protected function _is_ajax()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
	}	

}