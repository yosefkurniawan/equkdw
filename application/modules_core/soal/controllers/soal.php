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

	public function edit($kode)
	{
		$info_paket 		= $this->m_soal->getPaketSoal($kode);
		$list_pertanyaan	= $this->m_soal->getPertanyaanByKode($kode);
		$list_jadwal		= $this->m_soal->getjadwalByKode($kode);

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
		$kode 				= 'sample_id_'.rand();
		$list_aspek 		= $this->m_soal->getAspek();			
		$list_prodi 		= $this->m_soal->getProdi();			
		$last_periode		= $this->m_general->getLastPeriode();

		/* -- Render Layout -- */
		$data['left_bar']		= 'soal/left_bar';
		$data['kode']			= $kode;
		$data['last_periode']	= $last_periode;
		$data['list_aspek']		= $list_aspek;
		$data['list_prodi']		= $list_prodi;
		$data['title'] 			= 'Edit Paket Soal';
		$data['content'][] 		= 'soal/form_info';
		$data['content'][] 		= 'soal/form_pertanyaan';
		$data['content'][] 		= 'soal/form_jadwal';
		$this->load->view('index/render_layout',$data);
		
	}

	public function save_info(){
		$thn_ajaran 	= $_POST['thn_ajaran'];
		$semester 		= $_POST['semester'];
		$status			= $_POST['status'];
		$result 		= $this->m_soal->save_info($thn_ajaran, $semester, $status);
		print_r(json_encode($result));
	}

	public function save_pertanyaan(){
		foreach ($_POST as $value) {
			$id_paket		= $value['id_paket'];
			$isi_pertanyaan = $value['isi_pertanyaan'];
			$id_aspek		= $value['aspek'];
			$urutan			= $value['urutan'];
			$result 		= $this->m_soal->save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $urutan);
		}
	}

	public function save_jadwal(){
		foreach ($_POST as $value) {
			$id_paket		= $value['id_paket'];
			$id_unit 		= $value['id_unit'];
			$tgl_mulai		= $value['tgl_mulai'];
			$tgl_akhir		= $value['tgl_akhir'];
			$result 		= $this->m_soal->save_jadwal($id_paket, $id_unit, $tgl_mulai, $tgl_akhir);
		}
	}

}

/* End of file soal.php */
/* Location: ./application/modules_core/soal/controllers/soal.php */