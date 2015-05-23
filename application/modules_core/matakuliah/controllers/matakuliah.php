<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		#give default timezone
		date_default_timezone_set('Asia/Jakarta');

		# checking whether logged in or not
		if (!isset($this->session->userdata['is_admin']) || !$this->session->userdata['is_admin'] ) {
			redirect('main/page404');	
		} 

		$this->load->model('matakuliah/m_matakuliah');
		// $this->load->model('m_laporan');
	}

	public function index()
	{
		redirect('matakuliah/daftar');
	}

	public function daftar($page = 0)
	{
        // get search parameter
        $search = $this->session->userdata('matakuliah_search');
        if (!empty($search)) {
            $data['search'] = $search;

	        // $unit_id = empty($search['unit_id']) ? '%' : '%' . $search['unit_id'] . '%';
	        // $nama = empty($search['nama']) ? '%' : '%' . $search['nama'] . '%';
	        // $eva_status = empty($search['eva_status']) ? '%' : '%' . $search['eva_status'] . '%';

	        $params = array(
	            "unit_id" => $search['unit_id'],
	            "nama" => '%'.$search['nama'].'%',
	            "eva_status" => $search['eva_status'],

	        	);



	        // print_r($params);die;

        } else {
	        $params = array(
	            "unit_id" => '',
	            "nama" => '',
	            "eva_status" => '',
	        );        	
            $data['search'] = $params;
        }
        // search parameters
        // print_r($params);die;
		// fetch data kamar
		$data['tot_matakuliah']	= $this->m_matakuliah->get_total_row_matakuliah($params);

		// pagination start
		$data['start'] = $this->uri->segment(3);
		// pagination
		$config['base_url']			= base_url().'matakuliah/daftar/';
		$config['total_rows']		= $data['tot_matakuliah'];
		$config['per_page']			= 10;
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
		// get user list
		$list_matkul = $this->m_matakuliah->getMatakuliah(intval($page), $config['per_page'],$params);

		// if ($prodi == NULL)
		// {
		// 	// tampilkan semua matakuliah
		// 	$list_matkul = $this->m_matakuliah->getMatakuliah();			
		// }
		// else
		// {
		// 	$list_matkul = $this->m_matakuliah->getMatakuliah($prodi);						
		// }

		/* -- Render Layout -- */
		// $data['left_bar']		= 'mahasiswa/left_bar_jawab';
		// $data['message']	= $this->session->flashdata('message');
		$data['list_matkul']	= $list_matkul;
		$data['list_prodi']		= $this->m_matakuliah->getListOfProdi();
		
		// $data['thn_ajaran']	= $thn_ajaran;
		$data['title'] 		= 'Konfigurasi Matakuliah';
		$data['content'] 	= 'matakuliah/daftar_matakuliah';
		$this->load->view('main/render_layout',$data);				
	}

    public function proses_cari() {
    	// echo "<pre>"; print_r($this->input->post());die;
        // data
        if ($this->input->post('save') == "Reset") {
            // $this->tsession->unset_userdata('aircraft_search');
			 $this->session->unset_userdata('matakuliah_search');
        } else {
            $params = array(
                "unit_id" => $this->input->post("unit_id"),
                "nama" => $this->input->post("nama"),
                "eva_status" => $this->input->post("eva_status"),
            );
			 $this->session->set_userdata('matakuliah_search',$params);
            // $this->tsession->set_userdata("aircraft_search", $params);
        }
        // redirect
        redirect("matakuliah/matakuliah");
    }


	public function prodi($prodi = NULL)
	{
		if ($prodi == NULL)
		{
			// tampilkan semua matakuliah
			$list_matkul = $this->m_matakuliah->getMatakuliah();			
		}
		else
		{
			$list_matkul = $this->m_matakuliah->getMatakuliah($prodi);						
		}

		/* -- Render Layout -- */
		$data['left_bar']		= 'mahasiswa/left_bar_jawab';
		// $data['message']	= $this->session->flashdata('message');
		$data['list_matkul']	= $list_matkul;
		$data['list_prodi']		= $this->m_matakuliah->getListOfProdi();
		
		// $data['thn_ajaran']	= $thn_ajaran;
		$data['title'] 		= 'Konfigurasi Matakuliah';
		$data['content'] 	= 'matakuliah/daftar_matakuliah';
		$this->load->view('main/render_layout',$data);				
	}

	public function gantistatus($matkul,$status)
	{
		$this->m_matakuliah->gantiStatusMatakuliah($matkul,$status);
		redirect('matakuliah');
	}

	public function gantistatus_ajax()
	{
		foreach ($_POST as $value => $val) 
		{
			// $insert = $this->m_igd->save_catatan_care($val);
			$query = $this->m_matakuliah->gantistatus_ajax($val);
		}

		//masukan ke tabel siswa
		header('Content-Type: application/json');
	    echo json_encode($query);		
	}
}

/* End of file laporan.php */
/* Location: ./application/modules_core/laporan/controllers/laporan.php */