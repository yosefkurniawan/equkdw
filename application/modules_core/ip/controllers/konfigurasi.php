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
		$this->load->model('m_dosen');
		$this->load->model('m_olahan');

	}

	function index(){
		redirect('ip/konfigurasi/data');
	}

	public function data($id_paket='') 
	{
		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 		= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']		= $this->m_general->getLastPeriode()->semester;
			$data['kelas_all_check']	= $this->m_olahan->getKelasAll('',false);		
			$data['kelas_all']			= $this->m_olahan->getKelasAll();		
			$data['o5_data']			= $this->m_olahan->getEClassData();		
			$data['o2_persenbaik']		= $this->m_olahan->getPersenBaikData();
			$data['o1_raw']				= $this->m_olahan->getPresensiDosenRaw();
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
		}

		/* -- Render Layout -- */
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
			$periode['thn_ajaran'] 		= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']		= $this->m_general->getLastPeriode()->semester;
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

		        $this->load->library('csvreader');
		        $result =   $this->csvreader->parse_file($file);
		        $data['csvData'] =  $result;
		        $validasi = true;
		        $row = 0;
		        foreach ($result as $key => $value) {
		            if ( (!isset($value['kode'])) OR (!isset($value['grup'])) OR (!isset($value['prodi'])) OR
		            	(!isset($value['tot_hadir'])) OR (!isset($value['semester'])) OR 
		            	(!isset($value['th_ajaran']))) 
			            {
			            	$validasi = false;
			                $status = "error";
			                $msg = $row." Format CSV Salah (Harus terdiri dari : kode, grup, prodi, tot_hadir, semester, dan thn_ajaran";
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
		        		$this->m_olahan->delete_o1_raw($_POST['thn_ajaran'],$_POST['semester']);
				        foreach ($result as $key => $value) {
				        	if ($value['th_ajaran'] == $_POST['thn_ajaran'] AND $value['semester'] == $_POST['semester'])
				        	{
						            $sks = $this->m_olahan->get_sks_info($value['kode']);
						            if ($sks <= 3) {
					        			$value['rencana'] = $_POST['rencana'];
						            } else {
					        			$value['rencana'] = $_POST['rencana'] * 2;						            	
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
						            if ($sks <= 3) {
					        			$value['rencana'] = $_POST['rencana'];
						            } else {
					        			$value['rencana'] = $_POST['rencana'] * 2;						            	
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

	protected function _is_ajax()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
	}	

}