<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_admin');
	}

	public function index() {
		# check whether user has permission to access
		(isset($this->session->userdata['is_admin']) && !$this->session->userdata['is_admin'])? redirect('page_404') : '';

		if(!empty($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$result	= $this->m_admin->admin_login($username,$password);
			if ($result['result']) {
				$this->session->set_userdata('username', $result['account']->username);
				$this->session->set_userdata('role', $result['account']->role);
				$this->session->set_userdata('is_admin', false);
				
				# redirect to spesific admin page
				if (strtoupper($result['account']->role) == 'SUPER') {
					redirect('admin/super');
				}
				else if (strtoupper($result['account']->role) == 'UNIVERSAL') {
					redirect('admin/universal');
				}
				else{
					redirect('admin/kategori');
				}
			}
			else
			{
				$this->session->set_flashdata('admin_login_failed', 'Username dan password tidak sesuai.');
				redirect('admin');
			}
		}

		$data['form_action'] = 'admin';
		$this->load->view('v_login',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/modules_core/admin/controllers/admin.php */