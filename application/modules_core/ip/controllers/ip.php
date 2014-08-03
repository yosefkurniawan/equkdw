<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ip extends MX_Controller
{

	function index(){
		$this->load->model('ip_model');
		// $data['period'] = $this->ip_model->get_thn_ajaran_periode();
		$data['dosen'] = $this->ip_model->get_dosen_list('2012/2013','GASAL');
		// $this->load->view('ip/ip/list',$data);

		/* -- Render Layout -- */
		$data['title'] 		= "IP Dosen";
		$data['content'] 	= 'ip/ip/list';
		$this->load->view('main/render_layout',$data);
	}

	function laporan() {
		// foreach ($_POST as $value) {
		// 	$html = $value['isi'];
		// }
		$html = '<img width="250px" src="'+$_GET['param']+'">';
		// $html = $_GET['param'];

		// $html = '<p>Hello There</p>';
		$this->load->library('mpdf');
		$this->mpdf->WriteHTML($html);
		$this->mpdf->Output('MyPDF.pdf', 'D');
		die();
	}

	function detail_dosen_pdf($nik = NULL){
		
		/* -- Render Layout -- */
		$data['title'] 		= "IP Dosen";
		$data['content'] 	= 'ip/ip/pdf/ip_dosen';
		$data['custom_css'][] 	= 'public/assets/css/pdf-ip-dosen.css';
   		// $data['custom_js'][] 	= 'public/assets/js/pinaple-soal-tambahan.js';
		// $data['active']		= 'hasil evaluasi';
		$this->load->view('main/render_layout',$data);
	}
}

/* End of file role.php */
/* Location: ./application/modules_core/admin/controllers/role.php */