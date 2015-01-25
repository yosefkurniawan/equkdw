<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Author: Pinaple
 * Description:
 * - ...
 * - funtion grid(), now get list prodi from m_o4
 */

class Konfigurasi_o4 extends MX_Controller {

	public function __construct() {
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_biro1'])) {
			redirect('main/page404');	
		}
		
		$this->load->model('ip_model');
		$this->load->model('m_o4');
		$this->load->model('soal/m_soal');
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
			$result 	= $this->m_o4->saveGrid();
			$this->session->set_flashdata( 'alert', $result['alert'] );

			redirect($_SERVER['HTTP_REFERER']);
		}

		// get list mtk
		if ($selected_prodi) {
			$data['list_matkul']		= $this->m_o4->getListMtk($selected_prodi,$selected_semester,$selected_thn_ajaran);
			$data['selected_prodi']		= $selected_prodi;
		}else{
			$data['list_matkul']		= array();
			$data['selected_prodi']		= '';
		}
		
		// get list prodi
		$data['list_prodi']			= $this->m_o4->getListProdi();

		$data['deadline']			= $this->m_o4->getDeadline($selected_semester, $selected_thn_ajaran, true);
		$data['page_url']			= base_url().'ip/konfigurasi_o4/grid/';


		/* Render Layout */
		$data['title'] 				= "Input Nilai Masuk";
		$data['content'] 			= 'ip/konfigurasi/form_o4_grid';
		$this->load->view('main/render_layout',$data);
	}

	function save() {
		
		if ($_POST) {
			$result = $this->m_o4->save_ajax();

			if ($result) {
				$data['status'] = TRUE;
				$data['msg'] = 'Data berhasil disimpan';
			}else{
				$data['status'] = FALSE;
				$data['msg'] = 'Data gagal disimpan';
			}
			
			echo json_encode($data);
		}else{
			$this->index();
		}
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

		$lastPeroide 				= $this->m_soal->getLatestPeriodePaket();
		$data['semester']			= $lastPeroide->semester;
		$data['thn_ajaran']			= $lastPeroide->thn_ajaran;

		/* Render Layout */
		$data['title'] 				= "Deadline Pengumpulan Nilai";
		$data['content'] 			= 'ip/konfigurasi/form_deadline_o4';

		$this->load->view('main/render_layout',$data);	
	}

}