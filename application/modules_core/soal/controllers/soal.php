<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('main/page404');	
		} 

		# load models
		$this->load->model('m_soal');
		$this->load->model('main/m_general');
	}

	public function index()
	{
		# catch current page value of pagination
		$page 	= $this->uri->segment(3);
		(empty($page))? $page = 0 : $page = $page;
		$limit	= 20;

		$update_status_last_paket = $this->m_soal->updateStatusLastPaket();
		$list_paket			= $this->m_soal->getPaketSoal($page,$limit);
		$allow_create_new 	= $this->m_soal->allowCreateNewPaket();

		# set pagination
		$config['full_tag_open'] = '<ul class="pagination pull-right hidden-xs">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '<i class="icon-">&#xf105;</i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="icon-">&#xf104;</i>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><span class="cur_page">';
		$config['cur_tag_close'] = '</span></li>';
  		$config['num_tag_open'] = '<li>';
  		$config['num_tag_close'] = '</li>';
		$config['base_url'] 	= $this->config->base_url().'soal/index/';
		$config['total_rows'] 	= $this->m_soal->getRowsPaketSoal();
		$config['per_page'] 	= $limit; 
		$this->pagination->initialize($config); 

		/* -- Render Layout -- */
		$data['list_paket']	= $list_paket;
		$data['allowCreateNew']	= $allow_create_new;
		$data['title'] 		= 'Periode dan Soal';
		$data['content'] 	= 'soal/periode_soal';
		$this->load->view('main/render_layout',$data);
	}

	public function edit($kode)
	{
		$info_paket 		= $this->m_soal->getPaketSoalByKode($kode);
		$list_pertanyaan	= $this->m_soal->getPertanyaanByKode($kode);
		$list_jadwal		= $this->m_soal->getjadwalByKode($kode);

		$list_aspek 		= $this->m_soal->getAspek();			
		$list_prodi 		= $this->m_soal->getProdi();			
		$last_periode		= $this->m_general->getLastPeriode();

		/* -- Render Layout -- */
		$data['form_type']			= 'edit';
		$data['left_bar']			= 'soal/left_bar_edit';
		$data['info_paket']			= $info_paket;
		$data['list_pertanyaan']	= $list_pertanyaan;
		$data['list_jadwal']		= $list_jadwal;
		$data['kode']			= $kode;
		$data['last_periode']	= $last_periode;
		$data['list_aspek']		= $list_aspek;
		$data['list_prodi']		= $list_prodi;
		$data['title'] 		= 'Edit Paket Soal';
		$data['content'][] 	= 'soal/form_info';
		$data['content'][] 	= 'soal/form_pertanyaan';
		$data['content'][] 	= 'soal/form_jadwal';
		$this->load->view('main/render_layout',$data);
		
	}

	public function baru()
	{
		$list_aspek 		= $this->m_soal->getAspek();			
		$list_prodi 		= $this->m_soal->getProdi();			
		$last_periode		= $this->m_soal->getLatestPeriodePaket();

		/* -- Render Layout -- */
		$data['form_type']		= 'new';
		$data['left_bar']		= 'soal/left_bar_new';
		$data['kode']			= '';
		$data['last_periode']	= $last_periode;
		$data['list_aspek']		= $list_aspek;
		$data['list_prodi']		= $list_prodi;
		$data['title'] 			= 'Paket Soal Baru';
		$data['content'][] 		= 'soal/form_info';
		$data['content'][] 		= 'soal/form_pertanyaan';
		$data['content'][] 		= 'soal/form_jadwal';
		$this->load->view('main/render_layout',$data);
		
	}

	public function delete($id_paket){
		$this->m_soal->deletePaket($id_paket);
		redirect('soal');
	}

	public function save_info(){
		$thn_ajaran 	= $_POST['thn_ajaran'];
		$semester 		= $_POST['semester'];
		$status			= $_POST['status'];
		$result 		= $this->m_soal->save_info($thn_ajaran, $semester, $status);
		print_r(json_encode($result));
	}

	public function save_edit_info(){
		$id_paket	 	= $_POST['id_paket'];
		$thn_ajaran 	= $_POST['thn_ajaran'];
		$semester 		= $_POST['semester'];
		$status			= $_POST['status'];
		$result 		= $this->m_soal->save_edit_info($id_paket, $thn_ajaran, $semester, $status);
	}

	public function save_pertanyaan(){
		foreach ($_POST as $value) {
			$id_paket		= $value['id_paket'];
			$isi_pertanyaan = $value['isi_pertanyaan'];
			$id_aspek		= $value['aspek'];
			$keterangan		= $value['keterangan'];
			$urutan			= $value['urutan'];
			$result 		= $this->m_soal->save_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $keterangan, $urutan);
		}
	}

	public function save_edit_pertanyaan(){
		foreach ($_POST as $value) {
			$id_paket		= $value['id_paket'];
			$isi_pertanyaan = $value['isi_pertanyaan'];
			$id_aspek		= $value['aspek'];
			$keterangan		= $value['keterangan'];
			$urutan			= $value['urutan'];
			$result 		= $this->m_soal->save_edit_pertanyaan($id_paket, $isi_pertanyaan, $id_aspek, $keterangan, $urutan);
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

	public function save_edit_jadwal(){
		foreach ($_POST as $value) {
			$id_paket		= $value['id_paket'];
			$id_unit 		= $value['id_unit'];
			$tgl_mulai		= $value['tgl_mulai'];
			$tgl_akhir		= $value['tgl_akhir'];
			$result 		= $this->m_soal->save_edit_jadwal($id_paket, $id_unit, $tgl_mulai, $tgl_akhir);
		}
	}

	public function view($kode){
		$info_paket 		= $this->m_soal->getPaketSoalByKode($kode);
		$list_pertanyaan	= $this->m_soal->getPertanyaanByKode($kode);
		$list_jadwal		= $this->m_soal->getjadwalByKode($kode);
		$list_aspek 		= $this->m_soal->getAspek();			
		$list_prodi 		= $this->m_soal->getProdi();			
		$last_periode		= $this->m_general->getLastPeriode();

		/* -- Render Layout -- */
		$data['form_type']			= 'view';
		$data['left_bar']			= 'soal/left_bar_edit';
		$data['info_paket']			= $info_paket;
		$data['list_pertanyaan']	= $list_pertanyaan;
		$data['list_jadwal']		= $list_jadwal;
		$data['kode']			= $kode;
		$data['last_periode']	= $last_periode;
		$data['list_aspek']		= $list_aspek;
		$data['list_prodi']		= $list_prodi;
		$data['title'] 		= 'Edit Paket Soal';
		$data['content'][] 	= 'soal/form_info';
		$data['content'][] 	= 'soal/form_pertanyaan';
		$data['content'][] 	= 'soal/form_jadwal';
		$this->load->view('main/render_layout',$data);
	}

	public function getLatestQuestions(){
		$result = $this->m_soal->getLatestQuestions();
		print_r(json_encode($result));
	}
}

/* End of file soal.php */
/* Location: ./application/modules_core/soal/controllers/soal.php */