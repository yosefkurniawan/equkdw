<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Periode dan Soal';
		$data['content'] = 'soal/periode_soal';
		$this->load->view('index/render_layout',$data);
	}

}

/* End of file soal.php */
/* Location: ./application/modules_core/soal/controllers/soal.php */