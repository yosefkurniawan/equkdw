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


		$input = $this->input->post('input');
	    if(!empty($input))
	    {
	        // Loop through hotels and add the validation
	        foreach($input as $id => $data)
	        {
	            $this->form_validation->set_rules('input[' . $id . '][a1]', 'Jawaban Pertanyaan 1', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a2]', 'Jawaban Pertanyaan 2', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a3]', 'Jawaban Pertanyaan 3', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a4]', 'Jawaban Pertanyaan 4', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a5]', 'Jawaban Pertanyaan 5', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a6]', 'Jawaban Pertanyaan 6', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a7]', 'Jawaban Pertanyaan 7', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a8]', 'Jawaban Pertanyaan 8', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a9]', 'Jawaban Pertanyaan 9', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a10]', 'Jawaban Pertanyaan 10', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a11]', 'Jawaban Pertanyaan 11', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][a12]', 'Jawaban Pertanyaan 12', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][masukan_dosen]', 'Masukan Dosen', 'required|trim');
	            $this->form_validation->set_rules('input[' . $id . '][masukan_matkul]', 'Masukan Matakuliah', 'required|trim');
	        }
	    }

		if ($this->form_validation->run())
	    {
			$this->submit_kuisioner();
	    }

		// fetch data
		$row_matakuliah		= $this->m_mahasiswa->getKelas($id_kelasb);
		$list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
		$list_soal			= $this->m_kuisioner->getPertanyaan();

		/* -- Render Layout -- */
		$data['row_matakuliah']	= $row_matakuliah;
		$data['list_dosen']	= $list_dosen;
		$data['list_soal']	= $list_soal;
		$data['title'] 		= 'Kuisioner Dosen';
		$data['content'] 	= 'mahasiswa/kuisioner';
		$this->load->view('main/render_layout',$data);				
	}

	public function submit_kuisioner()
	{
		$input = $this->input->post('input');
		foreach ($input as $key) 
		{
			$this->m_kuisioner->save_evaluasi($key);
		}
		$this->session->set_flashdata('message', 'kuisioner berhasil diisi');
		redirect('mahasiswa/dashboard');
	}
}