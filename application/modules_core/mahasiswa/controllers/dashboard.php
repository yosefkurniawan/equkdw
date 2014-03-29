<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa');
	}

	//menampilkan halaman KRS
	public function index()
	{
		// $list_krs			= $this->m_->getKRS();

		/* -- Render Layout -- */
		// $data['list_paket']	= $list_paket;
		$data['title'] 		= 'Dashboard Daftar Kuisioner';
		$data['content'] 	= 'mahasiswa/dashboard';
		$this->load->view('index/render_layout',$data);				
	}

}