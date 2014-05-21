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

	public function getJawabanMahasiswa($id_kelasb,$nim)
	{
		// $sql = "SELECT * FROM eva_jawaban_paket WHERE id_kelasb = $id_kelasb AND nim = $nim";

		$sql = "SELECT k.id_kelasb, d.nik, CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
					d.nama,IF(IFNULL(d.gelar_suffix,'NULL')='NULL','',CONCAT(', ',d.gelar_suffix)))
					AS nama_dosen, a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,masukan_dosen,masukan_matkul
				FROM ec_kelas_buka k, user_dosen_karyawan d, ec_pengajar p, eva_jawaban_paket j
				WHERE k.id_kelasb = p.id_kelasb
				AND j.nik = d.nik
				AND p.nik = d.nik
				AND j.nim = '$nim'
				AND k.id_kelasb = '$id_kelasb'";

        $query = $this->db->query($sql);

        // echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }		
	}
}