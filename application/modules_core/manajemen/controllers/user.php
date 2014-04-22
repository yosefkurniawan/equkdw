<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_user');

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_super_admin']) || !$this->session->userdata['is_super_admin'] ) {
			redirect('main/page404');	
		} 
	}

	public function index() {
		// get list user
		$data['user']	= $this->m_user->get_all_user();

		/* -- Render Layout -- */
		$data['title'] 		= 'List User';
		$data['content'] 	= 'manajemen/list';
		$this->load->view('main/render_layout',$data);
		// delete message
		$this->delete_message();
	}

	// tambah user
	public function tambah() {
		/* -- Render Layout -- */
		$data['title'] 		= 'Tambah User';
		$data['content'] 	= 'manajemen/tambah';
		$this->load->view('main/render_layout',$data);
		// delete message
		$this->delete_message();
	}

	// tambah proses
	public function tambah_proses() {
		// form validation
		$this->form_validation->set_rules('user', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|max_length[255]|is_unique[eva_user.email]|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|max_length[20]|is_unique[eva_user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|md5');
		$this->form_validation->set_rules('repassword', 'Konfirmasi Password', 'required|trim|xss_clean|matches[password]');
		$this->form_validation->set_rules('role', 'Role', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('email'), $this->input->post('username'), $this->input->post('password'), $this->input->post('role'));
			if ($this->m_user->tambah_user($params)) {
				$data['message'] = "Data user baru berhasil ditambahkan";
			} else {
				$data['message'] = "Data user baru gagal ditambahkan";
			}
			$this->session->set_userdata($data);
		} else {
			$data = array(
				'message'		=> validation_errors(),
				'email'			=> $this->input->post('email'),
				'user'			=> $this->input->post('username'),
				'password'		=> $this->input->post('password'),
				'repassword'	=> $this->input->post('repassword')
			);
			$this->session->set_userdata($data);
			redirect('manajemen/user/tambah');
		}
		redirect('manajemen/user');
		// delete message
		$this->delete_message();
	}

	// ubah user
	public function ubah($id) {
		// get user detail
		$data['user']		= $this->m_user->get_user_detail($id);
		/* -- Render Layout -- */
		$data['title'] 		= 'Ubah User';
		$data['content'] 	= 'manajemen/ubah';
		$this->load->view('main/render_layout',$data);
		// delete message
		$this->delete_message();
	}

	// ubah proses
	public function ubah_proses() {
		// form validation
		$this->form_validation->set_rules('user', '', 'required|trim|xss_clean');
		$this->form_validation->set_rules('role', 'Role', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			// insert
			$params = array($this->input->post('role'), $this->input->post('id'));
			if ($this->m_user->ubah_user($params)) {
				$data['message'] = "Data user berhasil diubah";
			} else {
				$data['message'] = "Data user gagal diubah";
			}
			$this->session->set_userdata($data);
		} else {
			$data = array(
				'message'		=> validation_errors(),
				'role'			=> $this->input->post('username')
			);
			$this->session->set_userdata($data);
			redirect('manajemen/user/ubah/' . $this->input->post('id'));
		}
		redirect('manajemen/user');
		// delete message
	}

	// delete account
	public function hapus($id="") {
		// set parameter
		$params = array($id);
		if ($this->m_user->delete_user($params)) {
			$data['message'] = "Akun sudah dihapus";
		} else {
			$data['message'] = "Akun tidak dapat dihapus";
		}
		$this->session->set_userdata($data);
		redirect('manajemen/user');
	}

	// activated account
	public function activated($id="") {
		// set parameter
		$params = array($id);
		if ($this->m_user->activated($params)) {
			$data['message'] = "Akun sudah diaktifkan";
		} else {
			$data['message'] = "Akun tidak dapat diaktifkan";
		}
		$this->session->set_userdata($data);
		redirect('manajemen/user');
	}

	// deactivated account
	public function deactivated($id="") {
		// set parameter
		$params = array($id);
		if ($this->m_user->deactivated($params)) {
			$data['message'] = "Akun sudah dinonaktifkan";
		} else {
			$data['message'] = "Akun tidak dapat dinonaktifkan";
		}
		$this->session->set_userdata($data);
		redirect('manajemen/user');
	}

	// delete message
	public function delete_message() {
		$message = array('message' => "", 'user' => "", 'password' => "", 'repassword' => "");
		$this->session->unset_userdata($message);
	}
}
