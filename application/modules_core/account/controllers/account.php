<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MX_Controller
{
	
	function __construct()
	{
		$this->load->model('m_account');
	}

	public function index() {
		$this->load->view('forgot_password');
	}

	// forgot password
	public function forgot_password() {
		$data['title'] = 'Lupa Password';
		$this->load->view('forgot_password', $data);
	}

	// forgot password process
	public function forgot_password_process() {
		// load form validation
		$this->load->library('form_validation');
		// form validation
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');

		if ($this->form_validation->run() == TRUE) {
			// check if email exist
			if ($this->m_account->email_validation($this->input->post('email'))) {
				// password generator
				$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$password = "";
				for ($i=0;$i<10;$i++) {
					$password .= $char[rand(0, strlen($char) - 1)];
				}
				$this->m_account->update_password(array(md5($password), $this->input->post('email')));
		        $config = Array(
		            'protocol'  => 'smtp',
		            'smtp_host' => 'ssl://smtp.googlemail.com',
		            'smtp_port' => '465',
		            'smtp_user' => 'si.ukdw@gmail.com',
		            'smtp_pass' => 'siukdw05',
		            'mailtype'  => 'html',
		            'starttls'  => true,
		            'newline'   => "\r\n"
		        );
		        $this->load->library('email', $config);
		        $this->email->from('si.ukdw@gmail.com');
		        $this->email->to($this->input->post('email'));
		        $this->email->subject('Password e-Quiz Duta Wacana');
		        $this->email->message('Password baru Anda adalah : ' . $password);
		        $this->email->send();

				$this->session->set_flashdata('message', 'Password baru sudah terkirim ke email Anda');
			} else {
				$this->session->set_flashdata('message', 'Email Anda tidak terdaftar');
			}
		} else {
			$this->session->set_flashdata('message', 'Harap masukkan email anda dengan benar');
		}
		redirect('account/forgot_password');
	}
}

/* End of file admin.php */
/* Location: ./application/modules_core/admin/controllers/admin.php */