<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_matakuliah extends CI_Model {

	// getKRS
	public function getMatakuliah($prodi = NULL)
	{	
		if ($prodi != NULL)
		{
			$sql = "SELECT ec_matkul.kode, ec_matkul.nama, ref_unit.id_unit, ref_unit.unit, ec_matkul.eva_status
					FROM ec_matkul, ref_unit
					WHERE ec_matkul.id_unit = $prodi AND ref_unit.id_unit = ec_matkul.id_unit
					";
		}
		else
		{
			$sql = "SELECT ec_matkul.kode,ec_matkul.nama,ref_unit.id_unit,ref_unit.unit,ec_matkul.eva_status
					FROM ec_matkul, ref_unit
					WHERE ref_unit.id_unit = ec_matkul.id_unit
					";

		}

        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
	}
}