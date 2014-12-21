<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konfigurasi_o4 extends MX_Controller {

	public function __construct() {
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_biro1'])) {
			redirect('main/page404');	
		}
		
		$this->load->model('m_o4');
	}

	function index(){
		
		if ($_POST) {
			$result = $this->m_o4->save();

			$data['alert']	= $result['alert'];
			// print_r($data['alert']);die;
		}

		/* Data */
		$data['list_matkul']		= $this->m_o4->getListMtk();
		$data['deadline']			= $this->m_o4->getDeadline(true);

		/* Render Layout */
		$data['title'] 				= "Input Tanggal Penyerahan Berkas";
		$data['content'] 			= 'ip/konfigurasi/form_o4';
		$this->load->view('main/render_layout',$data);
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

		/* Render Layout */
		$data['title'] 				= "Konfigurasi Deadline O4";
		$data['content'] 			= 'ip/konfigurasi/form_deadline_o4';

		// echo "<pre>";
		// print_r($data);
		// die;
		$this->load->view('main/render_layout',$data);	
	}

}