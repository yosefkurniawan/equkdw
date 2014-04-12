<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'Mahasiswa') {
			redirect('main');
		}
			$this->load->model('m_mahasiswa');

	}

	//menampilkan halaman KRS
	public function index()
	{		
		$list_krs			= $this->m_mahasiswa->getKRS($this->session->userdata('username'));
		/* -- Render Layout -- */
		$data['message']	= $this->session->flashdata('message');
		$data['list_krs']	= $list_krs;
		$data['title'] 		= 'Dashboard Daftar Kuisioner';
		$data['content'] 	= 'mahasiswa/dashboard';
		$this->load->view('main/render_layout',$data);				
	}

}