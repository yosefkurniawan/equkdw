<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfigurasi_o4 extends MX_Controller {

	public function __construct() {
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_biro1'])) {
			redirect('main/page404');	
		}
		
		$this->load->model('ip_model');
		$this->load->model('m_o4');
	}

	function index() {
		$this->grid();
	}

	// simple form
	function simple(){
		
		if ($_POST) {
			$result = $this->m_o4->save();

			$data['alert']	= $result['alert'];
		}

		/* Data */
		$data['list_matkul']		= $this->m_o4->getListMtk();
		$data['deadline']			= $this->m_o4->getDeadline(true);

		/* Render Layout */
		$data['title'] 				= "Input Nilai Masuk";
		$data['content'] 			= 'ip/konfigurasi/form_o4';
		$this->load->view('main/render_layout',$data);
	}

	// grid view form
	function grid() {
		
		$lastPeroide 				= $this->ip_model->getLastPeriode();

		// get the filter params
		$selected_semester	 	= ($this->input->get('semester'))? $this->input->get('semester') : $lastPeroide['semester'];
		$selected_thn_ajaran 	= ($this->input->get('thn_ajaran'))? str_replace('-', '/', $this->input->get('thn_ajaran')) : $lastPeroide['thn_ajaran'];
		$selected_prodi 		= ($this->input->get('prodi'))? $this->input->get('prodi') : '';

		$data['last_semester']		= $lastPeroide['semester'];
		$data['last_thn_ajaran']	= $lastPeroide['thn_ajaran'];

		$data['semester']			= $selected_semester;
		$data['thn_ajaran']			= $selected_thn_ajaran;

		// save data if POST
		if ($_POST) {
			$result = $this->m_o4->saveGrid();
			$this->session->set_flashdata( 'alert', $result['alert'] );

			redirect($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$selected_prodi);
		}

		// get list mtk
		if ($selected_prodi) {

			// kode mtk mapping
			if ($selected_prodi == 'others') {
				$id_unit = '0000';
			}else{
				$id_unit 	= $this->ip_model->convertToOldProdi($selected_prodi);
			}

			if ($id_unit) {
				$data['list_matkul']		= $this->m_o4->getListMtk($id_unit,$selected_semester,$selected_thn_ajaran);
				$data['selected_prodi']		= $selected_prodi;
			}else{
				redirect($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
			}
		}else{
			$data['list_matkul']		= array();
			$data['selected_prodi']		= '';
		}
		
		// get list prodi
		$data['list_prodi']			= $this->ip_model->getProdiList();
		foreach ($data['list_prodi'] as $key => $prodi) {
			// remove units from list_prodi
			if ($prodi['prodi'] == '99') {
				unset($data['list_prodi'][$key]);
			}
			if ($prodi['prodi'] == 'PA') {
				unset($data['list_prodi'][$key]);
			}
		}

		$data['deadline']			= $this->m_o4->getDeadline(true);
		$data['page_url']			= base_url().'ip/konfigurasi_o4/grid/';


		/* Render Layout */
		$data['title'] 				= "Input Nilai Masuk";
		$data['content'] 			= 'ip/konfigurasi/form_o4_grid';
		$this->load->view('main/render_layout',$data);
	}

	function gridSave() {
		

		$this->index();
	}

	function deadline() {

		if ($_POST) {
			$result = $this->m_o4->setDeadline();

			if ($result) {
				$data['alert']['status']= "success";
				$data['alert']['msg']	= "Deadline berhasil diupdate.";
			}else{
				$data['alert']['status']= "danger";
				$data['alert']['msg']	= "Deadline gagal diupdate.";
			}
			unset($_POST);
			// print_r($data['alert']);die;
		}

		/* Data */
		$data['deadline']			= $this->m_o4->getDeadline();

		$lastPeroide 				= $this->ip_model->getLastPeriode();
		$data['semester']			= $lastPeroide['semester'];
		$data['thn_ajaran']			= $lastPeroide['thn_ajaran'];

		/* Render Layout */
		$data['title'] 				= "Deadline Pengumpulan Nilai";
		$data['content'] 			= 'ip/konfigurasi/form_deadline_o4';

		$this->load->view('main/render_layout',$data);	
	}

}