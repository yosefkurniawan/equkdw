<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mahasiswa extends CI_Model {

	// getKRS
	public function getKRS($nim)
	{							
		$sql = "SELECT krs.nim,krs.nama_lengkap,krs.unit,krs.id_unit,krs.id_kelasb,krs.semester,krs.thn_ajaran,krs.kode,
							krs.grup,krs.sks,krs.nama_matkul,krs.eva_status,krs.nama_dosen,krs.jawaban,krs.id_paket,krs.tanggal_pengisian,
							dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, pkt.status
				FROM (SELECT foo.nim,foo.nama_lengkap,foo.unit,foo.id_unit,foo.id_kelasb,foo.semester,foo.thn_ajaran,foo.kode,
							foo.grup,foo.sks,foo.nama_matkul,foo.eva_status,foo.nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban, j.id_paket, j.tanggal_pengisian
		 			FROM (SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
					k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
					FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
					WHERE k.id_kelasb = s.id_kelasb
					AND p.nik = d.nik
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.id_kelasb = p.id_kelasb
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					GROUP BY k.kode) as foo 
					LEFT JOIN eva_jawaban_paket j ON j.id_kelasb = foo.id_kelasb AND j.nim = '$nim'
					GROUP BY foo.kode) as krs, eva_deadline dd, eva_paket pkt
						WHERE krs.id_unit = dd.id_unit
						AND dd.id_paket = pkt.id_paket
						AND dd.id_paket = (SELECT MAX(id_paket) FROM eva_paket)
					";

        $query = $this->db->query($sql);

		//echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}

	// getKRS Testing
	public function getKRSTesting($nim)
	{							
		$sql = "SELECT krs.nim,krs.nama_lengkap,krs.unit,krs.id_unit,krs.id_kelasb,krs.semester,krs.thn_ajaran,krs.kode,
							krs.grup,krs.sks,krs.nama_matkul,krs.eva_status,krs.nama_dosen,krs.jawaban,krs.id_paket,krs.tanggal_pengisian,
							dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, pkt.status
				FROM (SELECT foo.nim,foo.nama_lengkap,foo.unit,foo.id_unit,foo.id_kelasb,foo.semester,foo.thn_ajaran,foo.kode,
							foo.grup,foo.sks,foo.nama_matkul,foo.eva_status,foo.nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban, j.id_paket, j.tanggal_pengisian
		 			FROM (SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
					k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
					FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
					WHERE k.id_kelasb = s.id_kelasb
					AND p.nik = d.nik
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.id_kelasb = p.id_kelasb
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					GROUP BY k.kode) as foo 
					LEFT JOIN eva_jawaban_paket j ON j.id_kelasb = foo.id_kelasb AND j.nim = '$nim'
					GROUP BY foo.kode) as krs, eva_deadline dd, eva_paket pkt
						WHERE krs.id_unit = dd.id_unit
						AND dd.id_paket = pkt.id_paket
						AND dd.id_paket = (SELECT MAX(id_paket) FROM eva_paket)
					";

		$sqlKrs = "SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
					k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
					FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
					WHERE k.id_kelasb = s.id_kelasb
					AND p.nik = d.nik
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.id_kelasb = p.id_kelasb
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					GROUP BY k.kode
					";

/*
		$sqlTry = "SELECT p.nim,mhs.nama_lengkap, r.unit, r.id_unit,
							kb.id_kelasb, 
							kb.kode, mtk.nama as nama_matkul, IFNULL(kb.grup,'-') as grup, mtk.eva_status,
							kb.thn_ajaran, kb.semester,	
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
		 					'-') AS jawaban, j.id_paket, j.tanggal_pengisian
		 			FROM (SELECT * FROM ec_peserta WHERE nim = '$nim') p 
					LEFT JOIN (SELECT * FROM ec_kelas_buka 
									WHERE
					thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
									) kb ON kb.id_kelasb = p.id_kelasb
					LEFT JOIN ec_matkul mtk ON mtk.kode = kb.kode
					LEFT JOIN ec_pengajar pg ON pg.id_kelasb = kb.id_kelasb
					LEFT JOIN user_dosen_karyawan d ON pg.nik = d.nik
					LEFT JOIN user_mhs_alumni mhs ON mhs.nim = p.nim
					LEFT JOIN ref_unit r ON r.id_unit = mhs.id_unit
					LEFT JOIN (SELECT * FROM eva_jawaban_paket WHERE nim = '$nim') j ON j.id_kelasb = kb.id_kelasb 
					GROUP BY kb.id_kelasb
					";
*/

		$sqlPaketJawaban = "SELECT j.id_jawaban,
					IFNULL(
	 					(GROUP_CONCAT(
	 						DISTINCT j.id_jawaban
	 					SEPARATOR ';')
	 					),
	 					'-'
	 				) AS jawaban FROM eva_jawaban_paket j
					WHERE j.id_kelasb = 5442 AND j.nim = '$nim'
					";

		$sqlKrsKuis = "SELECT 
					-- Start: KRS Fields
					krs.nim, krs.nama_lengkap, krs.unit, krs.id_unit, krs.id_kelasb, krs.semester, krs.thn_ajaran, krs.kode,
					krs.grup, krs.sks, krs.nama_matkul, krs.eva_status, krs.nama_dosen,
					-- End: KRS Fields

					j.id_paket,
					dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir

					-- Start: kuisioner fields
					-- IFNULL(
	 			-- 		(GROUP_CONCAT(
	 			-- 			DISTINCT j.id_jawaban
	 			-- 		SEPARATOR ';')
	 			-- 		),
	 			-- 		'-'
	 			-- 	) AS jawaban
					-- End: kuisioner fields
					
					FROM 
					
						-- Start: KRS
						(SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
						k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
						FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
						WHERE k.id_kelasb = s.id_kelasb
						AND p.nik = d.nik
						AND s.nim = u.nim
						AND u.id_unit = r.id_unit
						AND k.id_kelasb = p.id_kelasb
						AND k.kode = m.kode
						AND s.nim = '$nim'
						AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
						AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
						GROUP BY k.kode) as krs
						-- End: KRS

						LEFT JOIN eva_jawaban_paket j ON j.id_kelasb = krs.id_kelasb AND j.nim = '$nim'

						LEFT JOIN eva_deadline dd ON dd.id_unit = krs.id_unit

					";

         $query = $this->db->query($sql);
/*         $query = $this->db->query($sqlTry); */
        // $query = $this->db->query($sqlKrsKuis);

        // $query = $this->db->query($sqlPaketJawaban);

		//echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
	}


	public function getKRS3($nim)
	{
		$sql = "SELECT krs.nim,krs.nama_lengkap,krs.unit,krs.id_unit,krs.id_kelasb,krs.semester,krs.thn_ajaran,krs.kode,
							krs.grup,krs.sks,krs.nama_matkul,krs.eva_status,krs.nama_dosen,krs.jawaban,krs.id_paket,krs.tanggal_pengisian,
							dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, pkt.status
				FROM (SELECT foo.nim,foo.nama_lengkap,foo.unit,foo.id_unit,foo.id_kelasb,foo.semester,foo.thn_ajaran,foo.kode,
							foo.grup,foo.sks,foo.nama_matkul,foo.eva_status,foo.nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban, j.id_paket, j.tanggal_pengisian
		 			FROM (SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
					k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
					FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
					WHERE k.id_kelasb = s.id_kelasb
					AND p.nik = d.nik
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.id_kelasb = p.id_kelasb
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					GROUP BY k.kode) as foo 
					LEFT JOIN eva_jawaban_paket j ON j.id_kelasb = foo.id_kelasb AND j.nim = '$nim'
					GROUP BY foo.kode) as krs, eva_deadline dd, eva_paket pkt
						WHERE krs.id_unit = dd.id_unit
						AND dd.id_paket = pkt.id_paket
					";

		// $sql = "SELECt * FROM eva_jawaban_paket WHERE nim = '$nim'";
	
        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } else {
            return array();
        }		
	}

	public function lihatjawaban($nim)
	{
		$sql = "SELECT * FROM eva_jawaban_paket j,user_dosen_karyawan d WHERE nim = '$nim' AND j.nik = d.nik";

        $query = $this->db->query($sql);

		//echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) 
        {
            return $query->result();
        } else {
            return array();
        }		
	}

	public function getKelasStatus($id_kelasb,$nim)
	{							
		// $sql = "SELECT k.id_kelasb, 
		// 				m.nama AS nama_matkul, m.eva_status AS eva_status, 
		// 				IFNULL(
		// 					(GROUP_CONCAT(DISTINCT
		// 						CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
		// 						d.nama,
		// 						', ',
		// 						d.gelar_suffix) 
		// 					SEPARATOR '; ')
		// 					),
		// 					'-'
		// 				) AS nama_dosen,
		//  				IFNULL(
		//  					(GROUP_CONCAT(
		//  						DISTINCT j.id_jawaban
		//  					SEPARATOR ';')
		//  					),
		//  					'-'
		//  				) AS jawaban,
		// 				dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, j.tanggal_pengisian
		// 				FROM (ec_kelas_buka k LEFT JOIN eva_jawaban_paket j ON k.id_kelasb = j.id_kelasb AND j.nim = '$nim'), ec_matkul m, 
		// 					user_dosen_karyawan d, ec_pengajar p, ec_peserta s, ref_unit r, eva_paket pkt, eva_deadline dd
		// 				WHERE k.kode = m.kode
		// 				AND k.id_kelasb = '$id_kelasb'
		// 				AND d.id_unit = r.id_unit
		// 				AND dd.id_unit = r.id_unit
		// 				AND pkt.id_paket = dd.id_paket 
		// 				AND k.id_kelasb = p.id_kelasb
		// 				AND k.aktif = 1	
		// 				AND p.nik = d.nik
		// 				AND s.nim = '$nim'
		// 				AND k.id_kelasb = s.id_kelasb
		// 				AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
		// 					as thn_ajaran FROM ec_kelas_buka))
		// 				AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) 
		// 					as thn_ajaran FROM ec_kelas_buka))
		// 				GROUP BY k.id_kelasb, nama_matkul 
		// 				ORDER BY k.kode
		// 				";

		$sql = "SELECT krs.nim,krs.nama_lengkap,krs.unit,krs.id_unit,krs.id_kelasb,krs.semester,krs.thn_ajaran,krs.kode,
							krs.grup,krs.sks,krs.nama_matkul,krs.eva_status,krs.nama_dosen,krs.jawaban,krs.id_paket,krs.tanggal_pengisian,
							dd.tgl_mulai AS mulai, dd.tgl_akhir AS akhir, pkt.status
				FROM (SELECT foo.nim,foo.nama_lengkap,foo.unit,foo.id_unit,foo.id_kelasb,foo.semester,foo.thn_ajaran,foo.kode,
							foo.grup,foo.sks,foo.nama_matkul,foo.eva_status,foo.nama_dosen,
		 				IFNULL(
		 					(GROUP_CONCAT(
		 						DISTINCT j.id_jawaban
		 					SEPARATOR ';')
		 					),
		 					'-'
		 				) AS jawaban, j.id_paket, j.tanggal_pengisian
		 			FROM (SELECT s.nim, u.nama_lengkap, r.unit, r.id_unit,
					k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, m.nama AS nama_matkul, m.eva_status, 
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
					FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r, ec_pengajar p, user_dosen_karyawan d
					WHERE k.id_kelasb = s.id_kelasb
					AND k.id_kelasb = '$id_kelasb'
					AND p.nik = d.nik
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.id_kelasb = p.id_kelasb
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					GROUP BY k.kode) as foo 
					LEFT JOIN eva_jawaban_paket j ON j.id_kelasb = foo.id_kelasb AND j.nim = '$nim'
					GROUP BY foo.kode) as krs, eva_deadline dd, eva_paket pkt
						WHERE krs.id_unit = dd.id_unit
						AND dd.id_paket = pkt.id_paket
						AND dd.id_paket = (SELECT MAX(id_paket) FROM eva_paket)
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

		//echo '<pre>'; print_r($query->result()); die;

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

	public function getStatusPengisianMahasiswa()
	{
		$sql = "SELECT mhs.nim,mhs.nama_lengkap,mhs.unit,mhs.matakuliah_diambil,mhs.matakuliah_berkuisioner,mhs.kuisioner_terisi,h.hadiah FROM (SELECT foo.nim, foo.nama_lengkap, foo.unit, COUNT(foo.nama_matkul) as matakuliah_diambil, 
						SUM(foo.eva_status) as matakuliah_berkuisioner, COUNT(j.id_jawaban) as kuisioner_terisi 
					FROM (SELECT s.nim, u.nama_lengkap, r.unit, k.id_kelasb, m.nama AS nama_matkul, m.eva_status FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r
					WHERE k.id_kelasb = s.id_kelasb
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.kode = m.kode
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))) as foo
					LEFT JOIN (SELECT p.id_jawaban,p.nim,p.nik,p.id_kelasb FROM eva_jawaban_paket p GROUP BY nim, id_kelasb) as j ON foo.id_kelasb = j.id_kelasb AND foo.nim = j.nim
					GROUP BY nim) as mhs LEFT JOIN eva_hadiah h ON mhs.nim = h.nim
					";

        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }		
	}

	public function getStatusPengisianMahasiswaIndividu($nim)
	{
		$sql = "SELECT mhs.nim,mhs.nama_lengkap,mhs.unit,mhs.matakuliah_diambil,mhs.matakuliah_berkuisioner,mhs.kuisioner_terisi,h.hadiah FROM (SELECT foo.nim, foo.nama_lengkap, foo.unit, COUNT(foo.nama_matkul) as matakuliah_diambil, 
						SUM(foo.eva_status) as matakuliah_berkuisioner, COUNT(j.id_jawaban) as kuisioner_terisi 
					FROM (SELECT s.nim, u.nama_lengkap, r.unit, k.id_kelasb, m.nama AS nama_matkul, m.eva_status FROM ec_peserta s, ec_kelas_buka k, ec_matkul m, user_mhs_alumni u, ref_unit r
					WHERE k.id_kelasb = s.id_kelasb
					AND s.nim = u.nim
					AND u.id_unit = r.id_unit
					AND k.kode = m.kode
					AND s.nim = '$nim'
					AND k.thn_ajaran = (SELECT MAX(thn_ajaran) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))
					AND k.semester = (SELECT MAX(semester) FROM ec_kelas_buka WHERE thn_ajaran = (SELECT MAX(thn_ajaran) as thn_ajaran FROM ec_kelas_buka))) as foo
					LEFT JOIN (SELECT p.id_jawaban,p.nim,p.nik,p.id_kelasb FROM eva_jawaban_paket p GROUP BY nim, id_kelasb) as j ON foo.id_kelasb = j.id_kelasb AND foo.nim = j.nim
					GROUP BY nim) as mhs LEFT JOIN eva_hadiah h ON mhs.nim = h.nim
					";

        $query = $this->db->query($sql);

		// echo '<pre>'; print_r($query->result()); die;

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }		
	}


	public function get_mahasiswa($nim) {
		$this->db->where('nim',$nim);
		$query = $this->db->get('user_mhs_alumni');
		if ($query->num_rows == 1) {
			return $query->row_array();
		} else {
			return array();
		}
	}

	public function get_list_mhs_no_id() {
		$this->db->where('angkatan','2014');
/* 		$this->db->where('id_unit',''); */
		$query = $this->db->get('user_mhs_alumni');
		if ($query->num_rows > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}


	public function get_peserta($nim) {
		$this->db->where('nim',$nim);
		$query = $this->db->get('ec_peserta');
		if ($query->num_rows > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
	
	public function update_mhs($params,$nim) {
		$this->db->where('nim',$nim);
		$query = $this->db->update('user_mhs_alumni',$params);
		if ($query) {
			return true;
		} else {
			return false;
		}
		
	}
	
	
}
