<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('admin');	
		} 

		$this->load->model('main/m_general');
		$this->load->model('soal/m_soal');
		$this->load->model('m_laporan');
		$this->load->model('m_laporan_matkul');
		$this->load->model('mahasiswa/m_kuisioner');
		$this->load->model('mahasiswa/m_mahasiswa');
		$this->load->model('matakuliah/m_matakuliah');


	}

	public function index()
	{
		redirect('laporan/hasil_evaluasi');
	}

	public function hasil_evaluasi($id_paket=''){
    	//echo 'error'; die;


		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$listDosenPerUnit = $this->m_laporan->getListDosenAktifPerUnit();
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$listDosenPerUnit = $this->m_laporan->getListDosenAktifPerUnit($id_paket);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		}

		

		/* -- Render Layout -- */
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['pertanyaan']			= $pertanyaan;
		$data['listDosenPerUnit']	= $listDosenPerUnit;
		$data['title'] 		= 'Laporan - List Prodi';
		$data['content'] 	= 'laporan/list_prodi';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$data['periode']	= $periode;
		$data['last_periode']	= $this->m_general->getLastPeriode();
		$this->load->view('main/render_layout',$data);
	}


	public function rangkuman_evaluasi($prodi='',$id_paket=''){

		if ($prodi == '') {
			redirect('laporan/rangkuman_evaluasi/overview');
		}
		
		$data['id_paket'] 	= '';
		$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
		$periode['semester']	= $this->m_general->getLastPeriode()->semester;
		
		if ($prodi == 'overview') {		
			//total mtk

			if ($id_paket == '') {		
				$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview();
				$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview();

				$data['tot_mhs'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan();
				$data['tot_mhs_complete'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('complete');
				$data['tot_mhs_dont_have'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('dont');
				$data['tot_mhs_ongoing'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('ongoing');
			}
			else {
				$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview('',$id_paket);
				$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview('',$id_paket);

				$data['tot_mhs'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan();
				$data['tot_mhs_complete'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('complete','',$id_paket);
				$data['tot_mhs_dont_have'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('dont','',$id_paket);
				$data['tot_mhs_ongoing'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('ongoing','',$id_paket);				
			}

		} else {
			//total mtk
			if ($id_paket == '') {		
				$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($prodi);
				$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($prodi);			
	
				$data['tot_mhs'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('all',$prodi);
				$data['tot_mhs_complete'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('complete',$prodi);
				$data['tot_mhs_dont_have'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('dont',$prodi);
				$data['tot_mhs_ongoing'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('ongoing',$prodi);
			}
			else {
				$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($prodi,$id_paket);
				$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($prodi,$id_paket);			
	
				$data['tot_mhs'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('all',$prodi,$id_paket);
				$data['tot_mhs_complete'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('complete',$prodi,$id_paket);
				$data['tot_mhs_dont_have'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('dont',$prodi,$id_paket);
				$data['tot_mhs_ongoing'] = $this->m_laporan->getStatusPengisianMahasiswa_laporan('ongoing',$prodi,$id_paket);
			}

		}

		/* -- Render Layout -- */
		
		//get all unit
		
		$data['id_paket']			= $id_paket;
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['unit_list']			= $this->m_laporan_matkul->getUnitList();
/* 		$data['pertanyaan']			= $pertanyaan; */
/* 		$data['listDosenPerUnit']	= $listDosenPerUnit; */
		$data['title'] 		= 'Laporan - List Prodi';
		$data['content'] 	= 'laporan/hasil_evaluasi_rangkuman';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'rangkuman evaluasi';
		$data['periode']	= $periode;
		$data['last_periode']	= $this->m_general->getLastPeriode();
		$this->load->view('main/render_layout',$data);
	}

	public function pdf_hasil_rangkuman_per_mtk($id_unit,$id_paket=''){
	
	    $this->load->helper('pdf_helper');
		// set periode

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$data_evaluasi = $this->m_laporan_matkul->getMatakuliahRangkumanLaporan($id_unit);
			//total mtk
			$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($id_unit);
			$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($id_unit);
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$data_evaluasi			= $this->m_laporan_matkul->getMatakuliahRangkumanLaporan($id_unit,$id_paket);

			$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($id_unit,$id_paket);
			$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($id_unit,$id_paket);
		}


		$data['unit']				= $this->m_laporan_matkul->getUnitInfo($id_unit);
		$data['periode']			= $periode;
		$data['data_evaluasi']		= $data_evaluasi;

	    $this->load->view('pdf_rangkuman_hasil_mtk', $data);
	}

	function excel_hasil_rangkuman_per_mtk($id_unit,$id_paket=''){

		if ($id_unit == '') {
			echo 'ops! you cannot do that';
			die;
		}

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$data_evaluasi = $this->m_laporan_matkul->getMatakuliahRangkumanLaporan($id_unit);
			//total mtk
			$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($id_unit);
			$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($id_unit);
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$data_evaluasi			= $this->m_laporan_matkul->getMatakuliahRangkumanLaporan($id_unit,$id_paket);

			$data['mtk_overview'] = $this->m_laporan_matkul->get_mtk_overview($id_unit,$id_paket);
			$data['mtk_persen']	= $this->m_laporan_matkul->getMatakuliahOverview($id_unit,$id_paket);
		}


		$data['unit']				= $this->m_laporan_matkul->getUnitInfo($id_unit);
		$data['periode']			= $periode;
		$data['data_evaluasi']		= $data_evaluasi;

		$this->load->view('excel_rangkuman_hasil_mtk',$data);
	}


	public function pdf_daftar_siswa_belum_selesai($id_unit,$id_paket=''){
	
	    $this->load->helper('pdf_helper');
		// set periode

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
	        $params = array(
	            "unit_id" => $id_unit,
	            "nama" => '',
	            "eva_status" => '2'
	        );        	
	        
			$totMhs = $this->m_laporan->getStatusPengisianMahasiswa_row($params);
			$daftarMhs	= $this->m_laporan->getStatusPengisianMahasiswa(0,$totMhs,$params);
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
	        $params = array(
	            "unit_id" => $id_unit,
	            "nama" => '',
	            "eva_status" => '2'
	        );        	
	        
			$totMhs = $this->m_laporan->getStatusPengisianMahasiswa_row($params,$id_paket);
			$daftarMhs	= $this->m_laporan->getStatusPengisianMahasiswa(0,$totMhs,$params,$id_paket);
/* 			echo "<pre>"; print_r($daftarMhs); */
		}

		$data['unit']				= $this->m_laporan_matkul->getUnitInfo($id_unit);
		$data['periode']			= $periode;
		$data['data_evaluasi']		= $daftarMhs;

	    $this->load->view('pdf_daftar_siswa_belum_selesai', $data);
	}

	public function pdf_daftar_siswa_sudah_selesai($id_unit,$id_paket=''){
	
	    $this->load->helper('pdf_helper');
		// set periode

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
	        $params = array(
	            "unit_id" => $id_unit,
	            "nama" => '',
	            "eva_status" => '1'
	        );        	
	        
			$totMhs = $this->m_laporan->getStatusPengisianMahasiswa_row($params);
			$daftarMhs	= $this->m_laporan->getStatusPengisianMahasiswa(0,$totMhs,$params);
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
	        $params = array(
	            "unit_id" => $id_unit,
	            "nama" => '',
	            "eva_status" => '1'
	        );        	
	        
			$totMhs = $this->m_laporan->getStatusPengisianMahasiswa_row($params,$id_paket);
			$daftarMhs	= $this->m_laporan->getStatusPengisianMahasiswa(0,$totMhs,$params,$id_paket);
		}

		$data['unit']				= $this->m_laporan_matkul->getUnitInfo($id_unit);
		$data['periode']			= $periode;
		$data['data_evaluasi']		= $daftarMhs;

	    $this->load->view('pdf_daftar_siswa_sudah_selesai', $data);
	}


	public function status_pengisian($page = 0)
	{
        // get search parameter
        $search = $this->session->userdata('pengisian_mhs_search');
        if (!empty($search)) {
            $data['search'] = $search;

	        $params = array(
	            "unit_id" => $search['unit_id'],
	            "nama" => '%'.$search['nama'].'%',
	            "eva_status" => $search['eva_status']
	        	);

        } 
        else {
	        $params = array(
	            "unit_id" => '',
	            "nama" => '',
	            "eva_status" => ''
	        );        	
            $data['search'] = $params;
        }

        // print_r($params);die;

		$data['tot_mhs'] = $this->m_laporan->getStatusPengisianMahasiswa_row($params);

		// pagination start
		$data['start'] = $this->uri->segment(4);
		// pagination
		$config['base_url']			= base_url().'laporan/status_pengisian/';
		$config['total_rows']		= $data['tot_mhs'];
		$config['per_page']			= 20;
		$config['uri_segment']		= 3;
		$config['full_tag_open']	= '<ul class="pagination nomargin pull-right">';
		$config['full_tag_close']	= '</ul>';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';
		$config['cur_tag_open']		=  '<li class="active"><a>';
		$config['cur_tag_close']	= '</a></li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();
		/* -- Render Layout -- */
		$data['list_pengisian']	= $this->m_laporan->getStatusPengisianMahasiswa(intval($page), $config['per_page'],$params);
		$data['list_prodi']		= $this->m_matakuliah->getListOfProdi();

		$data['message']	= $this->session->flashdata('message');
		$data['title'] 		= 'Laporan - List Status Pengisian Kuisioner';
/* 		$data['custom_css'][] 	= 'public/assets/css/css-laporan-monitor.css'; */
		$data['content'] 	= 'laporan/list_pengisian';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'status pengisian';
		$this->load->view('main/render_layout',$data);
	}

	public function test() {
/*
		$sql = "SELECT * 
				FROM ec_pengajar p
				WHERE p.id_kelasb='5028'";
*/

/*
		$sql = "SELECT * 
				FROM ec_kelas_buka k 
				WHERE k.kode='AB1013' AND k.semester='GASAL' AND k.thn_ajaran='2014/2015'";
*/
/*

		$params = array(
			'id_kelasb' => '5028',
			'nik' => '198904094'
			);
		$this->db->insert('ec_pengajar',$params);
		$params = array(
			'id_kelasb' => '5029',
			'nik' => '198904094'
			);
		$this->db->insert('ec_pengajar',$params);
		die;
*/

/*
	
		$sql = "SELECT * 
				FROM (SELECT * FROM ec_peserta WHERE nim = '12050432') p
				LEFT JOIN ec_kelas_buka k ON k.id_kelasb = p.id_kelasb
				LEFT JOIN ec_matkul m ON k.kode = m.kode
				LEFT JOIN ec_pengajar r ON r.id_kelasb = k.id_kelasb
				WHERE k.semester='GASAL' AND k.thn_ajaran='2014/2015'";
*/
		$query = $this->db->query($sql);
		echo "<pre>"; print_r($query->result_array());
	}

    public function proses_cari() {
    	// echo "<pre>"; print_r($this->input->post());die;
        // data
        if ($this->input->post('save') == "Reset") {
            // $this->tsession->unset_userdata('aircraft_search');
			 $this->session->unset_userdata('pengisian_mhs_search');
        } else {
            $params = array(
                "unit_id" => $this->input->post("unit_id"),
                "nama" => $this->input->post("nama"),
                "eva_status" => $this->input->post("eva_status"),
            );
			$this->session->set_userdata('pengisian_mhs_search',$params);
            // $this->tsession->set_userdata("aircraft_search", $params);
        }
        // redirect
        redirect("laporan/status_pengisian");
    }

    public function getKRS() {
		foreach ($_POST as $value => $val) 
		{
			// $insert = $this->m_igd->save_catatan_care($val);
			$query = $this->m_laporan->getKRS($val['nim']);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($query);	    	
    }

    public function getPeserta() {
		foreach ($_POST as $value => $val) 
		{
			// $insert = $this->m_igd->save_catatan_care($val);
			$query = $this->m_laporan_matkul->getPeserta($val['kode'],$val['grup']);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($query);	    	
    }


	public function hasil_evaluasi_dosen($nik,$id_paket=''){
		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);

		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true,$id_paket);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		}

		/* -- Render Layout -- */
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['dosen']				= $dosen;
		$data['admin']				= 'ya';
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;
		$data['periode']	= $periode;
		$data['title'] 		= "Laporan - $nik";
		$data['content'] 	= 'laporan/hasil_evaluasi_dosen';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);			
	}

	function pdf_hasil_evaluasi_dosen_per_prodi($id_unit,$id_paket='')
	{
	    $this->load->helper('pdf_helper');


		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		    $data_evaluasi = array();
		    $list_dosen_by_prodi = $this->m_laporan->getListDosenByIdUnit($id_unit);
	
		    if (!empty($list_dosen_by_prodi)) {
		    	foreach ($list_dosen_by_prodi as $key => $dsn) {
					$data_evaluasi[$dsn['nik']]['dosen'] 			= $dsn;
					$data_evaluasi[$dsn['nik']]['hasil_evaluasi'] 	= $this->m_laporan->getHasilEvaluasi($dsn['nik']);
		    	}
		    }

		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		    $data_evaluasi = array();
		    $list_dosen_by_prodi = $this->m_laporan->getListDosenByIdUnit($id_unit,$id_paket);
	
		    if (!empty($list_dosen_by_prodi)) {
		    	foreach ($list_dosen_by_prodi as $key => $dsn) {
					$data_evaluasi[$dsn['nik']]['dosen'] 			= $dsn;
					$data_evaluasi[$dsn['nik']]['hasil_evaluasi'] 	= $this->m_laporan->getHasilEvaluasi($dsn['nik'],$id_paket);
		    	}
		    }
		}
		

		$data['periode']			= $periode;
		$data['data_evaluasi']		= $data_evaluasi;
		$data['pertanyaan']			= $pertanyaan;
		$data['id_unit']			= $id_unit;

	    $this->load->view('pdf_evaluasi_dosen_per_prodi', $data);
	}

	function pdf_hasil_evaluasi_dosen($nik,$id_paket='')
	{
	    $this->load->helper('pdf_helper');
		$dosen 			= $this->m_laporan->getDetailDosen($nik);
		$masukan_dosen  = $this->m_laporan->getMasukanDosen($nik);

		// set periode
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
			$periode['semester']	= $this->m_general->getLastPeriode()->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan();
		}
		else {
			$data['id_paket'] = $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$hasil_evaluasi = $this->m_laporan->getHasilEvaluasi($nik,true,$id_paket);
			$pertanyaan		= $this->m_kuisioner->getPertanyaan_laporan($id_paket);
		}


		$data['periode']			= $periode;
		$data['dosen']				= $dosen;
		$data['hasil_evaluasi']		= $hasil_evaluasi;
		$data['masukan_dosen']		= $masukan_dosen;
		$data['pertanyaan']			= $pertanyaan;

	    $this->load->view('pdf_evaluasi_dosen', $data);
	}

	public function setPeriode()
	{
		$new_periode['thn_ajaran'] 	= $_POST['thn_ajaran'];
		$new_periode['semester'] 	= $_POST['semester'];
		$this->session->set_userdata('periode_laporan_evaluasi', $new_periode);

		$this->session->set_flashdata('message', 'Peride berhasil diubah.');
		$this->session->set_flashdata('message_class', 'alert-success block-important');

		redirect('laporan/hasil_evaluasi');
	}
	
	
	public function matakuliah($page=0) {

        $search = $this->session->userdata('pengisian_mtk_search');
        if (!empty($search)) {
            $data['search'] = $search;

	        $params = array(
	            "unit_id" => $search['unit_id'],
	            "nama" => '%'.$search['nama'].'%'
	            // "selesai" => $search['selesai']
	        	);

        } 
        else {
	        $params = array(
	            "unit_id" => '',
	            "nama" => ''
	            // "selesai" => ''
	        );        	
            $data['search'] = $params;
        }

		$data['tot_mtk'] = $this->m_laporan_matkul->getMatakuliah_tot($params);

		// pagination start
		$data['start'] = $this->uri->segment(4);
		// pagination
		$config['base_url']			= base_url().'laporan/matakuliah/';
		$config['total_rows']		= $data['tot_mtk'];
		$config['per_page']			= 20;
		$config['uri_segment']		= 3;
		$config['full_tag_open']	= '<ul class="pagination nomargin pull-right">';
		$config['full_tag_close']	= '</ul>';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';
		$config['cur_tag_open']		=  '<li class="active"><a>';
		$config['cur_tag_close']	= '</a></li>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();
		/* -- Render Layout -- */
		$data['matkul']	= $this->m_laporan_matkul->getMatakuliah(intval($page), $config['per_page'],$params);

		
		/* -- Data -- */
		// $data['matkul']		= $this->m_laporan_matkul->getMatakuliah();
		
		/* -- Render Layout -- */
		$data['list_prodi']		= $this->m_matakuliah->getListOfProdi();

		$data['title'] 		= 'Laporan - Matakuliah';
		$data['content'] 	= 'laporan/list_matakuliah';
		$data['left_bar']	= 'laporan/left_bar_admin';
		$data['active']		= 'matakuliah';
		$this->load->view('main/render_layout',$data);
	}

    public function proses_cari_mtk() {
    	// echo "<pre>"; print_r($this->input->post());die;
        // data
        if ($this->input->post('save') == "Reset") {
            // $this->tsession->unset_userdata('aircraft_search');
			 $this->session->unset_userdata('pengisian_mtk_search');
        } else {
            $params = array(
                "unit_id" => $this->input->post("unit_id"),
                "nama" => $this->input->post("nama")
                // "selesai" => $this->input->post("selesai"),
            );
			$this->session->set_userdata('pengisian_mtk_search',$params);
            // $this->tsession->set_userdata("aircraft_search", $params);
        }
        // redirect
        redirect("laporan/matakuliah");
    }

}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */