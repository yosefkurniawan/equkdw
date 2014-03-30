<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_soal');
		$this->load->model('index/m_general');
	}

	public function index()
	{
		$list_paket			= $this->m_soal->getPaketSoal();

		/* -- Render Layout -- */
		$data['list_paket']	= $list_paket;
		$data['title'] 		= 'Periode dan Soal';
		$data['content'] 	= 'soal/periode_soal';
		$this->load->view('index/render_layout',$data);
	}

	public function edit($kode=NULL)
	{
			$info_paket 		= $this->m_soal->getPaketSoal($kode);
			$list_pertanyaan	= $this->m_soal->getPertanyaanByKode($kode);

			/* -- Render Layout -- */
			$data['info_paket']			= $info_paket;
			$data['list_pertanyaan']	= $list_pertanyaan;
			$data['title'] 		= 'Edit Paket Soal';
			$data['content'][] 	= 'soal/form_info';
			$data['content'][] 	= 'soal/form_pertanyaan';
			$this->load->view('index/render_layout',$data);
		
	}

	public function baru()
	{
		$list_aspek 		= $this->m_soal->getAspek();			
		$last_periode		= $this->m_general->getLastPeriode();
		$kode 				= 'sample_id_'.rand();

		/* -- Render Layout -- */
		$data['kode']			= $kode;
		$data['last_periode']	= $last_periode;
		$data['list_aspek']		= $list_aspek;
		$data['title'] 			= 'Edit Paket Soal';
		$data['content'][] 		= 'soal/form_info';
		$data['content'][] 		= 'soal/form_pertanyaan';
		$this->load->view('index/render_layout',$data);
		
	}

	public function save_pertanyaan(){
		$id_paket		= $_POST['id_paket'];
		$isi_pertanyaan = $_POST['isi_pertanyaan'];
		$id_aspek		= $_POST['id_aspek'];
		$urutan			= $_POST['urutan'];
		$result 		= $this->m_soal->save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan);
	}

}

/* End of file soal.php */
/* Location: ./application/modules_core/soal/controllers/soal.php */