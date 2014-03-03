<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_mahasiswa');
	}

	public function index(){
		$krs = $this->m_mahasiswa->getKRS($this->session->userdata['username']);
		echo "This is Mahasiswa's home page";
		echo "<pre>";
		print_r($krs);
		echo "</pre>";
	}
}

/* End of file mahasiswa.php */
/* Location: ./application/modules_core/mahasiswa/controllers/mahasiswa.php */