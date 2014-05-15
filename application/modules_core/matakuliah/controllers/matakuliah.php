<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		#give default timezone
		date_default_timezone_set('Asia/Jakarta');

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('main/page404');	
		} 

		$this->load->model('matakuliah/m_matakuliah');
		// $this->load->model('m_laporan');
	}

	public function index($prodi = NULL)
	{
		if ($prodi == NULL)
		{
			// tampilkan semua matakuliah
			$list_matkul = $this->m_matakuliah->getMatakuliah();			
		}
		else
		{
			$list_matkul = $this->m_matakuliah->getMatakuliah($prodi);						
		}

		/* -- Render Layout -- */
		// $data['message']	= $this->session->flashdata('message');
		$data['list_matkul']	= $list_matkul;
		
		// $data['thn_ajaran']	= $thn_ajaran;
		$data['title'] 		= 'Konfigurasi Matakuliah';
		$data['content'] 	= 'matakuliah/daftar_matakuliah';
		$this->load->view('main/render_layout',$data);				
	}
}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */