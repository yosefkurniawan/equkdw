<?php 
$this->load->view('include/header');
$this->load->view('include/menu');
$this->load->view('include/left_nav');

# render single or multiple content
if (is_array($content)) {
	foreach ($content as $value) {
		$this->load->view($value);
	}
}
else{
	$this->load->view($content);
}

$this->load->view('include/footer');
?>