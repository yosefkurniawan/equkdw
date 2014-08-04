<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ip extends MX_Controller
{

	function index(){
		$this->load->model('ip_model');
		// $data['period'] = $this->ip_model->get_thn_ajaran_periode();

		// $data['dosen'] = $this->ip_model->updt_kelass_all();

		$data['dosen'] = $this->ip_model->get_dosen_list('2013/2014','GENAP');
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

		$this->load->model('ip_model');
		$data['ajar'] = $this->ip_model->get_dosen_ajar($nik,'2013/2014','GENAP');

		$data['dsn'] = $this->ip_model->get_dosen_info($nik);

		$prodi = $data['dsn']->prodi;
		// echo $prodi;die;
		//query q1
		$data['prodi_o1'] = $this->ip_model->get_prodi_o1($prodi,'2013/2014','GENAP');
		$data['prodi_o2'] = $this->ip_model->get_prodi_o2($prodi,'2013/2014','GENAP');
		$data['prodi_o3'] = $this->ip_model->get_prodi_o3($prodi,'2013/2014','GENAP');
		$data['prodi_o4'] = $this->ip_model->get_prodi_o4($prodi,'2013/2014','GENAP');
		$data['prodi_o5'] = $this->ip_model->get_prodi_o5($prodi,'2013/2014','GENAP');

		$data['uni_o1'] = $this->ip_model->get_univ_o1('2013/2014','GENAP');
		$data['uni_o2'] = $this->ip_model->get_univ_o2('2013/2014','GENAP');
		$data['uni_o3'] = $this->ip_model->get_univ_o3('2013/2014','GENAP');
		$data['uni_o4'] = $this->ip_model->get_univ_o4('2013/2014','GENAP');
		$data['uni_o5'] = $this->ip_model->get_univ_o5('2013/2014','GENAP');

		
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