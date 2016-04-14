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
                        $current_language = "english";
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

            /// Get front and back base images
            $product_base_images = $this->admin_model->get_base_images($product_id);

            ///Get default parameters
            $product_parameters = $this->admin_model->get_json__parameters($product_id);

            $data['base_images'] = $product_base_images;

            $data['parameters'] = $product_parameters;

            ///Get all menus
            $data['menus'] = $this->admin_model->get_all_menus();

            $data['product_id'] = $product_id;

            if(isset($product_id)){

                ///Get submens base on the product id and menu id. 
                $data['product_submenus'] = $this->admin_model->get_product_sub_menus($product_id, 1);
            }
            
            //$this->testBlendImage(json_decode($product_parameters), $product_id);

            $this->load->view("pages/header.php",$data);

            $this->load->view('design/main');

            $this->load->view("pages/footer.php");
	}
        
        
        public function getProductPreview()
	{
            $image = $_POST['image'];


            $this->load->helper('SimpleImage');

            $finalImage = new abeautifulsite\SimpleImage($image);

            if(isset($_POST['blend'])){

                $finalImage = $finalImage->overlay($_POST['blend'], 'center', 0.5);
            }

            if(isset($_POST['color'])){

                $finalImage->colorize($_POST['color'], 1);
            }


            //$finalImage->brightness(20);

            echo $finalImage->output_base64();
		
	}
        
        public function getBlendImage()
	{
            $this->load->helper('SimpleImage');
            
            ///Gets the parameters that have been set by the user in the browser
            $parameters = json_decode($this->input->post('parameters'));
            
            $product_id = $this->input->post('product_id');
            
            $base_images = $this->admin_model->get_base_images($product_id);
                        
            $i = 0;    
            
            $j = 0;
            
            $images = Array();
            
            $blends = Array();
            
            $images[$i] = $base_images['front'];
            
            $i++;
            
            foreach ($parameters as $menu) {
                               
                foreach($menu as $submenu){
                                                  
                    if(!empty($submenu)){
                        
                        if($submenu->type == 0){

                            $images[$i] = $submenu->image_data->images;
                            $i++;
                        }
                        
                        if($submenu->type == 1){

                            $blends[$j] = $submenu->image_data->images;
                            $j++;
                        }
                    }
                }
            }
            
            $this->load->helper('SimpleImage');
            
            $finalImage = null;

            $first = true;

            //usort($parts,'sub_product_type_position_cmp');

            foreach($images as $part)
            {
                
                
                
                try {

                    if($first)
                    {
                        $image_path = base_url('assets/images/product/front/')."/".$part["name"];
                        
                        $finalImage = new abeautifulsite\SimpleImage($image_path);
                                                
                        $first=false;
                    }
                    else
                    {
                        
                        foreach($part as $option_image)
                        {
                                                                                      
                            $image_path = base_url('assets/images/design/')."/".$option_image->name;

                            $finalImage = $finalImage->overlay($image_path);
                                                                                                         
                        }
                    }
                } 
                catch(Exception $e) {
                    
                    echo 'Error: ' . $e->getMessage();
                }

            }
            
            foreach($blends as $part)
            {
                foreach($part as $option_blend)
                {

                    $image_path = base_url('assets/images/design/')."/".$option_blend->name;

                    $finalImage = $finalImage->imagealphamask($image_path);


                }
            }

            //$finalImage->colorize($this->getFabrique($product["fabrique_id"])->color, .8);

            $finalImage->brightness(20);
            
            echo $finalImage->output_base64('png');
		
	}
        
        
        public function getColorImage()
	{
            $color = $_POST['color'];

            $this->load->helper('SimpleImage');

            $finalImage = new abeautifulsite\SimpleImage();

            $finalImage->create(100, 100, $color);

            echo $finalImage->output_base64('png');
		
	}
        
        
}
?>
