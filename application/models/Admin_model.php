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
		
		$query = $this->db->query("SELECT * from shmyde_product where target = ".$target_id." and url_name = '".$product_url_name."'");

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
	
	public function get_json_submenu_options($submenu_id){
		
		
		$sql = "SELECT * from shmyde_design_option where shmyde_design_sub_menu_id = ".$submenu_id;
	
		$query = $this->db->query($sql);
		
		$options_array = Array();
		
		foreach($query->result() as $row){
			
			$options_array[$row->id]['name'] = $row->name;
			$options_array[$row->id]['type'] = $row->type;
			$options_array[$row->id]['price'] = $row->price;
			$options_array[$row->id]['description'] = $row->description;
			
			$image_sql = "SELECT * from shmyde_images where shmyde_design_options_id =".$row->id;
			
			$image_query = $this->db->query($image_sql);
			
			if($image_query->num_rows() > 0){
				
				$options_array[$row->id]['image_name'] = $image_query->row()->name;
				
				$options_array[$row->id]['caption'] = $image_query->row()->caption;
				
				$options_array[$row->id]['z_index'] = $image_query->row()->z_index;
			}
			
			
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
	
	public function get_product($id){
		
		$product = $this->db->query('SELECT * from shmyde_product where id = '.$id);
		
		return $product->row();
	}
	
	public function get_menu($id){
		
		$menu = $this->db->query('SELECT * from shmyde_design_main_menu where id = '.$id);
		
		return $menu->row();
	}
	
	public function get_submenu($id){
		
		$menu = $this->db->query('SELECT * from shmyde_design_sub_menu where id = '.$id);
		
		return $menu->row();
	}
	
	public function get_product_images($id){
		
		$image_query = $this->db->query('SELECT * from shmyde_product_image where shmyde_product_id = '.$id);
		
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
	
	public function get_option_image($id){
		
		$image_query = $this->db->query('SELECT * from shmyde_images where shmyde_design_options_id = '.$id);
		
		if($image_query->num_rows() > 0)
			return $image_query->row();
	}
	
	public function delete_product($id){
		
		$this->db->query('DELETE from shmyde_product where id = '.$id);
	}
	
	public function delete_option($id){
		
		$this->db->query('DELETE from shmyde_design_option where id = '.$id);
	}
	
	public function delete_menu($id){
		
		$this->db->query('DELETE from shmyde_design_main_menu where id = '.$id);
	}
	
	public function delete_submenu($id){
		
		$this->db->query('DELETE from shmyde_design_sub_menu where id = '.$id);
	}
	
    public function create_product($name, $url_name, $target, $front_view_image, $back_view_image){

		$insert_id = $this->get_table_next_id("shmyde_product");
		
		$sql = "INSERT INTO shmyde_product (id, url_name, name, target) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($url_name).", ".$this->db->escape($target).")";

		$this->db->query($sql);
		
		if($front_view_image != ''){
		
			$sql = "INSERT INTO shmyde_product_image (id, shmyde_product_id, name, view_type) 

        	VALUES (".$this->get_table_next_id("shmyde_product_image")." , ".$insert_id.", ".$this->db->escape($front_view_image).", 1)";
        
        	$this->db->query($sql);
        
        }
        
        if($back_view_image != ''){
        
        	$sql = "INSERT INTO shmyde_product_image (id, shmyde_product_id, name, view_type) 

        	VALUES (".$this->get_table_next_id("shmyde_product_image")." , ".$insert_id.", ".$this->db->escape($back_view_image).", 0)";
        
        	$this->db->query($sql);
        }

		return true;
    	
    }
    
    public function create_menu($name){
    	
    	$insert_id = $this->get_table_next_id("shmyde_design_main_menu");
		
		$sql = "INSERT INTO shmyde_design_main_menu (id, name) 

        VALUES (".$insert_id." , ".$this->db->escape($name).")";

		$this->db->query($sql);
		
		return true;
    }
    
    public function create_option($name, $shmyde_design_sub_menu_id, $type, $price, $description, $zindex, $image_name, $caption_name, $is_default){
    	
    	$insert_id = $this->get_table_next_id("shmyde_design_option");
		
		$sql = "INSERT INTO shmyde_design_option (id, name, shmyde_design_sub_menu_id, type, price, description) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($shmyde_design_sub_menu_id).", ".$type.", ".$price.", '".$description."')";

		$this->db->query($sql);
		
		$sql = "UPDATE shmyde_design_option SET is_default = false where shmyde_design_sub_menu_id = ".$shmyde_design_sub_menu_id;
		
		$this->db->query($sql);
		
		if($is_default)
			$sql = "UPDATE shmyde_design_option SET is_default = true where id = ".$insert_id;
		else
			$sql = "UPDATE shmyde_design_option SET is_default = false where id = ".$insert_id;
		
		$this->db->query($sql);
		
		
		
		if($image_name != '' || $caption_name != ''){
		
			$sql = "INSERT INTO shmyde_images (id, shmyde_design_options_id, name, caption, z_index) 

        	VALUES (".$this->get_table_next_id("shmyde_images")." , ".$insert_id.", ".$this->db->escape($image_name).", ".$this->db->escape($caption_name).", ".$this->db->escape($zindex).")";
        
        	$this->db->query($sql);
        
        }
        
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
    
    public function edit_product($id, $name, $url_name, $target, $front_view_image, $back_view_image){
    	
    	$sql = "UPDATE shmyde_product SET name = ".$this->db->escape($name).", url_name = ".$this->db->escape($url_name).", target = ".$this->db->escape($target)." WHERE id = ".$id;

		$this->db->query($sql);
		
		if($front_view_image != ''){
		
			if($this->check_image_exist(1, $id)){
			
				
				$sql = "UPDATE shmyde_product_image set name = '".$front_view_image."' WHERE shmyde_product_id = ".$id." AND view_type = 1";
				
				$this->db->query($sql);
			
			}
			else{
			
				$sql = "INSERT INTO shmyde_product_image (id, shmyde_product_id, name, view_type) 

        		VALUES (".$this->get_table_next_id("shmyde_product_image")." , ".$id.", ".$this->db->escape($front_view_image).", 1)";
        
        		$this->db->query($sql);
        	}
        
        }
        
        if($back_view_image != ''){
		
			if($this->check_image_exist(0, $id)){
			
				
				$sql = "UPDATE shmyde_product_image set name = '".$back_view_image."' WHERE shmyde_product_id = ".$id." AND view_type = 0";
				
				$this->db->query($sql);
			
			}
			else{
			
				$sql = "INSERT INTO shmyde_product_image (id, shmyde_product_id, name, view_type) 

        		VALUES (".$this->get_table_next_id("shmyde_product_image")." , ".$id.", ".$this->db->escape($back_view_image).", 0)";
        
        		$this->db->query($sql);
        	}
        
        }
        
        return true;
    }
    
    public function edit_option($id, $name, $shmyde_design_sub_menu_id, $type, $price, $description, $zindex, $image_name, $caption_name, $is_default){
    
    	$sql = "UPDATE shmyde_design_option 
    	SET name = ".$this->db->escape($name).", shmyde_design_sub_menu_id = ".$this->db->escape($shmyde_design_sub_menu_id).", type = ".$this->db->escape($type).", price = ".$this->db->escape($price).", description = ".$this->db->escape($description)." 
    	WHERE id = ".$id;

		$this->db->query($sql);
		
		$sql = "UPDATE shmyde_design_option SET is_default = false where shmyde_design_sub_menu_id = ".$shmyde_design_sub_menu_id;
		
		$this->db->query($sql);
		
		if($is_default)
			$sql = "UPDATE shmyde_design_option SET is_default = true where id = ".$id;
		else
			$sql = "UPDATE shmyde_design_option SET is_default = false where id = ".$id;
			
		
		$this->db->query($sql);
		
		if($image_name != '' || $caption_name != ''){
		
			if($this->check_option_image_exist($id)){
			
				$sql = "UPDATE shmyde_images set name = '".$image_name."', z_index = ".$zindex.", caption = '".$caption_name."' WHERE shmyde_design_options_id = ".$id;
				
				$this->db->query($sql);
			
			}
			else{
			
				$sql = "INSERT INTO shmyde_images (id, shmyde_design_options_id, name, caption, z_index) 

        		VALUES (".$this->get_table_next_id("shmyde_images")." , ".$id.", ".$this->db->escape($image_name).", ".$this->db->escape($caption_name).", ".$zindex.")";
        
        		$this->db->query($sql);
        	}
        
        }
        
        return true;
		
		
    }
    
    private function check_image_exist($view_type, $product_id){
    	
    	$count_sql = "SELECT * FROM shmyde_product_image where view_type = ".$view_type." AND shmyde_product_id = ".$product_id;
    	
    	$count = $this->db->query($count_sql)->num_rows();
    	
    	if($count > 0){
    		
    		return true;
    	}
    	else{
    		
    		return false;
    	}
    }
    
    private function check_option_image_exist($option_id){
    	
    	$count_sql = "SELECT * FROM shmyde_images where shmyde_design_options_id = ".$option_id;
    	
    	$count = $this->db->query($count_sql)->num_rows();
    	
    	if($count > 0){
    		
    		return true;
    	}
    	else{
    		
    		return false;
    	}
    }
    
    private function get_table_next_id($table_name){
    	
    	$count_sql = "SELECT max(id) as max_id FROM ".$table_name;	

		$count = $this->db->query($count_sql)->row()->max_id + 1;
		
		return $count;
    }
    
    
}