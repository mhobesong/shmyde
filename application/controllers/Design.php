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
                                
                $product_base_images = $this->admin_model->get_base_images($product_id);
                
                $product_parameters = $this->admin_model->get_json__parameters($product_id);
                
                $data['base_images'] = $product_base_images;
                
                $data['parameters'] = $product_parameters;
		
		$data['menus'] = $this->admin_model->get_all_menus();
		
		$data['product_id'] = $product_id;
		
		if(isset($product_id))
			$data['product_submenus'] = $this->admin_model->get_product_sub_menus($product_id, 1);

		$this->load->view("pages/header.php",$data);
		$this->load->view('design/main');
		$this->load->view("pages/footer.php");
	}
        
        
        public function getProductPreview()
	{
		$image = $_POST['image'];
                
                $blend = $_POST['blend'];
		
		$this->load->helper('SimpleImage');
		
		$finalImage;
		
		$finalImage = new abeautifulsite\SimpleImage($image);
                                               
                //$finalImage = $finalImage->overlay($blend, 'center', 0.5);
				
		$finalImage->colorize("#00FF00", 1);
		
		//$finalImage->brightness(20);
			
		echo $finalImage->output_base64();
		
	}
}
?>
