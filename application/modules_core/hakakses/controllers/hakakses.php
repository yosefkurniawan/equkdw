<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_super_admin');
	}

	public function index() {
		# check whether user has permission to access
		if ($this->m_super_admin->cek_admin_login()){
			redirect(base_url());
		}
	}
}
