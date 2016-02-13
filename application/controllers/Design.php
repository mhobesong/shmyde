<?php
defined('BASEPATH') or die('No direct script access allowed');
/**
* Design
* Loads appropriate design pages.
* @author Besong Moses Besong <mosbesong@gmail.com>
*/
class Design extends CI_Controller
{
	public function index(){}

	public function shirt()
	{
		$data['title'] = "DESIGN-SHIRT-SHMYDE";
		$data['cssLinks'] = array('design-shirt');

		$this->load->view("pages/header.php",$data);
		$this->load->view('design');
		$this->load->view("pages/footer.php");
	}
}
?>
