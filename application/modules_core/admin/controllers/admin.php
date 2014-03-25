<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_admin');
	}

	public function index() {
		# check whether user has permission to access
		if ($this->m_admin->cek_admin_login()){
			redirect(base_url());
		}

		if(!empty($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$result	= $this->m_admin->admin_login($username,$password);
			if ($result['result']) {
				# Default session setting
				$this->session->set_userdata('is_super_admin', false);
				$this->session->set_userdata('is_admin', false);
				$this->session->set_userdata('is_kepala_unit', false);
				$this->session->set_userdata('status', false);

				# Set login session
				$this->session->set_userdata('username', $result['account']->username);
				$this->session->set_userdata('nama', $result['account']->username);
				if ($result['account']->role == 'admin') {
					$this->session->set_userdata('is_admin', true);
				}elseif($result['account']->role == 'super admin'){
					$this->session->set_userdata('is_super_admin', true);
				}
				
				unset($_POST);
				redirect(base_url());
			}
			else
			{
				$this->session->set_flashdata('admin_login_failed', 'Username dan password tidak sesuai.');
				redirect('admin');
			}
		}else{
			$data['form_action'] = 'admin';
			$this->load->view('login',$data);
		}
	}
}

/* End of file admin.php */
/* Location: ./application/modules_core/admin/controllers/admin.php */