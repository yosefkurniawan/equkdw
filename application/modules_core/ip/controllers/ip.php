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
	}

	function index(){
		// $data['period'] = $this->ip_model->get_thn_ajaran_periode();

		// $this->ip_model->updt_kelass_all();
		// die;


		$data['dosen'] = $this->ip_model->get_dosen_list('2013/2014','GENAP');

		/* -- Render Layout -- */
		$data['title'] 		= "IP Dosen";
		$data['content'] 	= 'ip/ip/list';
		$this->load->view('main/render_layout',$data);
	}

	function detail_dosen_pdf($nik = NULL){

		$data['ajar'] = $this->ip_model->get_dosen_ajar($nik,'2013/2014','GENAP');
		$data['dsn'] = $this->ip_model->get_dosen_info($nik);

		//get dosen asal prodi
		$prodi = $data['dsn']->prodi;

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di prodi yang sama -- */
		$data['prodi_o1'] = $this->ip_model->get_prodi_o1($prodi,'2013/2014','GENAP');
		$data['prodi_o2'] = $this->ip_model->get_prodi_o2($prodi,'2013/2014','GENAP');
		$data['prodi_o3'] = $this->ip_model->get_prodi_o3($prodi,'2013/2014','GENAP');
		$data['prodi_o4'] = $this->ip_model->get_prodi_o4($prodi,'2013/2014','GENAP');
		$data['prodi_o5'] = $this->ip_model->get_prodi_o5($prodi,'2013/2014','GENAP');

		/* -- Perhitungan rata-rata p1 - p5 semua dosen di universitas -- */
		$data['uni_o1'] = $this->ip_model->get_univ_o1('2013/2014','GENAP');
		$data['uni_o2'] = $this->ip_model->get_univ_o2('2013/2014','GENAP');
		$data['uni_o3'] = $this->ip_model->get_univ_o3('2013/2014','GENAP');
		$data['uni_o4'] = $this->ip_model->get_univ_o4('2013/2014','GENAP');
		$data['uni_o5'] = $this->ip_model->get_univ_o5('2013/2014','GENAP');

		/* -- Give PDF Default Name -- */
		$pdf_title = "IP Dosen 2013/2014 GENAP - " . $data['dsn']->nama_dsn; 
		
		/* -- Render Layout -- */
		$data['title'] 		= $pdf_title;
		$data['content'] 	= 'ip/ip/pdf/ip_dosen';
		$data['custom_css'][] 	= 'public/assets/css/pdf-ip-dosen.css';
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}

	function rangkuman($prodi = '') {

		if ($prodi == '') {
			echo 'ops! you cannot do that';
			die;
		}

	    $this->load->helper('pdf_helper');

		$data['list_ip_dosen_prodi'] = $this->ip_model->get_ip_list($prodi,'2013/2014','GENAP');

		/* -- Render Layout -- */
		// $data['title'] 		= "IP Dosen";
		// $data['content'] 	= 'ip/ip/rangkuman';
		// $this->load->view('main/render_layout',$data);

		$data['thn_ajaran']			= '2013/2014';
		$data['periode']			= 'GENAP';
		$data['prodi']				= $this->ip_model->get_info_prodi($prodi);
		// $data['list']				= $list_ip_dosen_prodi;

	    $this->load->view('ip/ip/pdf/pdf_rangkuman_ip_dosen_per_prodi', $data);

		//echo 'horay , you are there champs!';
	}

	function export($prodi = ''){

	$header = $this->set_header();
	$data = array($header);
	     
	$filename  = 'Laporan_User';
	$loop = 0;
	$list = $this->ip_model->get_ip_list($prodi,'2013/2014','GENAP');

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

	function export_to_excel($prodi = ''){

		if ($prodi == '') {
			echo 'ops! you cannot do that';
			die;
		}

		$data['list_ip_dosen_prodi'] = $this->ip_model->get_ip_list($prodi,'2013/2014','GENAP');

		/* -- Render Layout -- */
		// $data['title'] 		= "IP Dosen";
		// $data['content'] 	= 'ip/ip/rangkuman';
		// $this->load->view('main/render_layout',$data);

		$data['thn_ajaran']			= '2013/2014';
		$data['periode']			= 'GENAP';
		$data['prodi']				= $this->ip_model->get_info_prodi($prodi);
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