<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		# checking whether logged in as dosen or not
		if (!isset($this->session->userdata['status']) || $this->session->userdata['status']!='Dosen' ) {
			redirect('main/page404');	
		} 

		$this->load->model('m_laporan');
		$this->load->model('mahasiswa/m_kuisioner');
	}

	public function index()
	{

	}

	public function hasil_evaluasi($nik){
		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);
		$pertanyaan		= $this->m_kuisioner->getPertanyaan();

		/* -- Render Layout -- */
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['active']		= 'hasil evaluasi';
		$data['btn_print']	= "<a href='".base_url()."laporan/dosen/pdf_hasil_evaluasi_dosen/".$dosen->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Print</a>";
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
}

/* End of file dosen.php */
/* Location: ./application/modules_core/laporan/controllers/dosen.php */