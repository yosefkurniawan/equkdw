<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'Mahasiswa') {
			redirect('index/index');
		}
			$this->load->model('m_kuisioner');
			$this->load->model('m_mahasiswa');

	}

	//menampilkan halaman KRS
	public function index($id_kelasb)
	{	
		// check wheter user registered in this class or not

		// fetch data
		$row_matakuliah		= $this->m_mahasiswa->getKelas($id_kelasb);
		$list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
		$list_soal			= $this->m_kuisioner->getPertanyaan();

		/* -- Render Layout -- */
		$data['row_matakuliah']	= $row_matakuliah;
		$data['list_dosen']	= $list_dosen;
		$data['list_soal']	= $list_soal;
		$data['title'] 		= 'Kuisioner Dosen';
		$data['content'] 	= 'mahasiswa/kuisioner';
		$this->load->view('index/render_layout',$data);				
	}

	public function submit_kuisioner()
	{
		echo "validation berhasil"; die;
		$input = $this->input->post('input');
		foreach ($input as $key) 
		{
			$this->m_kuisioner->save_evaluasi($key);
		}
	}
}