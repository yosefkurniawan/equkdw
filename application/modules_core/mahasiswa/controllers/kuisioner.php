<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'Mahasiswa') {
			redirect('main');
		}
			$this->load->model('m_kuisioner');
			$this->load->model('m_mahasiswa');

	}

	//menampilkan halaman KRS
	public function jawab($id_kelasb)
	{	
		// check wheter user registered in this class or not

		// fetch data
		$row_matakuliah		= $this->m_mahasiswa->getKelas($id_kelasb);
		$list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
		$list_soal			= $this->m_kuisioner->getPertanyaan();

		/* -- Render Layout -- */
		$data['left_bar']			= 'mahasiswa/left_bar_jawab';
		$data['row_matakuliah']	= $row_matakuliah;
		$data['list_dosen']	= $list_dosen;
		$data['list_soal']	= $list_soal;
		$data['title'] 		= 'Kuisioner Dosen';
		$data['content'] 	= 'mahasiswa/kuisioner';
		$this->load->view('main/render_layout',$data);				
	}

	public function save_jawaban_kuisioner()
	{
        $this->load->helper('date');
        $datestring = '%Y-%m-%d %h:%i:%a';
        $time = time();
        $now = mdate($datestring, $time);

		foreach ($_POST as $value) {
			$input = array(
				'nik'			=> $value['nik'],
				'id_kelasb' 	=> $value['id_kelasb'],
				'id_paket'		=> $value['id_paket'],
				'nim'			=> $value['nim'],
				'a1'			=> $value['a1'],
				'a2'			=> $value['a2'],
				'a3'			=> $value['a3'],
				'a4'			=> $value['a4'],
				'a5'			=> $value['a5'],
				'a6'			=> $value['a6'],
				'a7'			=> $value['a7'],
				'a8'			=> $value['a8'],
				'a9'			=> $value['a9'],
				'a10'			=> $value['a10'],
				'a11'			=> $value['a11'],
				'a12'			=> $value['a12'],
				'masukan_dosen'	=> $value['masukan_dosen'],
				'masukan_matkul'	=> $value['masukan_matkul'],
				'tanggal_pengisian'	=> $now
			);
			$this->m_kuisioner->save_evaluasi($input);
		}
		$this->session->set_flashdata('message', 'kuisioner berhasil diisi');
		// redirect('mahasiswa/dashboard');
		// foreach ($input as $key) 
		// {
		// 	$this->m_kuisioner->save_evaluasi($key);
		// }
		// $this->session->set_flashdata('message', 'kuisioner berhasil diisi');
		// redirect('mahasiswa/dashboard');
	}
}