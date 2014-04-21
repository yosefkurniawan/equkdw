<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('soal/m_soal');
		$this->load->model('m_laporan');
	}

	public function index()
	{
		redirect('laporan/hasil_evaluasi');
	}

	public function hasil_evaluasi(){
		$listProdi = $this->m_soal->getProdi();

		$listDosenByProdi = array();
		foreach ($listProdi as $key => $prodi) {
			$listDosenByProdi[$key]['id_unit'] 	= $prodi['id_unit'];
			$listDosenByProdi[$key]['unit'] 	= $prodi['unit'];

			$listDosen = $this->m_laporan->getListDosenByIdUnit($prodi['id_unit']);
			$listDosenByProdi[$key]['listDosen']= $listDosen;
		}

		/* -- Render Layout -- */
		$data['listDosenByProdi']	= $listDosenByProdi;
		$data['title'] 		= 'Laporan - List Prodi';
		$data['content'] 	= 'laporan/list_prodi';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}

	public function hasil_evaluasi_dosen($nik){
		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik);

		/* -- Render Layout -- */
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}
}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */