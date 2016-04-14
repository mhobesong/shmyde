<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    public function get_all_products(){
	
		$query = $this->db->query("SELECT * from shmyde_product");
		
		return $query;
	
	}
	
    public function get_product_id($target_name, $product_url_name){
		
		$target_id = -1;
		
		switch($target_name){
			
			case 'men':
				$target_id = 0;
				break;
			case 'women':
				$target_id = 1;
				break;
			case 'both':
				$target_id = 2;
				break;
				
		}
		
                $sql = "SELECT * from shmyde_product where target = ".$target_id." and url_name = '".$product_url_name."'";
                
		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			
			return $query->row()->id;
		}
		
	}
	
    public function get_all_menus(){
	
		$query = $this->db->query("SELECT * from shmyde_design_main_menu");
		
		return $query;
	
	}
	
    public function get_all_submenus(){
	
		$sql = "SELECT shmyde_design_sub_menu.id as id, shmyde_design_sub_menu.name as name, type,  shmyde_product.name as product_name, shmyde_design_main_menu.name as menu_name
		 FROM shmyde_design_main_menu, shmyde_design_sub_menu, shmyde_product
		  WHERE shmyde_design_sub_menu.shmyde_design_main_menu_id = shmyde_design_main_menu.id AND shmyde_design_sub_menu.shmyde_product_id = shmyde_product.id";
	
		$query = $this->db->query($sql);
		  
		return $query;
	
	}
	
    public function get_product_sub_menus($product_id, $menu_id){
		
		
        $sql = "SELECT * from shmyde_design_sub_menu where shmyde_product_id=".$product_id." and shmyde_design_main_menu_id = ".$menu_id."";

        $query = $this->db->query($sql);

        return $query;
    }
	
    public function get_json_product_sub_menus($product_id, $menu_id){
		
		
		$sql = "SELECT * from shmyde_design_sub_menu where shmyde_product_id=".$product_id." and shmyde_design_main_menu_id = ".$menu_id."";
	
		$query = $this->db->query($sql);
		
		$submenu_array = Array();
		
		foreach($query->result() as $row){
			
			$submenu_array[$row->id]['id'] = $row->id;
			$submenu_array[$row->id]['name'] = $row->name;
			$submenu_array[$row->id]['type'] = $row->type;
		}
		 		  
		return json_encode($submenu_array);
	}
        
    public function get_json_option($id){
		
		
		$sql = "SELECT * from shmyde_design_option where id = ".$id;
	
		$query = $this->db->query($sql);
                
                $row = $query->row();
		
		$option = Array();
		
		$option['id'] = $row->id;
                $option['name'] = $row->name;
                $option['type'] = $row->type;
                $option['color'] = $row->color;
                $option['price'] = $row->price;
                $option['description'] = $row->description;
                $option['is_default'] = $row->is_default;
                $option['applied_to'] = $row->applied_to;
                $option['image_data'] = $this->get_option_image_data($row->id);
		 		  
		return json_encode($option);
	}
	
    public function get_json_submenu_options($submenu_id){


            $sql = "SELECT * from shmyde_design_option where shmyde_design_sub_menu_id = ".$submenu_id;

            $query = $this->db->query($sql);

            $options_array = Array();

            foreach($query->result() as $row){

                $options_array[$row->id]['id'] = $row->id;
                $options_array[$row->id]['name'] = $row->name;
                $options_array[$row->id]['type'] = $row->type;
                $options_array[$row->id]['color'] = $row->color;
                $options_array[$row->id]['price'] = $row->price;
                $options_array[$row->id]['description'] = $row->description;

                $options_array[$row->id]['is_default'] = $row->is_default;
                $options_array[$row->id]['applied_to'] = $row->applied_to;

                $image_data = $this->get_option_image_data($row->id);
                
                $options_array[$row->id]['image_data'] = $image_data;


            }

            return json_encode($options_array);
    }

    public function get_all_submenus_simple(){

            $sql = "SELECT * from shmyde_design_sub_menu";

            $query = $this->db->query($sql);

            return $query;

    }
    
    public function get_all_options_extended(){

            $sql = "SELECT 
            shmyde_design_option.*, 
            shmyde_product.id as product_id, shmyde_product.name as product_name,
            shmyde_design_main_menu.id as menu_id, shmyde_design_main_menu.name as menu_name,
            shmyde_design_sub_menu.id as submenu_id, shmyde_design_sub_menu.name as submenu_name 
            FROM
            shmyde_design_option, shmyde_product, shmyde_design_main_menu, shmyde_design_sub_menu
            WHERE
            shmyde_design_option.shmyde_design_sub_menu_id = shmyde_design_sub_menu.id AND 
            shmyde_design_sub_menu.shmyde_product_id = shmyde_product.id AND
            shmyde_design_sub_menu.shmyde_design_main_menu_id = shmyde_design_main_menu.id";

            $query = $this->db->query($sql);

            return $query;
    }

    public function get_option($id){

            $sql = "SELECT 
            shmyde_design_option.*, 
            shmyde_product.id as product_id, shmyde_product.name as product_name,
            shmyde_design_main_menu.id as menu_id, shmyde_design_main_menu.name as menu_name,
            shmyde_design_sub_menu.id as submenu_id, shmyde_design_sub_menu.name as submenu_name 
            FROM
            shmyde_design_option, shmyde_product, shmyde_design_main_menu, shmyde_design_sub_menu
            WHERE
            shmyde_design_option.shmyde_design_sub_menu_id = shmyde_design_sub_menu.id AND 
            shmyde_design_sub_menu.shmyde_product_id = shmyde_product.id AND
            shmyde_design_sub_menu.shmyde_design_main_menu_id = shmyde_design_main_menu.id AND shmyde_design_option.id = ".$id;

            $query = $this->db->query($sql);

            return $query->row();
    }
    
    public function get_images($id, $table_name){

        $image_query = $this->db->query('SELECT * from '.$table_name.' where item_id = '.$id);
        
        $result = Array();
        
        if($image_query->num_rows() > 0){
            
            foreach($image_query->result() as $row){
                
                $result[$row->id]['id'] = $row->id;
                $result[$row->id]['item_id'] = $row->item_id;
                $result[$row->id]['name'] = $row->name;
                $result[$row->id]['depth'] = $row->depth;
                
            }
                       
        }
        
        return $result;
    }
        
    public function delete_option($id){

        $this->db->query('DELETE from shmyde_design_option where id = '.$id);
    }
    
    public function create_option($name, 
            $shmyde_design_sub_menu_id, 
            $type, 
            $applied_to, 
            $price, 
            $description, 
            $color, 
            $is_default){

        $insert_id = $this->get_table_next_id("shmyde_design_option");

        $sql = "INSERT INTO shmyde_design_option (id, name, shmyde_design_sub_menu_id, type, applied_to, price, description, color) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($shmyde_design_sub_menu_id).", ".$type.", ".$applied_to.", ".$price.", '".$description."', '".$color."')";

        $this->db->query($sql);

        $sql = "UPDATE shmyde_design_option SET is_default = false where shmyde_design_sub_menu_id = ".$shmyde_design_sub_menu_id;

        $this->db->query($sql);

        if($is_default){
            $sql = "UPDATE shmyde_design_option SET is_default = true where id = ".$insert_id;
        }
        else{
            $sql = "UPDATE shmyde_design_option SET is_default = false where id = ".$insert_id;
        }

        $this->db->query($sql);

        $this->copy_tmp_option_data("shmyde_images", "shmyde_temp_images");
        
        $this->copy_tmp_option_data("shmyde_option_thumbnail", "shmyde_secondary_temp_images");
        
        return true;
    }
    
    public function edit_option($id, 
            $name, 
            $shmyde_design_sub_menu_id, 
            $type, 
            $applied_to, 
            $price, 
            $description, 
            $color, 
            $is_default){
    
    	$sql = "UPDATE shmyde_design_option 
    	SET name = ".$this->db->escape($name).", shmyde_design_sub_menu_id = ".$this->db->escape($shmyde_design_sub_menu_id).", type = ".$this->db->escape($type).", applied_to = ".$this->db->escape($applied_to).", price = ".$this->db->escape($price).", description = ".$this->db->escape($description).", color = ".$this->db->escape($color)." 
    	WHERE id = ".$id;

        $this->db->query($sql);

        if($is_default){
            
            $sql = "UPDATE shmyde_design_option SET is_default = false where shmyde_design_sub_menu_id = ".$shmyde_design_sub_menu_id;

            $this->db->query($sql);
            
            $sql = "UPDATE shmyde_design_option SET is_default = true where id = ".$id;
            
            $this->db->query($sql);
        }
        else{
            
            $sql = "UPDATE shmyde_design_option SET is_default = false where id = ".$id;
            
            $this->db->query($sql);
            
            
        }
        
        $this->copy_tmp_option_data("shmyde_images", "shmyde_temp_images");
        
        $this->copy_tmp_option_data("shmyde_option_thumbnail", "shmyde_secondary_temp_images");
              
        return true;
		
		
    }


    public function save_image($option_id, $image_id, $image_name, $table_name){
        
        $sql = "INSERT into ".$table_name." (id, item_id, name) VALUES (".$image_id." , ".$option_id.", ".$this->db->escape($image_name).")";
        $this->db->query($sql);
    }


    
    

    public function get_product($id){

        $product = $this->db->query('SELECT * from shmyde_product where id = '.$id);

        return $product->row();
    }
    
    public function get_product_images($id){

        $image_query = $this->db->query('SELECT * from shmyde_product_image where item_id = '.$id);

        $images = Array();

        foreach ($image_query->result() as $image)
        {
            if($image->view_type == 0){

                    $images['back_view_image'] = $image->name;
            }

            if($image->view_type == 1){

                    $images['front_view_image'] = $image->name;
            }

        }

        return $images;
    }
    
    public function delete_product($id){

        $this->db->query('DELETE from shmyde_product where id = '.$id);
    }
    
    

    public function get_menu($id){

        $menu = $this->db->query('SELECT * from shmyde_design_main_menu where id = '.$id);

        return $menu->row();
    }

    public function get_submenu($id){

        $menu = $this->db->query('SELECT * from shmyde_design_sub_menu where id = '.$id);

        return $menu->row();
    }


    

    public function delete_menu($id){

        $this->db->query('DELETE from shmyde_design_main_menu where id = '.$id);
    }

    public function delete_submenu($id){

        $this->db->query('DELETE from shmyde_design_sub_menu where id = '.$id);
    }
	
    public function create_product($name, $url_name, $target){

        $insert_id = $this->get_table_next_id("shmyde_product");
		
        $sql = "INSERT INTO shmyde_product (id, url_name, name, target) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($url_name).", ".$this->db->escape($target).")";

        $this->db->query($sql);
				
        $this->copy_tmp_option_data("shmyde_product_front_image", "shmyde_temp_images");
        
        $this->copy_tmp_option_data("shmyde_product_back_image", "shmyde_secondary_temp_images");
        

        return true;
    	
    }
    
    public function create_menu($name){
    	
    	$insert_id = $this->get_table_next_id("shmyde_design_main_menu");
		
	$sql = "INSERT INTO shmyde_design_main_menu (id, name) 

        VALUES (".$insert_id." , ".$this->db->escape($name).")";

		$this->db->query($sql);
		
		return true;
    }
    
    
    public function create_submenu($name, $type, $menu, $product){
    	
    	$insert_id = $this->get_table_next_id("shmyde_design_sub_menu");
		
		$sql = "INSERT INTO shmyde_design_sub_menu (id, name, type, shmyde_design_main_menu_id, shmyde_product_id) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($type).", ".$this->db->escape($menu).", ".$this->db->escape($product).")";

		$this->db->query($sql);
		
		return true;
    }
    
    public function edit_submenu($id, $name, $type, $menu, $product){
    	
    	$sql = "UPDATE shmyde_design_sub_menu 
    	
    	SET name = ".$this->db->escape($name).", shmyde_design_main_menu_id = ".$this->db->escape($menu).", shmyde_product_id = ".$this->db->escape($product)." WHERE id = ".$id;

		$this->db->query($sql);
		
		return true;
		
	}
    
    public function edit_menu($id, $name){
    	
    	$sql = "UPDATE shmyde_design_main_menu SET name = ".$this->db->escape($name)." WHERE id = ".$id;

		$this->db->query($sql);
		
		return true;
		
	}
        
    public function clear($table_name){
        
        $sql = "delete from ".$table_name;
        $this->db->query($sql);
    }    
        
   
    
    public function edit_product($id, $name, $url_name, $target){
    	
    	$sql = "UPDATE shmyde_product SET name = ".$this->db->escape($name).", url_name = ".$this->db->escape($url_name).", target = ".$this->db->escape($target)." WHERE id = ".$id;

        $this->db->query($sql);
		
	$this->copy_tmp_option_data("shmyde_product_front_image", "shmyde_temp_images");
        
        $this->copy_tmp_option_data("shmyde_product_back_image", "shmyde_secondary_temp_images");
                
        return true;
    }
            
    public function get_table_next_id($table_name){
    	
    	$count_sql = "SELECT max(id) as max_id FROM ".$table_name;	

		$count = $this->db->query($count_sql)->row()->max_id + 1;
		
		return $count;
    }
    
    ///Every Product has a base front image and a base back image on which other images are
    /// Interposed. This function gets these images using the product ID
    public function get_base_images($product_id){
        
        $base_image = Array();
        
        $front_sql = "SELECT * from shmyde_product_front_image where item_id = ".$product_id;
        
        $front_result = $this->db->query($front_sql);
        
        foreach ($front_result->result() as $row){
            
            $base_image['front']['name'] = $row->name;
            $base_image['front']['depth'] = $row->depth;
            
        }
        
        $back_sql = "SELECT * from shmyde_product_back_image where item_id = ".$product_id;
        
        $back_result = $this->db->query($back_sql);
        
        foreach ($back_result->result() as $row){
            
            $base_image['back']['name'] = $row->name;
            $base_image['back']['depth'] = $row->depth;
            
        }
        
        return $base_image;
    }
    
    ///This function gets the default parameters of the product. The current model 
    ///Needs every option to have a default parameter. 
    public function get_json__parameters($product_id){
        
        $defaults = Array();
               
        $sql = "SELECT * from shmyde_design_sub_menu where shmyde_product_id = ".$product_id;
        
        ///This gets the product submenus
        $result = $this->db->query($sql);
        
        foreach ($result->result() as $row){
            
            $main_menu_id = $row->shmyde_design_main_menu_id;
            
            if(!isset($defaults[$main_menu_id][$row->id])){
                
                $defaults[$main_menu_id][$row->id] = Array();
            }
                        
            $sql = "SELECT * from shmyde_design_option where shmyde_design_sub_menu_id = ".$row->id;
            
            ///Get Options associated with the product submenu
            $options = $this->db->query($sql);
            
            foreach ($options->result() as $option){
                
                if($option->is_default){
                    
                    $image_data = $this->get_option_image_data($option->id);
                    
                    $defaults[$main_menu_id][$row->id]['id'] = $option->id;
                    $defaults[$main_menu_id][$row->id]['type'] = $option->type;
                    $defaults[$main_menu_id][$row->id]['name'] = $option->name;
                    $defaults[$main_menu_id][$row->id]['description'] = $option->description;
                    $defaults[$main_menu_id][$row->id]['price'] = $option->price;
                    $defaults[$main_menu_id][$row->id]['image_data'] = $image_data;
                     
                }
                
                           
            }
            
            
        }
        
        return json_encode($defaults);
    }
    
    ///This function gets the images and thumbnails associated with an option
    private function get_option_image_data($option_id){
        
        $result = Array();
        
        $image_data = Array();
        
        $thumbnail_data = Array();
        
        $sql = "SELECT * from shmyde_images where item_id = ".$option_id;
        
        $option_images = $this->db->query($sql);
                    
        foreach ($option_images->result() as $option_image){

            $image_data[$option_image->id]['name'] = $option_image->name;
            $image_data[$option_image->id]['depth'] = $option_image->depth;

        }
        
        $thumbnail_sql = "SELECT * from shmyde_option_thumbnail where item_id = ".$option_id;
        
        $thumbnail_images = $this->db->query($thumbnail_sql);
                    
        foreach ($thumbnail_images->result() as $thumbnail_image){

            $thumbnail_data['name'] = $thumbnail_image->name;
            $thumbnail_data['depth'] = $thumbnail_image->depth;

        }
        
        $result['images'] = $image_data;
        
        $result['thumbnail'] = $thumbnail_data;
        
        return $result;
        
    }
    
    public function get_image_name($option_id, $image_id, $table_name){
        
        $sql = "SELECT name from ".$table_name." WHERE id = ".$image_id." AND item_id = ".$option_id;
        
        $count = $this->db->query($sql)->num_rows();
        
        if($count > 0){
            
            return $this->db->query($sql)->row()->name;
        }
        else{
            
            return "";
        }
    }
    
    public  function delete_image($option_id, $image_id, $table_name){
        
        $sql = "DELETE from ".$table_name." WHERE id = ".$image_id." AND item_id = ".$option_id;
        
        $this->db->query($sql);
    }
    
    function copy_tmp_option_data($table, $tmp_table){
        
                
        $sql = "INSERT INTO ".$table." (id, item_id, name)
            SELECT id, item_id, name 
            FROM ".$tmp_table;
        
        $this->db->query($sql);
        
        $delete_sql = "DELETE FROM ".$tmp_table;
        
        $this->db->query($delete_sql);
        

    }
    
}