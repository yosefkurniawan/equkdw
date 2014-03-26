<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_general');
		$this->load->model('m_login');
		$this->load->model('admin/m_admin');
	}

	public function index(){
		# checking whether logged in or not
		if (!isset($this->session->userdata['username'] )) {
			redirect('index/login');	
		} 
		else{
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

			$result_login_SSAT 	= json_decode(curl_exec($curl), TRUE);
			curl_close($curl);
			/* -- //login to SSAT -- */

			if ($result_login_SSAT['result']) {
				$SSAT_id_user 		= $result_login_SSAT['id_user'];
				$SSAT_status 		= $result_login_SSAT['status'];
				# Checking wheter admin or not
				// $cek_admin 			= $this->check_admin($SSAT_id_user);
				// $is_super_admin 	= $cek_admin['is_super_admin'];
				// $is_admin 			= $cek_admin['is_admin'];

				# Checking wheter biro1 or not
				$is_kepala_unit 			= $this->check_kepala_unit($SSAT_id_user);

				# Get user's name
				if (strtolower($SSAT_status) == strtolower('Dosen')) {
					$nama = $this->m_general->getDetailUserByStatus($SSAT_id_user, $SSAT_status)->nama;
				}
				else{
					$nama = $this->m_general->getDetailUserByStatus($SSAT_id_user, $SSAT_status)->nama_lengkap;
				}
				
				# save login session
				// if ($SSAT_status == 'Mahasiswa' || $SSAT_status == 'Dosen' || $SSAT_status == 'Mahasiswa' || $is_admin || $is_super_admin) {
					$this->session->set_userdata('username', $SSAT_id_user);
					$this->session->set_userdata('status', $SSAT_status);
					$this->session->set_userdata('nama', $nama);

					// if ($is_super_admin) 
					// 	$this->session->set_userdata('is_super_admin', true);
					// else
					// 	$this->session->set_userdata('is_super_admin', false);

					// if ($is_admin) 
					// 	$this->session->set_userdata('is_admin', true);
					// else
					// 	$this->session->set_userdata('is_admin', false);

					if ($is_kepala_unit) 
						$this->session->set_userdata('is_kepala_unit', true);
					else
						$this->session->set_userdata('is_kepala_unit', false);
				// }

					$this->session->set_userdata('is_super_admin', false);
					$this->session->set_userdata('is_admin', false);

				redirect(base_url());
			}
			else{
				$this->session->set_flashdata('login_failed', 'Username dan password tidak sesuai.');
				redirect('index/login');	
			}
		}

		$data['form_action'] = 'index/login';
		$this->load->view('login',$data);
	}

	public function check_admin($username){
		$result	= $this->m_login->check_admin($username);
		return $result;
	}

	public function check_kepala_unit($username){
		$result	= $this->m_login->check_kepala_unit($username);
		return $result;
	}

	public function logout(){
		if ($this->m_admin->cek_admin_login()) {
			$this->session->sess_destroy();
			redirect('admin');
		}else{
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
}

/* End of file user.php */
/* Location: ./application/modules_core/user/controllers/user.php */
