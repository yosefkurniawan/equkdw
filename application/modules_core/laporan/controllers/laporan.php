<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('soal/m_soal');
	}

	public function index()
	{
		$listProdi = $this->m_soal->getProdi();

		/* -- Render Layout -- */
		$data['list_prodi']	= $listProdi;
		$data['title'] 		= 'Laporan - List Prodi';
		$data['content'] 	= 'laporan/list_prodi';
		$this->load->view('main/render_layout',$data);
	}

}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */