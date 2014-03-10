<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{
	public function getKRS($username){
		$sms_aktif 			= $this->getSemesterAktif();
		$thn_ajaran_aktif 	= $sms_aktif['thn_ajaran'];
		$semester_aktif 	= $sms_aktif['semester'];

		$sql = "SELECT k.id_kelasb, k.semester, k.thn_ajaran, k.kode, IFNULL(k.grup,'-') as grup, m.sks, 
				IF(k.diadakan_hari='','-',k.diadakan_hari) as hari, TIME_FORMAT(k.waktu_mulai,'%H:%i') as jam_awal, 
				TIME_FORMAT(k.waktu_selesai,'%H:%i') as jam_akhir, k.diadakan_hari_2, TIME_FORMAT(k.waktu_mulai_2,'%H:%i') as jam_awal2, 
				TIME_FORMAT(k.waktu_selesai_2,'%H:%i') as jam_akhir2, m.nama AS nama_matkul, 
				IFNULL(
					(GROUP_CONCAT(
						CONCAT(IF(IFNULL(d.gelar_prefix,'NULL')='NULL','',CONCAT(d.gelar_prefix,' ')),
						d.nama,
						', ',
						d.gelar_suffix) 
					SEPARATOR '; ')
					),
					'-'
				) AS nama_dosen
				FROM ec_matkul m 
				INNER JOIN ec_kelas_buka k ON k.kode = m.kode
				INNER JOIN ec_peserta s ON k.id_kelasb = s.id_kelasb
				LEFT JOIN ec_pengajar p ON k.id_kelasb = p.id_kelasb
				LEFT JOIN user_dosen_karyawan d ON p.nik = d.nik
				WHERE k.aktif = 1	
				AND s.nim = '$username'
				AND k.thn_ajaran = '$thn_ajaran_aktif'
				AND k.semester = '$semester_aktif'
				GROUP BY k.id_kelasb, k.semester, k.thn_ajaran, k.kode, grup, m.sks, hari, jam_awal, jam_akhir, k.diadakan_hari_2, jam_awal2, jam_akhir2, nama_matkul
				ORDER BY k.kode";
		$result = $this->db->query($sql);

		$data = array();
		if ($result->num_rows() > 0) {
			$data = $result->result_array();
		}

		return $data;
	}

	public function getSemesterAktif(){
		$sql 	= "SELECT MAX(thn_ajaran) as thn_ajaran, MAX(semester) as semester FROM ec_kelas_buka";
		$result = $this->db->query($sql);

		$data = array();
		if ($result->num_rows() > 0) {
			$data['thn_ajaran'] = $result->row()->thn_ajaran;
			$data['semester'] 	= $result->row()->semester;
		}

		return $data;
	}
}

/* End of file m_mahasiswa.php */
/* Location: ./application/modules_core/mahasiswa/models/m_mahasiswa.php */