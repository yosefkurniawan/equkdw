<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('admin');	
		} 

		$this->load->model('soal/m_soal');
		$this->load->model('m_laporan');
		$this->load->model('mahasiswa/m_kuisioner');
		$this->load->model('mahasiswa/m_mahasiswa');
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

	public function status_pengisian(){

		// echo "laporan yang menampilkan semua status pengisian"; die;

		$list_pengisian = $this->m_mahasiswa->getStatusPengisianMahasiswa();

		// $listDosenByProdi = array();
		// foreach ($listProdi as $key => $prodi) {
		// 	$listDosenByProdi[$key]['id_unit'] 	= $prodi['id_unit'];
		// 	$listDosenByProdi[$key]['unit'] 	= $prodi['unit'];

		// 	$listDosen = $this->m_laporan->getListDosenByIdUnit($prodi['id_unit']);
		// 	$listDosenByProdi[$key]['listDosen']= $listDosen;
		// }

		/* -- Render Layout -- */
		$data['list_pengisian']	= $list_pengisian;
		$data['message']	= $this->session->flashdata('message');
		$data['title'] 		= 'Laporan - List Status Pengisian Kuisioner';
		$data['content'] 	= 'laporan/list_pengisian';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'status pengisian';
		$this->load->view('main/render_layout',$data);
	}


	public function hasil_evaluasi_dosen($nik){
		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);
		$pertanyaan		= $this->m_kuisioner->getPertanyaan();

		/* -- Render Layout -- */
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$data['btn_print']	= "<a href='".base_url()."laporan/pdf_hasil_evaluasi_dosen/".$dosen->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Print</a>";
		$this->load->view('main/render_layout',$data);
	}

	function pdf_hasil_evaluasi_dosen($nik)
	{
	    $this->load->helper('pdf_helper');

		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);
		$pertanyaan		= $this->m_kuisioner->getPertanyaan();

		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;

	    $this->load->view('pdf_evaluasi_dosen', $data);
	}

	public function lihat()
	{
		// $krs = $this->m_mahasiswa->lihatjawaban('72120010');
		$krs = $this->m_mahasiswa->getKRS('72110007');
		echo '<pre>'; print_r($krs); die;
	}
}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */