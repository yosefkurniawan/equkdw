<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kuisioner extends CI_Model {

	// getKRS
	public function getPertanyaan()
	{							
		$sql = "SELECT pkt.id_paket AS kode, thn_ajaran AS tahun, semester, isi_pertanyaan AS pertanyaan, urutan AS no, pty.keterangan AS keterangan, r.keterangan AS aspek
				FROM eva_paket pkt , eva_pertanyaan pty, eva_ref_aspek r
				where pkt.id_paket = pty.id_paket
				AND pty.id_aspek = r.id_aspek
				AND pkt.thn_ajaran = (SELECT MAX(thn_ajaran) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM eva_paket))
				AND pkt.semester = (SELECT MAX(semester) FROM eva_paket WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM eva_paket))
				AND pkt.status = 'public'
				ORDER BY pty.id_aspek, urutan
				";


        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}

	public function save_evaluasi($data)
	{
		
		$save = $this->db->insert('eva_jawaban_paket',$data);
		if ($save) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}