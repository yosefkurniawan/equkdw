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
		}
		else {
			$data['id_paket'] 			= $id_paket;
			$periode['thn_ajaran']		= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']		= $this->m_laporan->getPaketList($id_paket)->semester;
			$data['kelas_all_check']	= $this->m_olahan->getKelasAll($id_paket,false);		
			$data['kelas_all']			= $this->m_olahan->getKelasAll($id_paket);		
			$data['o5_data']			= $this->m_olahan->getEClassData($id_paket);		
			$data['o2_persenbaik']		= $this->m_olahan->getPersenBaikData($id_paket);
		}

		/* -- Render Layout -- */
		$data['paket_list']			= $this->m_laporan->getPaketList();
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
		$config['upload_path'] = './temp_upload/';
        $config['allowed_types'] = 'jpg|jpeg|xls|csv|png';
		// $config['max_size'] = 100000000;
 		// ini_set('memory_limit', '-1');
        $this->load->library('upload', $config);

		if  (!$this->upload->do_upload())
	    {
	        $data = $this->upload->display_errors('', '');
	    }
	    else
	    {
	    	$data['file_data'] = $this->upload->data();

	   		$image_path = $data['file_data']['full_path'];

		    if(file_exists($image_path))
		    {
		    	$data['status'] = "success";
		      	$datap['msg'] = "File successfully uploaded";
		 	}
			else
		 	{
			    $data['status'] = "error";
		    	$data['msg'] = "Something went wrong when saving the file, please try again.";
		 	}
		}
			// @unlink($_FILES[$file_element_name]);

		header('Content-Type: application/json');
		echo json_encode($data);		
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

}