<?php 
$this->load->view('include/header');
$this->load->view('include/menu');
$this->load->view('include/left_nav');
$this->load->view($content);
$this->load->view('include/footer');
?>