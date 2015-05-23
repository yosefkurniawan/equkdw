<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_laporan_matkul extends CI_Model {

	function getSqlLatestSemester() {
	 	return "(SELECT MAX(semester) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
	}

	function getSqlLatestThnAjaran() {
		return "(SELECT MAX(thn_ajaran) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
	}

	public function getMatakuliah_tot($params) {	
		
		$nama = $params['nama'];
		$unit_id = $params['unit_id'];

		$filter_nama = $params['nama'];
		$filter_unit = $params['unit_id'];
		
		if ($nama != '') {
			$filter_nama = "AND m.nama LIKE '$nama'";
		}
		
		if ($unit_id != '') {
			$filter_unit = "AND m.id_unit = '$unit_id'";
		}
		
		$sql = "SELECT m.kode, m.nama, u.id_unit, u.unit, k.semester, k.thn_ajaran, k.grup, jwb.id_paket, COUNT(p.id_peserta) as jml_peserta, jwb.terisi
				FROM (SELECT * FROM ec_matkul WHERE eva_status = 1) m
				INNER JOIN ref_unit u ON u.id_unit = m.id_unit
				INNER JOIN ec_kelas_buka k ON k.kode = m.kode 
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
				LEFT JOIN ec_peserta p ON p.id_kelasb = k.id_kelasb
				LEFT JOIN (SELECT pkt.id_paket, j.id_kelasb, COUNT(j.nim) as terisi, pkt.semester, pkt.thn_ajaran
					FROM eva_paket pkt
					LEFT JOIN (SELECT * FROM eva_jawaban_paket ejp GROUP BY ejp.id_kelasb, ejp.nim) j ON j.id_paket = pkt.id_paket
					GROUP BY pkt.id_paket, j.id_kelasb) as jwb ON jwb.id_kelasb = k.id_kelasb AND jwb.semester = k.semester AND jwb.thn_ajaran = k.thn_ajaran
				WHERE 1 = 1
				$filter_nama
				$filter_unit
				GROUP BY m.kode, m.nama, u.id_unit, u.unit, m.eva_status, k.semester, k.thn_ajaran, k.grup
				";

        $query = $this->db->query($sql);
        return $query->num_rows();
	}

	public function getMatakuliah($start,$limit,$params) {	
		
		$nama = $params['nama'];
		$unit_id = $params['unit_id'];

		$filter_nama = $params['nama'];
		$filter_unit = $params['unit_id'];
		
		if ($nama != '') {
			$filter_nama = "AND m.nama LIKE '$nama'";
		}
		
		if ($unit_id != '') {
			$filter_unit = "AND m.id_unit = '$unit_id'";
		}
		
		
		$sql = "SELECT m.kode, m.nama, u.id_unit, u.unit, k.semester, k.thn_ajaran, k.grup, jwb.id_paket, COUNT(p.id_peserta) as jml_peserta, jwb.terisi
				FROM (SELECT * FROM ec_matkul WHERE eva_status = 1) m
				INNER JOIN ref_unit u ON u.id_unit = m.id_unit
				INNER JOIN ec_kelas_buka k ON k.kode = m.kode 
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
				LEFT JOIN ec_peserta p ON p.id_kelasb = k.id_kelasb
				LEFT JOIN (SELECT pkt.id_paket, j.id_kelasb, COUNT(j.nim) as terisi, pkt.semester, pkt.thn_ajaran
					FROM eva_paket pkt
					LEFT JOIN (SELECT * FROM eva_jawaban_paket ejp GROUP BY ejp.id_kelasb, ejp.nim) j ON j.id_paket = pkt.id_paket
					GROUP BY pkt.id_paket, j.id_kelasb) as jwb ON jwb.id_kelasb = k.id_kelasb AND jwb.semester = k.semester AND jwb.thn_ajaran = k.thn_ajaran
				WHERE 1 = 1
				$filter_nama
				$filter_unit
				GROUP BY m.kode, m.nama, u.id_unit, u.unit, m.eva_status, k.semester, k.thn_ajaran, k.grup
				LIMIT $start, $limit
				";

        $query = $this->db->query($sql);

        //echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
	}

	public function getMatakuliahRangkumanLaporan($unit_id='',$id_paket='') {	

		$filter_unit = '';

		if ($id_paket != '') {
			$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
			$query = $this->db->query($sql_latest_paket);
			$semester 	= "'".$query->row()->semester."'";
			$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		}
		else{
			$semester = $this->getSqlLatestSemester();		
			$thn_ajaran = $this->getSqlLatestThnAjaran();
			/*
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			*/
		}

		if ($unit_id != '') {
			$filter_unit = "AND m.id_unit = '$unit_id'";
		}
																
		$sql = "SELECT 
				x.*,
				IF( ((x.terisi/x.jml_peserta) = 1) ,'x','')'seratus_persen',				
				IF( ((x.terisi/x.jml_peserta) >= 0.9 ) AND ((x.terisi/x.jml_peserta) < 1) ,'x','')'sembilanpuluh_persen',				
				IF( ((x.terisi/x.jml_peserta) >= 0.8 ) AND ((x.terisi/x.jml_peserta) < 0.9) ,'x','')'delapanpuluh_persen',				
				IF( ((x.terisi/x.jml_peserta) >= 0.7 ) AND ((x.terisi/x.jml_peserta) < 0.8) ,'x','')'tujuhpuluh_persen',				
				IF( ((x.terisi/x.jml_peserta) < 0.7 ) ,'x','')'dibawah_persen',				
				IF( (x.terisi = 0 ) AND (x.jml_peserta = 0 ) ,'x','')'nol_persen'				
				FROM 
				(SELECT m.kode, m.nama, u.id_unit, u.unit, k.semester, k.thn_ajaran, k.grup, jwb.id_paket, IFNULL(COUNT(p.id_peserta),'0') as jml_peserta, IFNULL(jwb.terisi,'0')'terisi' 
				FROM (SELECT * FROM ec_matkul WHERE eva_status = 1) m
				INNER JOIN ref_unit u ON u.id_unit = m.id_unit
				INNER JOIN ec_kelas_buka k ON k.kode = m.kode 
					AND k.thn_ajaran = $thn_ajaran
					AND k.semester = $semester
				LEFT JOIN ec_peserta p ON p.id_kelasb = k.id_kelasb
				LEFT JOIN (SELECT pkt.id_paket, j.id_kelasb, COUNT(j.nim) as terisi, pkt.semester, pkt.thn_ajaran
					FROM eva_paket pkt
					LEFT JOIN (SELECT * FROM eva_jawaban_paket ejp GROUP BY ejp.id_kelasb, ejp.nim) j ON j.id_paket = pkt.id_paket
					GROUP BY pkt.id_paket, j.id_kelasb) as jwb ON jwb.id_kelasb = k.id_kelasb AND jwb.semester = k.semester AND jwb.thn_ajaran = k.thn_ajaran
				WHERE 1 = 1
				$filter_unit
				GROUP BY m.kode, m.nama, u.id_unit, u.unit, m.eva_status, k.semester, k.thn_ajaran, k.grup) x
				";

        $query = $this->db->query($sql);

/* 		echo '<pre>'; print_r($query->result()); die; */

        return $query->result_array();
	}


	public function getMatakuliahOverview($unit_id='',$id_paket='') {	
		

		$filter_unit = '';

		if ($id_paket != '') {
			$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
			$query = $this->db->query($sql_latest_paket);
			$semester 	= "'".$query->row()->semester."'";
			$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		}
		else{
			$semester = $this->getSqlLatestSemester();		
			$thn_ajaran = $this->getSqlLatestThnAjaran();
			/*
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			*/
		}

		if ($unit_id != '') {
			$filter_unit = "AND m.id_unit = '$unit_id'";
		}
																
		$sql = "SELECT 
				count(x.terisi)'total',
				sum(case when (x.terisi/x.jml_peserta) = 1 THEN 1 ELSE 0 END)'seratus_persen',					
				sum(case when ( ((x.terisi/x.jml_peserta) >= 0.9 ) AND ((x.terisi/x.jml_peserta) < 1) ) THEN 1 ELSE 0 END)'sembilanpuluh_persen',					
				sum(case when ( ((x.terisi/x.jml_peserta) >= 0.8 ) AND ((x.terisi/x.jml_peserta) < 0.9) ) THEN 1 ELSE 0 END)'delapanpuluh_persen',					
				sum(case when ( ((x.terisi/x.jml_peserta) >= 0.7 ) AND ((x.terisi/x.jml_peserta) < 0.8) ) THEN 1 ELSE 0 END)'tujuhpuluh_persen',					
				sum(case when ( (x.terisi/x.jml_peserta) < 0.7 ) THEN 1 ELSE 0 END)'dibawah_persen',					
				sum(case when ( (x.terisi = 0 ) AND (x.jml_peserta = 0 ))  THEN 1 ELSE 0 END)'nol_persen'									
				FROM 
				(SELECT m.kode, m.nama, u.id_unit, u.unit, k.semester, k.thn_ajaran, k.grup, jwb.id_paket, IFNULL(COUNT(p.id_peserta),'0') as jml_peserta, IFNULL(jwb.terisi,'0')'terisi' 
				FROM (SELECT * FROM ec_matkul WHERE eva_status = 1) m
				INNER JOIN ref_unit u ON u.id_unit = m.id_unit
				INNER JOIN ec_kelas_buka k ON k.kode = m.kode 
					AND k.thn_ajaran = $thn_ajaran
					AND k.semester = $semester
				LEFT JOIN ec_peserta p ON p.id_kelasb = k.id_kelasb
				LEFT JOIN (SELECT pkt.id_paket, j.id_kelasb, COUNT(j.nim) as terisi, pkt.semester, pkt.thn_ajaran
					FROM eva_paket pkt
					LEFT JOIN (SELECT * FROM eva_jawaban_paket ejp GROUP BY ejp.id_kelasb, ejp.nim) j ON j.id_paket = pkt.id_paket
					GROUP BY pkt.id_paket, j.id_kelasb) as jwb ON jwb.id_kelasb = k.id_kelasb AND jwb.semester = k.semester AND jwb.thn_ajaran = k.thn_ajaran
				WHERE 1 = 1
				$filter_unit
				GROUP BY m.kode, m.nama, u.id_unit, u.unit, m.eva_status, k.semester, k.thn_ajaran, k.grup) x
				";

        $query = $this->db->query($sql);

/* 		echo '<pre>'; print_r($query->result()); die; */

        return $query->row_array();
	}

	public function getPeserta($kode,$grup) {
		$sql = "SELECT k.id_kelasb, u.nim, u.nama_lengkap, j.id_jawaban FROM
				(SELECT id_kelasb FROM ec_kelas_buka kb WHERE kb.kode = '$kode' AND kb.grup = '$grup'
					AND kb.thn_ajaran = (SELECT MAX(thn_ajaran) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND kb.semester = (SELECT MAX(semester) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))) k
					INNER JOIN ec_peserta p ON k.id_kelasb = p.id_kelasb
					LEFT JOIN user_mhs_alumni u ON u.nim = p.nim
					LEFT JOIN eva_jawaban_paket j ON j.nim = p.nim AND j.id_kelasb = k.id_kelasb
					GROUP BY k.id_kelasb, u.nim ";

		// $sql = "SELECT p.nim FROM ec_peserta p
		// 		INNER JOIN ec_kelas_buka kb WHERE kb.kode = '$kode' AND kb.grup = '$grup' AND kb.id_kelasb = p.id_kelasb";
        $query = $this->db->query($sql);
        return $query->result_array();
        //echo '<pre>'; print_r($query->result()); die;
	}
	
	public function get_mtk_overview($id_unit='',$id_paket='') {
	
		if ($id_paket != '') {
			$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
			$query = $this->db->query($sql_latest_paket);
			$semester 	= "'".$query->row()->semester."'";
			$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		}
		else{
			$semester = $this->getSqlLatestSemester();		
			$thn_ajaran = $this->getSqlLatestThnAjaran();
			/*
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			*/
		}

		$sql = "SELECT k.kode, m.id_unit, m.eva_status, 
				count(k.kode)'jumlah_matakuliah',
				sum(case when m.eva_status = 0 THEN 1 ELSE 0 END)'mtk_tdk_berkuis',
				sum(case when m.eva_status = 1 THEN 1 ELSE 0 END)'mtk_berkuis',
				sum(case when m.eva_status = 2 THEN 1 ELSE 0 END)'mtk_berkuis_tdk_wajib'
				FROM ec_kelas_buka k
				LEFT JOIN ec_matkul m ON k.kode = m.kode
				WHERE k.semester = $semester
				AND k.thn_ajaran = $thn_ajaran";
		if ($id_unit != '') {
			$sql .= " AND m.id_unit = '$id_unit'";
		} 
        $query = $this->db->query($sql);
/*         echo "<pre>"; print_r($query->result_array());die; */
        return $query->row_array();
	}	
	
	public function getUnitList($id_paket='') {

		if ($id_paket != '') {
			$sql_latest_paket = "SELECT * FROM eva_paket WHERE id_paket = '$id_paket' ORDER BY thn_ajaran DESC, semester DESC, id_paket DESC";		
			$query = $this->db->query($sql_latest_paket);
			$semester 	= "'".$query->row()->semester."'";
			$thn_ajaran	= "'".$query->row()->thn_ajaran."'";
		}
		else{
			$semester = $this->getSqlLatestSemester();		
			$thn_ajaran = $this->getSqlLatestThnAjaran();
			/*
			$semester 	= "(SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			$thn_ajaran = "(SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) AS thn_ajaran FROM ec_kelas_buka))";
			*/
		}

		$sql = "SELECT u.id_unit, u.unit
				FROM ec_kelas_buka k
				LEFT JOIN ec_matkul m ON k.kode = m.kode
				LEFT JOIN ref_unit u ON u.id_unit = m.id_unit
				WHERE k.semester = $semester
				AND k.thn_ajaran = $thn_ajaran
				GROUP BY u.id_unit ASC";
			$query = $this->db->query($sql);
			return $query->result_array();			
	}

	public function getUnitInfo($id_unit) {

		$sql = "SELECT * FROM ref_unit WHERE id_unit = '$id_unit'";
			$query = $this->db->query($sql);
			return $query->row_array();			
	}
	
	
}