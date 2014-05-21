<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Klaim extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('admin');	
		} 

		$this->load->model('mahasiswa/m_mahasiswa');
		$this->load->model('m_hadiah');
	}

	public function beri($nim)
	{
		$authorize = TRUE;

		if ($nim == null) {
			$authorize = FALSE;
			$pesan = 'anda berada pada halaman yang salah!';
		}
		else {
			//tambah 
			$mahasiswa = $this->m_mahasiswa->getStatusPengisianMahasiswaIndividu($nim);

			if ( ($mahasiswa->kuisioner_terisi / $mahasiswa->matakuliah_berkuisioner) != 1 ) 
			{
				$authorize = FALSE;
				$pesan = 'mahasiswa ini belum bisa diberi hadiah!';
			}
		}

		if ($authorize == TRUE)
		{
			//bisa diberi hadiah

			/* -- Render Layout -- */
			$data['mahasiswa']	= $mahasiswa;
			$data['title'] 		= 'Form Klaim Hadiah';
			$data['content'] 	= 'hadiah/klaim';
			$data['left_bar']	= 'laporan/left_bar_admin';
			$data['active']		= 'status pengisian';
			$this->load->view('main/render_layout',$data);
		}
		else
		{
			$pesan = $pesan . " silahkan kembali ke <a href='" . base_url() ."laporan/status_pengisian'> halaman laporan </a>" ;
			echo "pesan";
			die;
		}
	}

	public function savedab()
	{
		$nim = $_GET["nim"];
		$hadiah = $_GET["hadiah"];
		$this->m_hadiah->beriHadiah($nim,$hadiah);
		$pesan = 'hadiah berhasil diubah untuk nim : '.$nim;
		$this->session->set_flashdata('message', $pesan);
		redirect('laporan/status_pengisian');
	}
}
