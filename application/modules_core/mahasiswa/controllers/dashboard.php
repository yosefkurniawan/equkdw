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
		$thn_ajaran			= $this->m_mahasiswa->getTahun();
		$list_krs			= $this->m_mahasiswa->getKRS($this->session->userdata('username'));
		/* -- Render Layout -- */
		$data['message']	= $this->session->flashdata('message');
		$data['list_krs']	= $list_krs;
		$data['thn_ajaran']	= $thn_ajaran;
		$data['title'] 		= 'Dashboard Daftar Kuisioner';
		$data['content'] 	= 'mahasiswa/dashboard';
		$this->load->view('main/render_layout',$data);						
	}


	//menampilkan halaman KRS Testing
	public function testing()
	{		
		$thn_ajaran			= $this->m_mahasiswa->getTahun();
/* 		echo "<pre>"; print_r($this->m_mahasiswa->get_list_mhs_no_id()); die; */
/* 		echo "<pre>"; print_r($this->m_mahasiswa->get_mahasiswa('72120008')); die; */
/* 		echo "<pre>"; print_r($this->m_mahasiswa->get_peserta('72140050')); die; */
/*
		$params = array(
			'id_unit' => '2272'
			);
*/
/* 		echo "<pre>"; print_r($this->m_mahasiswa->update_mhs($params,'72140050')); die; */
		$list_krs			= $this->m_mahasiswa->getKRSTesting('12050432');
		/* -- Render Layout -- */
		$data['message']	= $this->session->flashdata('message');
		$data['list_krs']	= $list_krs;
		$data['thn_ajaran']	= $thn_ajaran;
		$data['title'] 		= 'Dashboard Daftar Kuisioner';
		$data['content'] 	= 'mahasiswa/dashboard';
		$this->load->view('main/render_layout',$data);				
	
	
/*
		$thn_ajaran			= $this->m_mahasiswa->getTahun();
		$list_krs			= $this->m_mahasiswa->getKRSTesting($this->session->userdata('username'));
		echo "<pre>";
		print_r($list_krs);die;
*/
	}

}