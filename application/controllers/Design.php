<?php
defined('BASEPATH') or die('No direct script access allowed');
/**
* Design
* Loads appropriate design pages.
* @author Besong Moses Besong <mosbesong@gmail.com>
*/
class Design extends CI_Controller
{
	
	public function __construct()
	{
			parent::__construct();

        	$this->load->helper('url');
        	
        	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
					switch ($lang){
						case "fr":
						$current_language = "french";
						break;
						case "en":
						$current_language = "english";
						break;
					default:
						$current_language = "english";
						break;
					}

        	$this->lang->load('shmyde', $current_language);

	}
	
	
	public function index(){}

	public function product($target, $product)
	{
		$data['title'] = "DESIGN-SHIRT-SHMYDE";
		$data['cssLinks'] = array('design-shirt');
		
		$product_id = $this->admin_model->get_product_id($target, $product);
		
		$data['menus'] = $this->admin_model->get_all_menus();
		
		$data['product_id'] = $product_id;
		
		if(isset($product_id))
			$data['product_submenus'] = $this->admin_model->get_product_sub_menus($product_id, 1);

		$this->load->view("pages/header.php",$data);
		$this->load->view('design/main');
		$this->load->view("pages/footer.php");
	}
}
?>
