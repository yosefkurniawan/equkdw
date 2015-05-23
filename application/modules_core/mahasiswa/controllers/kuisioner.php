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
			$this->load->model('m_kelas');
			date_default_timezone_set('Asia/Jakarta');

	}

	//menampilkan halaman KRS
	public function jawab($id_kelasb)
	{	
		$authorize = TRUE;

		$row_status		= $this->m_mahasiswa->getKelasStatus($id_kelasb,$this->session->userdata('username'));

		// check wheter user registered in this class or not
		if ($registered = $this->m_kelas->getMhsApakahTerdaftar($id_kelasb,$this->session->userdata('username'))) {	
			//apakah ada kusionernya
			if ($row_status->eva_status == 1 OR $row_status->eva_status == 2) {

				$today = date("Y-m-d");

				//apakah sudah boleh mengisi
				if ($today >= $row_status->mulai AND $today <= $row_status->akhir) {

					//apakah sudah mengisi
					if ($row_status->jawaban == '-') {
						$authorize = TRUE;						
					}
					else {
						$authorize = FALSE;
						$pesan = "anda sudah mengisi kuisioner ini"; //sudah terisi
					}
				}
				else {
					$authorize = FALSE;
					$pesan = "kuisioner pada matakuliah ini belum waktunya diisi"; //belum waktunya mengisi
				}
			}
			else {
				$authorize = FALSE;
				$pesan = "matakuliah ini tidak memiliki kuisioner yang perlu untuk anda isi"; //tidak ada kuisioner
			}
		} 
		else {
			$authorize = FALSE;
			$pesan = "anda tidak terdaftar" ; //tidak terdaftar

		} 

		if ($authorize == TRUE) {
			// fetch data
			$row_matakuliah 	= $this->m_mahasiswa->getKelas($id_kelasb);
			$list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
			$list_soal			= $this->m_kuisioner->getPertanyaan();
			// echo "<pre>";print_r($list_soal);die;
			// fetch data presensi
			$pertemuan			= $this->m_kelas->getPertemuan($id_kelasb);
			$kehadiran 			= $this->m_kelas->getKehadiranKelas($id_kelasb,$this->session->userdata('username'));
			$kehadiranDosen 	= $this->m_kelas->getKehadiranKelasDosen($id_kelasb);
			if ($kehadiranDosen['temu'] > 0)
			{
				$hadirMhs = $kehadiran['hadir'];
				$banyakPertemuan = $kehadiranDosen['temu'];
				// echo $hadirMhs;echo$banyakPertemuan;
				$presensi			= $hadirMhs / $banyakPertemuan * 100;
				// $presensi2			= 20 / 13 * 100;
				// echo $presensi; echo " ".$presensi2; die;
			}
			else
			{
				$presensi			= 0;				
			}
			$presensi 			= round($presensi,2);
			// echo  $kehadiran->num_rows() . " / " . $pertemuan->num_rows() . " = " . $presensi ; die;

			/* -- Render Layout -- */
			$data['left_bar']		= 'mahasiswa/left_bar_jawab';
			$data['row_matakuliah']	= $row_matakuliah;
			$data['list_dosen']	= $list_dosen;
			$data['list_soal']	= $list_soal;
			$data['pertemuan']  = $pertemuan;
			$data['kehadiran']	= $kehadiran;
			$data['kehadiranDosen']	= $kehadiranDosen;
			$data['presensi']	= $presensi;
			$data['title'] 		= 'Kuisioner Dosen';
			$data['content'] 	= 'mahasiswa/kuisioner';
			$data['custom_css'][] 	= 'public/assets/css/jawab.css';
			$this->load->view('main/render_layout',$data);		

		}
		else {
			$pesan = $pesan . " silahkan kembali ke <a href='" . base_url() ."mahasiswa/dashboard'> halaman dashboard </a>" ;
			echo $pesan;
			die;
		} 	
	}


	public function save_jawaban_kuisioner()
	{
        $this->load->helper('date');
        $datestring = '%Y-%m-%d %H:%i:%s';
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
				'masukan_matkul'=> $value['masukan_matkul'],
				'presensi'		=> $value['presensi'],
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

	public function lihat($id_kelasb)
	{	

		$authorize = FALSE;

		$row_status		= $this->m_mahasiswa->getKelasStatus($id_kelasb,$this->session->userdata('username'));

		// check wheter user registered in this class or not
		if ($registered = $this->m_kelas->getMhsApakahTerdaftar($id_kelasb,$this->session->userdata('username'))) {	
			//apakah ada kusionernya
			if ($row_status->eva_status == 1) {

				$today = date("Y-m-d");
				
				//apakah sudah boleh mengisi
				if ($today >= $row_status->mulai AND $today <= $row_status->akhir) {

					//apakah sudah mengisi
					if ($row_status->jawaban == '-') {
						$authorize = FALSE;
						$alamat  = 'mahasiswa/kuisioner/jawab/'.$id_kelasb;						
						redirect($alamat); //sudah terisi
					}
					else {
						$authorize = TRUE;
					}
				}
				else {
					$authorize = FALSE;
					$pesan = "kuisioner pada matakuliah ini belum waktunya diisi"; //belum waktunya mengisi
				}
			}
			else {
				$authorize = FALSE;
				$pesan = "matakuliah ini tidak memiliki kuisioner yang perlu untuk anda isi"; //tidak ada kuisioner
			}
		} 
		else {
			$authorize = FALSE;
			$pesan = "anda tidak terdaftar" ; //tidak terdaftar
		} 

		if ($authorize == TRUE) {

			// fetch data
			$row_matakuliah 	= $this->m_mahasiswa->getKelas($id_kelasb);
			// $list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
			$list_dosen			= $this->m_kuisioner->getJawabanMahasiswa($id_kelasb,$this->session->userdata('username'));
			$list_soal			= $this->m_kuisioner->getPertanyaan();
			// fetch data presensi
			$pertemuan			= $this->m_kelas->getPertemuan($id_kelasb);
			$kehadiran 			= $this->m_kelas->getKehadiranKelas($id_kelasb,$this->session->userdata('username'));
			$kehadiranDosen 	= $this->m_kelas->getKehadiranKelasDosen($id_kelasb);
			//get jawaban
			if ($kehadiranDosen['temu'] > 0)
			{
				$hadirMhs = $kehadiran['hadir'];
				$banyakPertemuan = $kehadiranDosen['temu'];
				// echo $hadirMhs;echo$banyakPertemuan;
				$presensi			= $hadirMhs / $banyakPertemuan * 100;
				// $presensi2			= 20 / 13 * 100;
				// echo $presensi; echo " ".$presensi2; die;
			}
			else
			{
				$presensi			= 0;				
			}
			$presensi 			= round($presensi,2);

			/* -- Render Layout -- */
			$data['left_bar']		= 'mahasiswa/left_bar_jawab';
			$data['row_matakuliah']	= $row_matakuliah;
			$data['list_dosen']	= $list_dosen;
			$data['list_soal']	= $list_soal;
			$data['pertemuan']  = $pertemuan;
			$data['kehadiran']	= $kehadiran;
			$data['kehadiranDosen']	= $kehadiranDosen;
			$data['presensi']	= $presensi;
			$data['title'] 		= 'Lihat Jawaban Kuisioner Dosen';
			$data['content'] 	= 'mahasiswa/lihat_kuisioner';
			$this->load->view('main/render_layout',$data);		

		}
		else {
			$pesan = $pesan . " silahkan kembali ke <a href='" . base_url() ."mahasiswa/dashboard'> halaman dashboard </a>" ;
			echo $pesan;
			die;
		} 	
	}

	//end of real code!!!!!!!!!!


	/*
	*
	*
	*
	*
	*/

	/*THIS IS JUST FOR TESTING PURPOSE*/
	public function jawabtest($id_kelasb)
	{	
		// echo "tidak bisa";die;

		$authorize = TRUE;

		$row_status		= $this->m_mahasiswa->getKelasStatus($id_kelasb,'72110007');
		// echo '<pre>'; print_r($row_status); die;

		// check wheter user registered in this class or not
		if ($registered = $this->m_kelas->getMhsApakahTerdaftar($id_kelasb,'72110007')) {	
			//apakah ada kusionernya
			if ($row_status->eva_status == 1 OR $row_status->eva_status == 2) {

				$today = date("Y-m-d");
				
				//apakah sudah boleh mengisi
				if ($today >= $row_status->mulai AND $today <= $row_status->akhir) {

					//apakah sudah mengisi
					if ($row_status->jawaban == '-') {
						$authorize = TRUE;						
					}
					else {
						$authorize = FALSE;
						$pesan = "anda sudah mengisi kuisioner ini"; //sudah terisi
					}
				}
				else {
					$authorize = FALSE;
					$pesan = "kuisioner pada matakuliah ini belum waktunya diisi"; //belum waktunya mengisi
				}
			}
			else {
				$authorize = FALSE;
				$pesan = "matakuliah ini tidak memiliki kuisioner yang perlu untuk anda isi"; //tidak ada kuisioner
			}
		} 
		else {
			$authorize = FALSE;
			$pesan = "anda tidak terdaftar" ; //tidak terdaftar

		} 

		if ($authorize == TRUE) {

			// fetch data
			$row_matakuliah 	= $this->m_mahasiswa->getKelas($id_kelasb);
			$list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
			$list_soal			= $this->m_kuisioner->getPertanyaan();
			// fetch data presensi
			$pertemuan			= $this->m_kelas->getPertemuan($id_kelasb);
			$kehadiran 			= $this->m_kelas->getKehadiranKelas($id_kelasb,'72110007');
			$kehadiranDosen 	= $this->m_kelas->getKehadiranKelasDosen($id_kelasb);
			if ($kehadiranDosen->num_rows() != 0)
			{
				$presensi			= $kehadiran->num_rows() / $kehadiranDosen->num_rows() * 100;
			}
			else
			{
				$presensi			= 0;				
			}
			$presensi 			= (float)number_format($presensi,2,'.','');
			// echo  $kehadiran->num_rows() . " / " . $pertemuan->num_rows() . " = " . $presensi ; die;

			/* -- Render Layout -- */
			$data['left_bar']		= 'mahasiswa/left_bar_jawab';
			$data['row_matakuliah']	= $row_matakuliah;
			$data['list_dosen']	= $list_dosen;
			$data['list_soal']	= $list_soal;
			$data['pertemuan']  = $pertemuan;
			$data['kehadiran']	= $kehadiran;
			$data['kehadiranDosen']	= $kehadiranDosen;
			$data['presensi']	= $presensi;
			$data['title'] 		= 'Kuisioner Dosen';
			$data['content'] 	= 'mahasiswa/kuisioner';
			$this->load->view('main/render_layout',$data);		

		}
		else {
			$pesan = $pesan . " silahkan kembali ke <a href='" . base_url() ."mahasiswa/dashboard'> halaman dashboard </a>" ;
			echo $pesan;
			die;
		} 	
	}

	public function lihattest($id_kelasb)
	{	
		echo "tidak bisa";die;

		$authorize = FALSE;

		$row_status		= $this->m_mahasiswa->getKelasStatus($id_kelasb,'72120003');
		// echo '<pre>'; print_r($row_status); die;

		// check wheter user registered in this class or not
		if ($registered = $this->m_kelas->getMhsApakahTerdaftar($id_kelasb,'72120003')) {	
			//apakah ada kusionernya
			if ($row_status->eva_status == 1) {

				$today = date("Y-m-d");
				
				//apakah sudah boleh mengisi
				if ($today >= $row_status->mulai AND $today <= $row_status->akhir) {

					//apakah sudah mengisi
					if ($row_status->jawaban == '-') {
						$authorize = FALSE;
						$alamat  = 'mahasiswa/kuisioner/jawab/'.$id_kelasb;						
						redirect($alamat); //sudah terisi
					}
					else {
						$authorize = TRUE;
					}
				}
				else {
					$authorize = FALSE;
					$pesan = "kuisioner pada matakuliah ini belum waktunya diisi"; //belum waktunya mengisi
				}
			}
			else {
				$authorize = FALSE;
				$pesan = "matakuliah ini tidak memiliki kuisioner yang perlu untuk anda isi"; //tidak ada kuisioner
			}
		} 
		else {
			$authorize = FALSE;
			$pesan = "anda tidak terdaftar" ; //tidak terdaftar
		} 

		if ($authorize == TRUE) {

			// fetch data
			$row_matakuliah 	= $this->m_mahasiswa->getKelas($id_kelasb);
			// $list_dosen			= $this->m_mahasiswa->getDosenKelas($id_kelasb);
			$list_dosen			= $this->m_kuisioner->getJawabanMahasiswa($id_kelasb,'72120003');
			$list_soal			= $this->m_kuisioner->getPertanyaan();
			// fetch data presensi
			$pertemuan			= $this->m_kelas->getPertemuan($id_kelasb);
			$kehadiran 			= $this->m_kelas->getKehadiranKelas($id_kelasb,'72120003');
			$kehadiranDosen 	= $this->m_kelas->getKehadiranKelasDosen($id_kelasb);
			//get jawaban
			if ($kehadiranDosen->num_rows() != 0)
			{
				$presensi			= $kehadiran->num_rows() / $kehadiranDosen->num_rows() * 100;
			}
			else
			{
				$presensi			= 0;				
			}
			$presensi 			= (float)number_format($presensi,2,'.','');
			// echo  $kehadiran->num_rows() . " / " . $pertemuan->num_rows() . " = " . $presensi ; die;

			/* -- Render Layout -- */
			$data['left_bar']		= 'mahasiswa/left_bar_jawab';
			$data['row_matakuliah']	= $row_matakuliah;
			$data['list_dosen']	= $list_dosen;
			$data['list_soal']	= $list_soal;
			$data['pertemuan']  = $pertemuan;
			$data['kehadiran']	= $kehadiran;
			$data['kehadiranDosen']	= $kehadiranDosen;
			$data['presensi']	= $presensi;
			$data['title'] 		= 'Lihat Jawaban Kuisioner Dosen';
			$data['content'] 	= 'mahasiswa/lihat_kuisioner';
			$this->load->view('main/render_layout',$data);		

		}
		else {
			$pesan = $pesan . " silahkan kembali ke <a href='" . base_url() ."mahasiswa/dashboard'> halaman dashboard </a>" ;
			echo $pesan;
			die;
		} 	
	}	

	public function ngintip ($id_kelasb)
	{
		echo "tidak bisa";die;
		
		$alamat  = 'mahasiswa/kuisioner/jawab/'.$id_kelasb;
		redirect($alamat);						

	}

}