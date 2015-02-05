<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		# checking whether logged in as dosen or not
		if (!isset($this->session->userdata['status']) || $this->session->userdata['status']!='Dosen' ) {
			redirect('main/page404');	
		} 

		$this->load->model('main/m_general');
		$this->load->model('m_laporan');
		$this->load->model('ip/ip_model');
		$this->load->model('mahasiswa/m_kuisioner');
	}

	public function index()
	{

	}

	public function hasil_evaluasi($nik,$id_paket = ''){

		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);

		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= "";
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true,$id_paket);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		}

		/* -- Render Layout -- */
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['admin']				= 'tidak';
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;
		$data['periode']			= $periode;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['active']		= 'hasil evaluasi';
		$data['btn_print']	= "<a href='".base_url()."laporan/dosen/pdf_hasil_evaluasi_dosen/".$dosen->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>";
		$this->load->view('main/render_layout',$data);
	}

	public function ip_dosen($nik,$id_paket = ''){

		if ($nik != $this->session->userdata('username')) {
			redirect('laporan/dosen/ip_dosen/'.$this->session->userdata('username'));
		}

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
			$data['periode']['semester'] 	= $_periode['semester'];
			$data['periode']['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $_periode['deadline'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$periode['deadline']	= $this->m_laporan->getPaketList($id_paket)->deadline_o4;
			$data['periode']['semester'] 	= $periode['semester'];
			$data['periode']['thn_ajaran'] 	= $periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $periode['deadline'];			
		}
		/* -- Give PDF Default Name -- */
		
		/* -- Render Layout -- */
		$data['admin']				= 'tidak';
		$data['dsn'] 				= $this->ip_model->get_dosen_info($nik);
		$data['ajar'] 				= $this->ip_model->get_dosen_ajar($nik,$periode['thn_ajaran'],$periode['semester']);
		$title = "IP Dosen ".$periode['thn_ajaran']." ".$periode['semester']." - " . $data['dsn']->nama_dsn; 
		$data['title'] 				= $title;
		$data['content'] 			= 'laporan/hasil_ip_dosen';
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['btn_print']			= "<a href='".base_url()."laporan/dosen/detail_dosen_pdf/".$data['dsn']->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>";
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}

	function detail_dosen_pdf($nik = NULL,$id_paket = NULL){

		if ($nik != $this->session->userdata('username')) {
			redirect('laporan/dosen/ip_dosen/'.$this->session->userdata('username'));
		}
		
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
			$data['periode']['semester'] 	= $_periode['semester'];
			$data['periode']['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $_periode['deadline'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$periode['deadline']	= $this->m_laporan->getPaketList($id_paket)->deadline_o4;
			$data['periode']['semester'] 	= $periode['semester'];
			$data['periode']['thn_ajaran'] 	= $periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $periode['deadline'];			
		}

		$data['dsn'] = $this->ip_model->get_dosen_info($nik);

		$data['ajar'] = $this->ip_model->get_dosen_ajar($nik,$periode['thn_ajaran'],$periode['semester']);

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di universitas -- */
		$data['uni_o1'] = $this->ip_model->get_univ_o1($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o2'] = $this->ip_model->get_univ_o2($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o3'] = $this->ip_model->get_univ_o3($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o4'] = $this->ip_model->get_univ_o4($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o5'] = $this->ip_model->get_univ_o5($periode['thn_ajaran'],$periode['semester']);


		//get dosen asal prodi
		$id_unit = $data['dsn']->id_unit;
		// echo 'prodi : '.$prodi['prodi']; die;
		// $prodi = $data['dsn']->prodi;

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di prodi yang sama -- */
		$data['prodi_o1'] = $this->ip_model->get_prodi_o1($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o2'] = $this->ip_model->get_prodi_o2($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o3'] = $this->ip_model->get_prodi_o3($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o4'] = $this->ip_model->get_prodi_o4($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o5'] = $this->ip_model->get_prodi_o5($id_unit,$periode['thn_ajaran'],$periode['semester']);

		// echo "berhasil";
		// die;

		/* -- Give PDF Default Name -- */
		$pdf_title = "IP Dosen ".$periode['thn_ajaran']." ".$periode['semester']." - " . $data['dsn']->nama_dsn; 
		
		/* -- Render Layout -- */
		$data['title'] 		= $pdf_title;
		$data['content'] 	= 'ip/ip/pdf/ip_dosen';
		$data['custom_css'][] 	= 'public/assets/css/pdf-ip-dosen.css';
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}


	function pdf_hasil_evaluasi_dosen($nik,$id_paket='')
	{
	    $this->load->helper('pdf_helper');

		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);

		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= "";
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true,$id_paket);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		}
		$data['periode']			= $periode;
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;

	    $this->load->view('pdf_evaluasi_dosen', $data);
	}
}

/* End of file dosen.php */
/* Location: ./application/modules_core/laporan/controllers/dosen.php */