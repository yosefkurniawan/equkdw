<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ip extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		#give default timezone
		date_default_timezone_set('Asia/Jakarta');

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('main/page404');	
		} 

		$this->load->model('ip_model');
		$this->load->model('main/m_general');
		$this->load->model('laporan/m_laporan');
	}

	function index($id_paket=''){
		redirect('ip/ip/lists/'.$id_paket);
	}

	function lists($id_paket=''){
		// $data['period'] = $this->ip_model->get_thn_ajaran_periode();

		// $this->ip_model->updt_kelass_all();
		// die;
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
		}


		// $data['dosen'] = $this->ip_model->get_dosen_list($periode['thn_ajaran'],$periode['semester']);
		$data['listDosenPerUnit'] = $this->ip_model->getListDosenAktifPerUnit($periode['thn_ajaran'],$periode['semester'],$data['id_paket']);

		/* -- Render Layout -- */
		$data['paket_list']	= $this->m_laporan->getPaketList();
		$data['periode']	= $periode;
		$data['title'] 		= "IP Dosen";
		$data['content'] 	= 'ip/ip/list';
		$this->load->view('main/render_layout',$data);
	}

	function login_as($nik='',$id_paket=''){

		if ($nik == NULL) {
			redirect('ip/ip');
		}

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
			$data['periode']['semester'] 	= $_periode['semester'];
			$data['periode']['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $_periode['deadline'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$periode['deadline']	= $this->m_laporan->getPaketList($id_paket)->deadline_o4;
			$data['periode']['semester'] 	= $periode['semester'];
			$data['periode']['thn_ajaran'] 	= $periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $periode['deadline'];			
		}
		/* -- Give PDF Default Name -- */
		
		/* -- Render Layout -- */
		$data['admin']				= 'ya';
		$data['dsn'] 				= $this->ip_model->get_dosen_info($nik);
		$data['ajar'] 				= $this->ip_model->get_dosen_ajar($nik,$periode['thn_ajaran'],$periode['semester']);
		$title = "IP Dosen ".$periode['thn_ajaran']." ".$periode['semester']." - " . $data['dsn']->nama_dsn; 
		$data['title'] 				= $title;
		$data['content'] 			= 'laporan/hasil_ip_dosen';
		$data['paket_list']			= $this->m_laporan->getPaketList();
		$data['btn_print']			= "<a href='".base_url()."laporan/dosen/detail_dosen_pdf/".$data['dsn']->nik."' class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>";
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}	

	function detail_dosen_pdf($nik = NULL,$id_paket = NULL){

		if ($nik == NULL) {
			redirect('ip/ip');
		}
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
			$data['periode']['semester'] 	= $_periode['semester'];
			$data['periode']['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $_periode['deadline'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$periode['deadline']	= $this->m_laporan->getPaketList($id_paket)->deadline_o4;
			$data['periode']['semester'] 	= $periode['semester'];
			$data['periode']['thn_ajaran'] 	= $periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $periode['deadline'];			
		}

		$data['dsn'] = $this->ip_model->get_dosen_info($nik);

		$data['ajar'] = $this->ip_model->get_dosen_ajar($nik,$periode['thn_ajaran'],$periode['semester']);

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di universitas -- */
		$data['uni_o1'] = $this->ip_model->get_univ_o1($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o2'] = $this->ip_model->get_univ_o2($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o3'] = $this->ip_model->get_univ_o3($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o4'] = $this->ip_model->get_univ_o4($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o5'] = $this->ip_model->get_univ_o5($periode['thn_ajaran'],$periode['semester']);


		//get dosen asal prodi
		$id_unit = $data['dsn']->id_unit;
		// echo 'prodi : '.$prodi['prodi']; die;
		// $prodi = $data['dsn']->prodi;

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di prodi yang sama -- */
		$data['prodi_o1'] = $this->ip_model->get_prodi_o1($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o2'] = $this->ip_model->get_prodi_o2($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o3'] = $this->ip_model->get_prodi_o3($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o4'] = $this->ip_model->get_prodi_o4($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o5'] = $this->ip_model->get_prodi_o5($id_unit,$periode['thn_ajaran'],$periode['semester']);

		// echo "berhasil";
		// die;

		/* -- Give PDF Default Name -- */
		$pdf_title = "IP Dosen ".$periode['thn_ajaran']." ".$periode['semester']." - " . $data['dsn']->nama_dsn; 
		
		/* -- Render Layout -- */
		$data['title'] 		= $pdf_title;
		$data['content'] 	= 'ip/ip/pdf/ip_dosen';
		$data['custom_css'][] 	= 'public/assets/css/pdf-ip-dosen.css';

   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}

	function detail_dosen_perprodi_pdf($id_unit = NULL, $id_paket = NULL){

		if ($id_unit == NULL) {
			redirect('ip/ip');
		}

		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
			$data['periode']['semester'] 	= $_periode['semester'];
			$data['periode']['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $_periode['deadline'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
			$periode['deadline']	= $this->m_laporan->getPaketList($id_paket)->deadline_o4;
			$data['periode']['semester'] 	= $periode['semester'];
			$data['periode']['thn_ajaran'] 	= $periode['thn_ajaran'];
			$data['periode']['deadline'] 	= $periode['deadline'];			
		}

		// get dosen list per prodi
		$dosen_list = $this->ip_model->getDosenListPerProdi($id_unit, $periode['semester'], $periode['thn_ajaran']);

		foreach ($dosen_list as $key => $dosen) {
			
			$nik = $dosen['nik'];

			$data['dsn'][] = $this->ip_model->get_dosen_info($nik);

			$data['ajar'][] = $this->ip_model->get_dosen_ajar($nik,$periode['thn_ajaran'],$periode['semester']);		
		}
		
		/* -- Perhitungan rata-rata p1 - p5 semua dosen di universitas -- */
		$data['uni_o1'] = $this->ip_model->get_univ_o1($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o2'] = $this->ip_model->get_univ_o2($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o3'] = $this->ip_model->get_univ_o3($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o4'] = $this->ip_model->get_univ_o4($periode['thn_ajaran'],$periode['semester']);
		$data['uni_o5'] = $this->ip_model->get_univ_o5($periode['thn_ajaran'],$periode['semester']);

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di prodi yang sama -- */
		$data['prodi_o1'] = $this->ip_model->get_prodi_o1($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o2'] = $this->ip_model->get_prodi_o2($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o3'] = $this->ip_model->get_prodi_o3($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o4'] = $this->ip_model->get_prodi_o4($id_unit,$periode['thn_ajaran'],$periode['semester']);
		$data['prodi_o5'] = $this->ip_model->get_prodi_o5($id_unit,$periode['thn_ajaran'],$periode['semester']);

		/* -- Give PDF Default Name -- */
		$pdf_title = "IP Dosen ".$periode['thn_ajaran']." ".$periode['semester']." - " . $id_unit; 
		$data['title'] 		= $pdf_title;

		/* -- Render Layout -- */
		$data['content'] 		= 'ip/ip/pdf/ip_dosen_perprodi';
		$data['custom_css'][] 	= 'public/assets/css/pdf-ip-dosen.css';
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';

		// echo "<pre>"; print_r($data);die;

		$this->load->view('main/render_layout',$data);
	}

	function rangkuman($id_unit = '',$id_paket='') {

		if ($id_unit == '') {
			redirect('ip/ip');
		}
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
		}

	    $this->load->helper('pdf_helper');

		$data['list_ip_dosen_prodi'] = $this->ip_model->get_ip_list($id_unit,$periode['thn_ajaran'],$periode['semester']);

		/* -- Render Layout -- */
		// $data['title'] 		= "IP Dosen";
		// $data['content'] 	= 'ip/ip/rangkuman';
		// $this->load->view('main/render_layout',$data);

		$data['thn_ajaran']			= $periode['thn_ajaran'];
		$data['periode']			= $periode['semester'];
		$data['prodi']				= $this->ip_model->get_info_ref_unit($id_unit);
		// $data['prodi']				= $this->ip_model->convertIdUnitToProdi($prodi);
		// $data['list']				= $list_ip_dosen_prodi;

	    $this->load->view('ip/ip/pdf/pdf_rangkuman_ip_dosen_per_prodi', $data);

		//echo 'horay , you are there champs!';
	}

	function export($id_unit = '',$id_paket=''){

	$header = $this->set_header();
	$data = array($header);

	if ($id_unit == '') {
		redirect('ip/ip');
	}
	if ($id_paket == '') {
		$data['id_paket'] 	= '';
		$periode['thn_ajaran'] 	= $this->m_general->getLastPeriode()->thn_ajaran;
		$periode['semester']	= $this->m_general->getLastPeriode()->semester;
	}
	else {
		$data['id_paket'] 		= $id_paket;
		$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
		$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
	}
	    
	$filename  = 'Laporan_User';
	$loop = 0;
	// $list = $this->ip_model->get_ip_list($prodi,'2013/2014','GENAP');
	$list = $this->ip_model->get_ip_list($id_unit,$periode['thn_ajaran'],$periode['semester']);

	foreach($list as $row){  
	   $content[$loop] = array($row->nik_baru, $row->nama_dsn, $row->total_ip, $row->jmlh_mtk, $row->ip_dosen);
	   array_push($data, $content[$loop]);
	   $loop++;   
	}
		  $this->load->helper('to_excel');
		  array_to_excel($data, $filename);
	}
	   

	function set_header(){
	  	return array('Nik','Nama Dosen','Total IPS','Total Mtk','IP Dosen');
	}

	function export_to_excel($id_unit = '',$id_paket=''){

		if ($id_unit == '') {
			redirect('ip/ip');
		}
		if ($id_paket == '') {
			$data['id_paket'] 	= '';
			$_periode 				= $this->ip_model->getLastPeriodePaket();
			$periode['thn_ajaran'] 	= $_periode['thn_ajaran'];
			$periode['semester']	= $_periode['semester'];
		}
		else {
			$data['id_paket'] 		= $id_paket;
			$periode['thn_ajaran']	= $this->m_laporan->getPaketList($id_paket)->thn_ajaran;
			$periode['semester']	= $this->m_laporan->getPaketList($id_paket)->semester;
		}

		$data['list_ip_dosen_prodi'] = $this->ip_model->get_ip_list($id_unit,$periode['thn_ajaran'],$periode['semester']);

		/* -- Render Layout -- */
		$data['thn_ajaran']			= $periode['thn_ajaran'];
		$data['periode']			= $periode['semester'];
		// $data['prodi']				= $this->ip_model->get_info_prodi($prodi);
		$data['prodi']				= $this->ip_model->get_info_ref_unit($id_unit);
		// $data['list']				= $list_ip_dosen_prodi;

		$this->load->view('ip/ip/pdf/coba_excel',$data);
	}

	function laporan() {
		$html = '<img width="250px" src="'+$_GET['param']+'">';
		$this->load->library('mpdf');
		$this->mpdf->WriteHTML($html);
		$this->mpdf->Output('MyPDF.pdf', 'D');
		die();
	}

}

/* End of file role.php */
/* Location: ./application/modules_core/admin/controllers/role.php */