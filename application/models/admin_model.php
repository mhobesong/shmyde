<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


	public function get_all_products(){
	
		$query = $this->db->query("SELECT * from shmyde_product");
		
		return $query;
	
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
	
	public function delete_product($id){
		
		$this->db->query('DELETE from shmyde_product where id = '.$id);
	}
	
	public function delete_menu($id){
		
		$this->db->query('DELETE from shmyde_design_main_menu where id = '.$id);
	}
	
	public function delete_submenu($id){
		
		$this->db->query('DELETE from shmyde_design_sub_menu where id = '.$id);
	}
	
    public function create_product($name, $target, $front_view_image, $back_view_image){

		$insert_id = $this->get_table_next_id("shmyde_product");
		
		$sql = "INSERT INTO shmyde_product (id, name, target) 

        VALUES (".$insert_id." , ".$this->db->escape($name).", ".$this->db->escape($target).")";

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
    
    public function edit_product($id, $name, $target, $front_view_image, $back_view_image){
    	
    	$sql = "UPDATE shmyde_product SET name = ".$this->db->escape($name).", target = ".$this->db->escape($target)." WHERE id = ".$id;

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
    
    private function get_table_next_id($table_name){
    	
    	$count_sql = "SELECT * FROM ".$table_name;	

		$count = $this->db->query($count_sql)->num_rows() + 1;
		
		return $count;
    }
    
    
}