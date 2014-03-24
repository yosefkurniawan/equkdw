<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_general');
		$this->load->model('admin/m_admin','m_admin');
	}

	public function index(){
		# checking whether logged in or not
		if (!isset($this->session->userdata['username'] )) {
			redirect('index/login');	
		} 
		else{
			/*if ($this->session->userdata['status'] == 'Mahasiswa') {
				redirect('mahasiswa');
			}
			elseif ($this->session->userdata['status'] == 'Dosen') {
				redirect('dosen');
			}
			else{
				redirect('page_404');
			}*/
			$data['title'] = 'SIEVDO - Sistem Informasi Evaluasi Kinerja Dosen';
			$data['content'] = 'welcome';
			$this->load->view('render_layout',$data);
		}
	}

	public function login(){

		if(!empty($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];

			/* -- login to SSAT -- */
			$curl = curl_init();
			
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER 	=> 1,
				CURLOPT_URL 			=> 'http://www.ukdw.ac.id/services/user/check_login',
				CURLOPT_POST 			=> 1,
				CURLOPT_POSTFIELDS 		=> array(
					'api_key' 	=> 'EducationIsTheMovementFromDarknessToLight4ee0688948828187623123',
					'id' 		=> $username,
					'password' 	=> $password
				)
			));

			$result = json_decode(curl_exec($curl), TRUE);
			curl_close($curl);
			/* -- //login to SSAT -- */

			if ($result['result']) {
				# Checking wheter admin or not
				$this->check_admin($result['id_user']);

				# Get user's name
				if (strtolower($result['status']) == strtolower('Dosen')) {
					$nama = $this->m_general->getDetailUserByStatus($result['id_user'],$result['status'])->nama;
				}
				else{
					$nama = $this->m_general->getDetailUserByStatus($result['id_user'],$result['status'])->nama_lengkap;
				}
				$this->session->set_userdata('nama', $nama);
				
				# save login session
				$this->session->set_userdata('username', $result['id_user']);
				$this->session->set_userdata('status', $result['status']);

				redirect(base_url());
			}
		}

		$data['form_action'] = 'index/login';
		$this->load->view('login',$data);
	}

	public function check_admin($username){
		$result	= $this->m_admin->check_admin($username);
		
		if ($result['is_super_admin']) 
			$this->session->set_userdata('is_super_admin', true);
		else
			$this->session->set_userdata('is_super_admin', false);


		if ($result['is_admin']) 
			$this->session->set_userdata('is_admin', true);
		else
			$this->session->set_userdata('is_admin', false);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file user.php */
/* Location: ./application/modules_core/user/controllers/user.php */