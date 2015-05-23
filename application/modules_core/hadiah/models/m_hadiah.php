<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hadiah extends CI_Model {

	// getKRS
	public function beriHadiah($nim,$hadiah)
	{
		$status = 'insert';

		$this->db->where('nim',$nim);
		$select = $this->db->get('eva_hadiah');
		if ($select->num_rows() == 1)
		{
			$status = 'update';
		}

		if ($status == 'insert')
		{
			$input = array(
				'nim' 		=> $nim,
				'hadiah'	=> $hadiah
				);
			$exe = $this->db->insert('eva_hadiah',$input);
		}
		else
		{
			$input = array(
				'hadiah'	=> $hadiah
				);
			$this->db->where('nim',$nim);
			$exe = $this->db->update('eva_hadiah',$input);
		}

		if ($exe) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}