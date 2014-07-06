<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('admin');	
		} 

		$this->load->model('main/m_general');
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

		$listDosenPerUnit = $this->m_laporan->getListDosenAktifPerUnit();
		$pertanyaan	= $this->m_kuisioner->getPertanyaan();

		// set periode
		if (!isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
		}
		else {
			$periode['thn_ajaran']	= $this->session->userdata['periode_laporan_evaluasi']['thn_ajaran'];
			$periode['semester']	= $this->session->userdata['periode_laporan_evaluasi']['semester'];
		}

		/* -- Render Layout -- */
		$data['pertanyaan']			= $pertanyaan;
		$data['listDosenPerUnit']	= $listDosenPerUnit;
		$data['title'] 		= 'Laporan - List Prodi';
		$data['content'] 	= 'laporan/list_prodi';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$data['periode']	= $periode;
		$data['last_periode']	= $this->m_general->getLastPeriode();
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

		// set periode
		if (!isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
		}
		else {
			$periode['thn_ajaran']	= $this->session->userdata['periode_laporan_evaluasi']['thn_ajaran'];
			$periode['semester']	= $this->session->userdata['periode_laporan_evaluasi']['semester'];
		}

		/* -- Render Layout -- */
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;
		$data['periode']	= $periode;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$data['btn_print']	= "<a href='".base_url()."laporan/pdf_hasil_evaluasi_dosen/".$dosen->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>";
		$this->load->view('main/render_layout',$data);
	}

	function pdf_hasil_evaluasi_dosen_per_prodi($id_unit)
	{
	    $this->load->helper('pdf_helper');

	    $data_evaluasi = array();
	    $list_dosen_by_prodi = $this->m_laporan->getListDosenByIdUnit($id_unit);

	    if (!empty($list_dosen_by_prodi)) {
	    	foreach ($list_dosen_by_prodi as $key => $dsn) {
				$data_evaluasi[$dsn['nik']]['dosen'] 			= $dsn;
				$data_evaluasi[$dsn['nik']]['hasil_evaluasi'] 	= $this->m_laporan->getHasilEvaluasi($dsn['nik']);
	    	}
	    }
		
		// set periode
		if (!isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
		}
		else {
			$periode['thn_ajaran']	= $this->session->userdata['periode_laporan_evaluasi']['thn_ajaran'];
			$periode['semester']	= $this->session->userdata['periode_laporan_evaluasi']['semester'];
		}

		$pertanyaan		= $this->m_kuisioner->getPertanyaan();

		$data['periode']			= $periode;
		$data['data_evaluasi']		= $data_evaluasi;
		$data['pertanyaan']			= $pertanyaan;
		$data['id_unit']			= $id_unit;

	    $this->load->view('pdf_evaluasi_dosen_per_prodi', $data);
	}

	function pdf_hasil_evaluasi_dosen($nik)
	{
	    $this->load->helper('pdf_helper');

		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);
		$pertanyaan		= $this->m_kuisioner->getPertanyaan();

		// set periode
		if (!isset($this->session->userdata['periode_laporan_evaluasi'])) {
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
		}
		else {
			$periode['thn_ajaran']	= $this->session->userdata['periode_laporan_evaluasi']['thn_ajaran'];
			$periode['semester']	= $this->session->userdata['periode_laporan_evaluasi']['semester'];
		}

		$data['periode']			= $periode;
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;

	    $this->load->view('pdf_evaluasi_dosen', $data);
	}

	public function setPeriode()
	{
		$new_periode['thn_ajaran'] 	= $_POST['thn_ajaran'];
		$new_periode['semester'] 	= $_POST['semester'];
		$this->session->set_userdata('periode_laporan_evaluasi', $new_periode);

		$this->session->set_flashdata('message', 'Peride berhasil diubah.');
		$this->session->set_flashdata('message_class', 'alert-success block-important');

		redirect('laporan/hasil_evaluasi');
	}
}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */