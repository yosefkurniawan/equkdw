<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_matakuliah extends CI_Model {


	public  function get_total_row_matakuliah($search)
	{
		$unit_id = $search['unit_id'];
		$nama = strtolower($search['nama']);
		$eva_status = $search['eva_status'];

		$sql = "SELECT ec_matkul.kode, ec_matkul.nama, ref_unit.id_unit
				FROM ec_matkul, ref_unit
				WHERE ref_unit.id_unit = ec_matkul.id_unit
				";		
        if ($unit_id != '') {
			$sql .= " AND ec_matkul.id_unit LIKE '$unit_id'";
        }
        if ($nama != '') {
			$sql .= " AND ( LCASE(ec_matkul.nama) LIKE '$nama' OR LCASE(ec_matkul.kode) LIKE '$nama' )";
        }
        if ($eva_status != '') {
			$sql .= " AND ec_matkul.eva_status = '$eva_status'";
        }
        // echo $sql; die;
        $query = $this->db->query($sql);
        return $query->num_rows();
	}

	// getKRS
	public function getListOfProdi()
	{	
		$sql = "SELECT DISTINCT ref_unit.id_unit,ref_unit.unit
				FROM ec_matkul, ref_unit
				WHERE ref_unit.id_unit = ec_matkul.id_unit
				";
        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}

	public function getMatakuliah($start,$limit,$search)
	{	//echo $start;
		//echo $limit;
		//echo $prodi;
		$unit_id = $search['unit_id'];
		$nama = $search['nama'];
		$eva_status = $search['eva_status'];


			$sql = "SELECT ec_matkul.kode, ec_matkul.nama, ref_unit.id_unit, ref_unit.unit, ec_matkul.eva_status
					FROM ec_matkul, ref_unit
					WHERE ref_unit.id_unit = ec_matkul.id_unit";
			        if ($unit_id != '') {
						$sql .= " AND ec_matkul.id_unit LIKE '$unit_id'";
			        }
			        if ($nama != '') {
						$sql .= " AND ( ec_matkul.nama LIKE '$nama' OR ec_matkul.kode LIKE '$nama' )";
			        }
			        if ($eva_status != '') {
						$sql .= " AND ec_matkul.eva_status LIKE '$eva_status'";
			        }
						$sql .= " LIMIT $start, $limit";			

		// echo $sql; die;
        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
	}

	public function gantiStatusMatakuliah($matkul,$status)
	{
		if ($status == 1)
		{
			$insert = array('eva_status' => 0);
		} 
		else 
		{
			$insert = array('eva_status' => 1);
		}


		$this->db->where('kode',$matkul);
		$ins = $this->db->update('ec_matkul',$insert);
		if ($ins) 
		{
			echo "berhasil";
			return true;
		}
		else
		{
			echo "gagal";
			return false;
		}
	}

	public function gantistatus_ajax($param) {
		$kode = $param['kode'];
		$this->db->where('kode',$kode);
		$update = $this->db->update('ec_matkul',$param);
		if ($update) 
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
}