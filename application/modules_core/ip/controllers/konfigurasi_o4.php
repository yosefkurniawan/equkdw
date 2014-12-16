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
		$data['deadline']			= '2014-12-15';

		/* Render Layout */
		$data['title'] 				= "Input Tanggal Penyerahan Berkas";
		$data['content'] 			= 'ip/konfigurasi/form_o4';
		$this->load->view('main/render_layout',$data);
	}

}