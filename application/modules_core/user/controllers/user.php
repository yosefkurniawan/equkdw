<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	
	public function index(){
		# checking whether logged in or not
		if (!isset($this->session->userdata['username'] )) {
			redirect('user/login');	
		} 
		else{
			if ($this->session->userdata['status'] == 'Mahasiswa') {
				redirect('mahasiswa');
			}
			elseif ($this->session->userdata['status'] == 'Dosen') {
				redirect('dosen');
			}
			else{
				redirect('page_404');
			}
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
				$this->session->set_userdata('username', $result['id_user']);
				$this->session->set_userdata('status', $result['status']);
				$this->session->set_userdata('is_admin', false);
				if ($result['status'] = 'Mahasiswa') {
					redirect('user/index');
				}
			}
		}

		$data['form_action'] = 'user/login';
		$this->load->view('v_login',$data);
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('user/login');
	}
}

/* End of file user.php */
/* Location: ./application/modules_core/user/controllers/user.php */