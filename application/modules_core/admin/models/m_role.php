<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_role extends MX_Model
{

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
	
	function index(){
		$this->load->view('role');
	}
}
