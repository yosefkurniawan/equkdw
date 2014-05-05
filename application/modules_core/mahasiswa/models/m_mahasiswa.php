<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mahasiswa extends CI_Model {

	// getKRS
	public function getKRS($nim)
	{							
		$sql = "SELECT k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, 
						IF(k.diadakan_hari='','-',k.diadakan_hari) as hari, TIME_FORMAT(k.waktu_mulai,'%H:%i') as jam_awal, 
						TIME_FORMAT(k.waktu_selesai,'%H:%i') as jam_akhir, k.diadakan_hari_2, TIME_FORMAT(k.waktu_mulai_2,'%H:%i') as jam_awal2, 
						TIME_FORMAT(k.waktu_selesai_2,'%H:%i') as jam_akhir2, m.nama AS nama_matkul, m.eva_status AS eva_status, 
						IFNULL(
							(GROUP_CONCAT(DISTINCT
								CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
								d.nama,
								', ',
								d.gelar_suffix) 
							SEPARATOR '; ')
							),
							'-'
						) AS nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban,
						r.unit AS prodi, dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, pkt.status, j.tanggal_pengisian
						FROM (ec_kelas_buka k LEFT JOIN eva_jawaban_paket j ON k.id_kelasb = j.id_kelasb AND j.nim = '$nim'), ec_matkul m, 
							user_dosen_karyawan d, ec_pengajar p, ec_peserta s, ref_unit r, eva_paket pkt, eva_deadline dd
						WHERE k.kode = m.kode
						AND d.id_unit = r.id_unit
						AND dd.id_unit = r.id_unit
						AND pkt.id_paket = dd.id_paket 
						AND k.id_kelasb = p.id_kelasb
						AND k.aktif = 1	
						AND p.nik = d.nik
						AND s.nim = '$nim'
						AND k.id_kelasb = s.id_kelasb
						AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
							as thn_ajaran FROM ec_kelas_buka))
						AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
							as thn_ajaran FROM ec_kelas_buka))
						GROUP BY k.id_kelasb, k.semester, k.thn_ajaran, k.kode, grup, m.sks, hari, jam_awal, jam_akhir, 
							k.diadakan_hari_2, jam_awal2, jam_akhir2, nama_matkul 
						ORDER BY k.kode
						";

        $query = $this->db->query($sql);

		//echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}

	public function getKelasStatus($id_kelasb,$nim)
	{							
		$sql = "SELECT k.id_kelasb, 
						m.nama AS nama_matkul, m.eva_status AS eva_status, 
						IFNULL(
							(GROUP_CONCAT(DISTINCT
								CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
								d.nama,
								', ',
								d.gelar_suffix) 
							SEPARATOR '; ')
							),
							'-'
						) AS nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban,
						dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, j.tanggal_pengisian
						FROM (ec_kelas_buka k LEFT JOIN eva_jawaban_paket j ON k.id_kelasb = j.id_kelasb AND j.nim = '$nim'), ec_matkul m, 
							user_dosen_karyawan d, ec_pengajar p, ec_peserta s, ref_unit r, eva_paket pkt, eva_deadline dd
						WHERE k.kode = m.kode
						AND k.id_kelasb = '$id_kelasb'
						AND d.id_unit = r.id_unit
						AND dd.id_unit = r.id_unit
						AND pkt.id_paket = dd.id_paket 
						AND k.id_kelasb = p.id_kelasb
						AND k.aktif = 1	
						AND p.nik = d.nik
						AND s.nim = '$nim'
						AND k.id_kelasb = s.id_kelasb
						AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
							as thn_ajaran FROM ec_kelas_buka))
						AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
							as thn_ajaran FROM ec_kelas_buka))
						GROUP BY k.id_kelasb, nama_matkul 
						ORDER BY k.kode
						";

        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
	}

	public function getKelas($id_kelasb)
	{
		$sql = "SELECT k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, 
					IF(k.diadakan_hari='','-',k.diadakan_hari) as hari, TIME_FORMAT(k.waktu_mulai,'%H:%i') as jam_awal, 
					TIME_FORMAT(k.waktu_selesai,'%H:%i') as jam_akhir, k.diadakan_hari_2, TIME_FORMAT(k.waktu_mulai_2,'%H:%i') as jam_awal2, 
					TIME_FORMAT(k.waktu_selesai_2,'%H:%i') as jam_akhir2, m.nama AS nama_matkul, m.eva_status AS eva_status, 
					IFNULL(
						(GROUP_CONCAT(DISTINCT
							CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
							d.nama,
							', ',
							d.gelar_suffix) 
						SEPARATOR '; ')
						),
						'-'
					) AS nama_dosen
				FROM ec_kelas_buka k, ec_matkul m, user_dosen_karyawan d, ec_pengajar p
				WHERE k.id_kelasb = p.id_kelasb
				AND k.kode = m.kode
				AND p.nik = d.nik
				AND k.id_kelasb = '$id_kelasb'
				GROUP BY k.id_kelasb";

        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
	}

	public function getDosenKelas($id_kelasb)
	{
		$sql = "SELECT k.id_kelasb, d.nik, CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
					d.nama,IF(IFNULL(d.gelar_suffix,'NULL')='NULL','',CONCAT(', ',d.gelar_suffix)))
					AS nama_dosen
				FROM ec_kelas_buka k, user_dosen_karyawan d, ec_pengajar p
				WHERE k.id_kelasb = p.id_kelasb
				AND p.nik = d.nik
				AND k.id_kelasb = '$id_kelasb'";

        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}

	public function getTahun()
	{
		$sql = "SELECT k.semester, k.thn_ajaran
			FROM ec_kelas_buka k 
			WHERE
			k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
				as thn_ajaran FROM ec_kelas_buka))
			AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
				as thn_ajaran FROM ec_kelas_buka))
			";		
       
        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }			
	}
}

