<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_tambahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_kepala_unit'])) {
			redirect('main/page404');	
		} 

		# load models
		$this->load->model('m_soal_tambahan');
		$this->load->model('m_soal');
		$this->load->model('main/m_general');
	}

	public function index()
	{
		$nik = $this->session->userdata['username'];
		$list_paket = $this->m_soal_tambahan->getPaketTambahanByNik($nik);

		/* -- Render Layout -- */
		$data['list_paket']		= $list_paket;
		$data['custom_css'][] 	= 'public/assets/css/soal_tambahan.css';
		$data['title'] 			= 'Kuisioner Tambahan';
		$data['content'] 		= 'soal/paket_tambahan';
		$this->load->view('main/render_layout',$data);
	}

	public function baru()
	{
		$listUnit = $this->m_soal->getProdi();
		$listMatkul = $this->m_soal_tambahan->getAllMatkul();

		/* -- Render Layout -- */
		$data['form_type']		= 'new';
		$data['listUnit']		= $listUnit;
		$data['listMatkul']		= $listMatkul;
		$data['title'] 			= 'Kuisioner Tambahan';
		$data['content'] 		= 'soal/form_pertanyaan_tambahan';
		$data['custom_css'][] 	= 'public/assets/css/soal_tambahan.css';
		$data['custom_css'][] 	= 'public/assets/css/select2.css';
		$data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		$data['custom_js'][] 	= 'public/assets/js/select2.js';
		$this->load->view('main/render_layout',$data);
	}

	public function edit($id_paket)
	{
		$listUnit 	= $this->m_soal->getProdi();
		$listMatkul = $this->m_soal_tambahan->getAllMatkul();

		/* -- Render Layout -- */
		$data['form_type']		= 'edit';
		$data['id_paket']		= $id_paket;
		$data['listUnit']		= $listUnit;
		$data['listMatkul']		= $listMatkul;
		$data['title'] 			= 'Kuisioner Tambahan';
		$data['content'] 		= 'soal/form_pertanyaan_tambahan';
		$data['custom_css'][] 	= 'public/assets/css/soal_tambahan.css';
		$data['custom_css'][] 	= 'public/assets/css/select2.css';
		$data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		$data['custom_js'][] 	= 'public/assets/js/select2.js';
		$this->load->view('main/render_layout',$data);
	}

	public function view($id_paket)
	{
		$listUnit = $this->m_soal->getProdi();
		$listMatkul = $this->m_soal_tambahan->getAllMatkul();
		/* -- Render Layout -- */
		$data['form_type']		= 'view';
		$data['listUnit']		= $listUnit;
		$data['listMatkul']		= $listMatkul;
		$data['title'] 			= 'Kuisioner Tambahan';
		$data['content'] 		= 'soal/form_pertanyaan_tambahan';
		$data['custom_css'][] 	= 'public/assets/css/soal_tambahan.css';
		$data['custom_css'][] 	= 'public/assets/css/select2.css';
		$data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		$data['custom_js'][] 	= 'public/assets/js/select2.js';
		$this->load->view('main/render_layout',$data);
	}

	public function save_info(){
		if ($_POST) {
			$data = $this->m_soal_tambahan->save_info();
			print_r(json_encode($data));
		}
	}

	public function save_pertanyaanTambahan(){
		if ($_POST) {
			$data = $this->m_soal_tambahan->save_pertanyaanTambahan();
			print_r(json_encode($data));
		}
	}

	public function survey_maker()
	{
		/* -- Render Layout -- */
		$data['title'] 			= 'Kuisioner Tambahan';
		$data['content'] 		= 'soal/form_pertanyaan_tambahan2';
		$data['custom_css'][] 	= 'public/assets/css/survey_maker/bootstrap.min.css';
		$data['custom_css'][] 	= 'public/assets/css/survey_maker/bootstrap-responsive.min.css';
		$data['custom_css'][] 	= 'public/assets/css/survey_maker/custom.css';
		$data['custom_css'][] 	= 'public/assets/css/survey_maker.css';
		$this->load->view('main/render_layout',$data);
	}

	public function getDataPaket($id_paket){
		$data['info'] 			= $this->m_soal_tambahan->getInfoPaket($id_paket);
		$data['listPertanyaan'] = $this->m_soal_tambahan->getListPertanyaan($id_paket);
		print_r(json_encode($data));
	}

	public function delete($id_paket){
		$result = $this->m_soal_tambahan->hapusPaket($id_paket);
		if ($result) {
			$fl_data = array('message'=>'Paket berhasil dihapus','message_class'=>'alert-success');
			$this->session->set_flashdata($fl_data);
		}else{
			$fl_data = array('message'=>'Paket gagal dihapus','message_class'=>'alert-danger');
			$this->session->set_flashdata($fl_data);
		}
		$this->index();
	}
}

/* End of file soal_tambaha.php */
/* Location: ./application/modules_core/soal/controllers/soal_tambahan.php */