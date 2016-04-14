<?php
class Admin extends CI_Controller {



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

    public function view($page = 'product_id', $product_id = -1, $menu_id = -1, $submenu_id = -1)
    {
        if ( ! file_exists(APPPATH.'/views/admin/'.$page.'.php'))
        {
        // Whoops, we don't have a page for that!
        show_404();
        }

        if($page == 'product'){

                $data['products'] = $this->admin_model->get_all_products();

        }

        if($page == 'menu'){

                $data['menus'] = $this->admin_model->get_all_menus();
        }

        if($page == 'submenu'){

                $data['submenus'] = $this->admin_model->get_all_submenus();
        }

        if($page == 'option'){

                $data['menus'] = $this->admin_model->get_all_menus();

                $data['products'] = $this->admin_model->get_all_products();

                $data['default_product_id'] = $product_id;

                $data['default_menu_id'] = $menu_id;

                $data['default_submenu_id'] = $submenu_id;

                $query_options = $this->admin_model->get_all_options_extended();

                $options = Array();

                foreach ($query_options->result() as $row)
                {
                        $options[$row->id]['id'] = $row->id;
                        $options[$row->id]['name'] = $row->name;
                        $options[$row->id]['type'] = $row->type == 0 ? 'Style' : $row->type == 1 ? 'Fabric' : 'Checkbox';
                        $options[$row->id]['applied_to'] = $row->applied_to == 0 ? 'Front' : $row->applied_to == 1 ? 'Back' : 'N/A';
                        $options[$row->id]['description'] = $row->description;
                        $options[$row->id]['price'] = $row->price;
                        $options[$row->id]['product_name'] = $row->product_name;
                        $options[$row->id]['menu_name'] = $row->menu_name;
                        $options[$row->id]['submenu_name'] = $row->submenu_name;
                        $options[$row->id]['product_id'] = $row->product_id;
                        $options[$row->id]['menu_id'] = $row->menu_id;
                        $options[$row->id]['submenu_id'] = $row->submenu_id;
                        $options[$row->id]['is_default'] = $row->is_default;

                }

                $query_submenu = $this->admin_model->get_all_submenus_simple();

                $submenus = Array();

                foreach ($query_submenu->result() as $row)
                {
                        $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['name'] = $row->name;
                        $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['id'] = $row->id;

                }

                $data['submenus'] = $submenus;
                $data['options'] = $options;
            }

            $data['title'] = ucfirst($page); 

            $this->lang->load('shmyde', CURRENT_LANGUAGE);

                    $this->load->view('admin/header');
            $this->load->view('admin/'.$page, $data);


    }

    public function edit($page = 'product', $id)
    {
        if ( ! file_exists(APPPATH.'/views/admin/create_'.$page.'.php'))
        {
            show_404();
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST'){

            if($page == 'product'){

                $this->edit_product($id);
            }

            if($page == 'menu'){

                $this->edit_menu($id);
            }

            if($page == 'submenu'){

                $this->edit_submenu($id);
            }

            if($page == 'option'){

                $this->edit_option($id);
            }

            return;
        }
        
        $data = Array();
        
        $this->admin_model->clear("shmyde_temp_images");
        
        $this->admin_model->clear("shmyde_secondary_temp_images");
        
        
        
        
        if($page == 'product'){

            $this->delete_tmp_files('product/front/tmp');
        
            $this->delete_tmp_files('product/back/tmp');
            
            $data = $this->begin_edit_product($id, $data);	
        }

        if($page == 'menu'){

            $data = $this->begin_edit_menu($id, $data);
        }

        if($page == 'submenu'){

            $data = $this->begin_edit_submenu($id, $data);
        }

        if($page == 'option'){

            $this->delete_tmp_files('design/tmp');
            
            $this->delete_tmp_files('design/thumbnail/tmp');
                
            $data = $this->begin_edit_option($id, $data);
            
        }

        $data['title'] = 'EDIT';  // Capitalize the first letter
                
        $this->lang->load('shmyde', CURRENT_LANGUAGE);

        $this->load->view('admin/header');

        $this->load->view('admin/create_'.$page, $data);
        


    }

    function edit_product($id){
        

        if($this->admin_model->edit_product(
                $id, $this->input->post('name'),  
                $this->input->post('url_name'), 
                $this->input->post('target'))){

            $this->copy_tmp_files('product/front/tmp', 'product/front');
            $this->copy_tmp_files('product/back/tmp', 'product/back');
            
            redirect('/admin/view/product', 'refresh');
        }
        
    }
    
    function edit_menu($id){
        
        if($this->admin_model->edit_menu($id, $this->input->post('name'))){
            
            redirect('/admin/view/menu', 'refresh');
        }
    }
    
    function edit_submenu($id){
        
        if($this->admin_model->edit_submenu($id, $this->input->post('name'), $this->input->post('type'), $this->input->post('menu'), $this->input->post('product'))){

            redirect('/admin/view/submenu', 'refresh');
        }
    }
    
    function edit_option($id){
                
        if($this->admin_model->edit_option(
                $id, $this->input->post('name'), 
                $this->input->post('submenu'), 
                $this->input->post('type'),
                $this->input->post('applied_to'),
                $this->input->post('price'), 
                $this->input->post('description'), 
                $this->input->post('color'),
                $this->input->post('is_default'))){

                    $this->copy_tmp_files('design/tmp', 'design');
                    
                    $this->copy_tmp_files('design/thumbnail/tmp', 'design/thumbnail');
                    
                    redirect('/admin/view/option/'.$this->input->post('product').'/'. $this->input->post('menu').'/'.$this->input->post('submenu'), 'refresh');
        }
    }
    
    function begin_edit_product($id, $data){
                
        $data['product'] = $this->admin_model->get_product($id);
        
        $data['product_id'] = $data['product']->id;
        
        $back_image = $this->admin_model->get_images($id, 'shmyde_product_back_image');
        
        $front_image = $this->admin_model->get_images($id, 'shmyde_product_front_image');
        
        if(isset($back_image)){
            
            if(!empty($back_image)){
                
                
                $data['back_images'] = json_encode($back_image);
            }
            else{
                
                $data['back_images'] = array();
            }
            
        }
        
        if(isset($front_image)){
            
            if(!empty($front_image)){
                
                
                $data['front_images'] = json_encode($front_image);
            }
            else{
                
                $data['front_images'] = array();
            }
            
        }

        
        return $data;
        
    }
    
    function begin_edit_menu($id, $data){
        
        $data['menu'] = $this->admin_model->get_menu($id);
        
        return $data;
        
    }
    
    function begin_edit_submenu($id, $data){
        
        $data['menus'] = $this->admin_model->get_all_menus();

        $data['products'] = $this->admin_model->get_all_products();

        $data['submenu'] = $this->admin_model->get_submenu($id);
        
        return $data;
        
    }
    
    function begin_edit_option($id, $data){
        
        
        $data['option_id'] = $id;
        
        $data['menus'] = $this->admin_model->get_all_menus();

        $data['products'] = $this->admin_model->get_all_products();

        $query_submenu = $this->admin_model->get_all_submenus_simple();

        $submenus = Array();

        foreach ($query_submenu->result() as $row)
        {
            $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['name'] = $row->name;
            $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['id'] = $row->id;
        }

        $data['submenus'] = $submenus;

        $option_images = $this->admin_model->get_images($id, 'shmyde_images');
        
        $option_thumbnail = $this->admin_model->get_images($id, 'shmyde_option_thumbnail');

        if(isset($option_images)){
            
            if(!empty($option_images)){
                
                
                $data['option_images'] = json_encode($option_images);
            }
            else{
                
                $data['option_images'] = array();
            }
            
        }
        
        if(isset($option_thumbnail)){
            
            if(!empty($option_thumbnail)){
                
                
                $data['option_thumbnails'] = json_encode($option_thumbnail);
            }
            else{
                
                $data['option_thumbnails'] = array();
            }
            
        }
        

        

        $data['option'] = $this->admin_model->get_option($id);
        
        return $data;
        
    }






    public function delete($page = 'product', $id)
        {
        	
            if($page == 'product'){

                    $this->admin_model->delete_product($id);

                    redirect('/admin/view/product', 'refresh');

            }

            if($page == 'menu'){

                    $this->admin_model->delete_menu($id);

                    redirect('/admin/view/menu', 'refresh');

            }

            if($page == 'submenu'){

                    $this->admin_model->delete_submenu($id);

                    redirect('/admin/view/submenu', 'refresh');

            }

                    if($page == 'option'){

                    $this->admin_model->delete_option($id);

                    redirect('/admin/view/option', 'refresh');

            }

        }

    public function create($page = 'product')
    {

        if ( ! file_exists(APPPATH.'/views/admin/create_'.$page.'.php'))
            {
                show_404();
            }

        if ($this->input->server('REQUEST_METHOD') == 'POST'){


            if($page == 'product'){
                
                $this->delete_tmp_files('product/front/tmp');
                $this->delete_tmp_files('product/back/tmp');
                 
                $this->copy_tmp_files('product/front/tmp', 'product/front');

                $this->copy_tmp_files('product/back/tmp', 'product/back');

                if($this->admin_model->create_product(
                        $this->input->post('name'), 
                        $this->input->post('target') )){

                redirect('/admin/view/product', 'refresh');
                }
            }

            if($page == 'menu'){

                if($this->admin_model->create_menu($this->input->post('name'))){

                    redirect('/admin/view/menu', 'refresh');
                }
            }

            if($page == 'submenu'){

                if($this->admin_model->create_submenu($this->input->post('name'), $this->input->post('type'), $this->input->post('menu'), $this->input->post('product'))){

                    redirect('/admin/view/submenu', 'refresh');
                }
            }

            if($page == 'option'){

                $this->delete_tmp_files('design/tmp');
                $this->delete_tmp_files('design/thumbnail/tmp');
                
                if($this->admin_model->create_option(

                    $this->input->post('name'), 
                    $this->input->post('submenu'), 
                    $this->input->post('type'),
                    $this->input->post('applied_to'),
                    $this->input->post('price'), 
                    $this->input->post('description'), 
                    $this->input->post('color'), 
                    $this->input->post('is_default')
                    )){

                        $this->copy_tmp_files('design/tmp', 'design');
                        $this->copy_tmp_files('design/thumbnail/tmp', 'design/thumbnail');

                        redirect('/admin/view/option/'.$this->input->post('product').'/'. $this->input->post('menu').'/'.$this->input->post('submenu'), 'refresh');
                }
            }

            return;
        }

       

        $this->admin_model->get_all_options_extended();

        if($page == 'submenu' || $page == 'option'){

                $data['menus'] = $this->admin_model->get_all_menus();

                $data['products'] = $this->admin_model->get_all_products();


        }

        if($page == 'option'){

            $id = $this->admin_model->get_table_next_id("shmyde_design_option");

            /// The ID of the option that shall be created. This is associated with the images uploaded. 
            $data['option_id'] = $id;

            $query_submenu = $this->admin_model->get_all_submenus_simple();

            $submenus = Array();

            foreach ($query_submenu->result() as $row)
            {
                $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['name'] = $row->name;
                $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['id'] = $row->id;

            }

            $data['submenus'] = $submenus;
        }
        
        if($page == 'product'){
            
            $id = $this->admin_model->get_table_next_id("shmyde_product");
            
            $data['product_id'] = $id;
        }



        $data['title'] = 'CREATE'; 

        $this->lang->load('shmyde', CURRENT_LANGUAGE);

        $this->load->view('admin/header');

        $this->load->view('admin/create_'.$page, $data);


    }

		
    public function get_submenus($product_id, $selected_menu){
			
			$result = $this->admin_model->get_json_product_sub_menus($product_id, $selected_menu);
			
			if(isset($result)){
				
				echo $result;
			}
			
		}
                
    public function get_options($submenu_id){
			
        $result = $this->admin_model->get_json_submenu_options($submenu_id);

        if(isset($result)){

            echo $result;
        }
    }
                
    public function get_option($id){
			
        $result = $this->admin_model->get_json_option($id);

        if(isset($result)){

            echo $result;
        }
    }
                
    public function upload_image($id){
        
        
        
        $tmp_image_dir = $this->input->post('params[0]');
        
        $tmp_table_name = $this->input->post('params[1]');
        
        $upload_file_name = $this->input->post('params[2]');
        
        $image_name = $this->input->post('params[3]');
        
        $this->admin_model->clear($tmp_table_name);

        $upload_path = ASSETS_DIR_PATH.'images/'.$tmp_image_dir;

        for ($i = 0; $i <= 10; $i++) {

            $key = $upload_file_name."_".$i;
                        
            if(isset($_FILES[$key]) && $_FILES['file_'.$i]['size'] > 0){
                
                $errors= array();
                $file_name = $image_name.'_'.$id.'_'.$i;
                $file_size =$_FILES[$key]['size'];
                $file_tmp =$_FILES[$key]['tmp_name'];
                $file_type=$_FILES[$key]['type'];

                $tmp = explode('.',$_FILES[$key]['name']);

                $file_ext=strtolower(end($tmp));

                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false){

                   $errors[]="extension '".$file_ext."' not allowed, please choose a JPEG or PNG file.";
                }

                if($file_size > 2097152){

                   $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)== true){

                   move_uploaded_file($file_tmp, $upload_path.$file_name.'.'.$file_ext);

                   $this->admin_model->save_image($id, $i, $file_name.'.'.$file_ext, $tmp_table_name);

                   echo "Upload ".$file_name.'.'.$file_ext." Successful \n";

                }else{

                   echo print_r($errors);

                }
             }
             


        }
        
                            
    }
                    
    function recurse_copy($src,$dst) { 
        
        $dir = opendir($src); 
                
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    
                    try {
                        copy($src . '/' . $file, $dst . '/' . $file); 
                    }
                    catch(Exception $e){
                        
                    }
                } 
            } 
        } 
        closedir($dir);
        $this->delete_all_files($src);
    }   
    
    public function delete_all_files($dir_name){
        
        $files = glob($dir_name.'*'); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file)){
            unlink($file);
          }
        }
    }
    
    public function delete_image(){
        
         $table_name = $this->input->post('table_name');
        
         $tmp_table_name = $this->input->post('tmp_table_name');
        
         $item_id = $this->input->post('item_id');
        
         $image_id = $this->input->post('image_id');
        
         $image_dir = $this->input->post('image_dir');
        
         $tmp_image_dir = $this->input->post('tmp_image_dir');
        
         $image_name = $this->admin_model->get_image_name($item_id, $image_id, $tmp_table_name);
        
        if($image_name == ""){
            
            $image_name = $this->admin_model->get_image_name($item_id, $image_id, $table_name);
            
        }
                
        if($image_name != ""){
            

            $tmp_upload_file = ASSETS_DIR_PATH.'images/'.$image_dir.$image_name;
        
            $upload_file = ASSETS_DIR_PATH.'images/'.$tmp_image_dir.$image_name;
            
            if(file_exists($tmp_upload_file)){
                
                 unlink($tmp_upload_file);
            }
            
            if(file_exists($upload_file)){
                
                 unlink($upload_file);
            }
        }
        
        $this->admin_model->delete_image($item_id, $image_id, $tmp_table_name);
        $this->admin_model->delete_image($item_id, $image_id, $table_name);
    }
        
    function copy_tmp_files($from_directory, $to_directory){
        
        $src = ASSETS_DIR_PATH.'images/'.$from_directory;
        
        $dest = ASSETS_DIR_PATH.'images/'.$to_directory;
        
        $this->recurse_copy($src, $dest);
        
        $this->delete_tmp_files($src);
        
    }
    
    function delete_tmp_files($dir){
        
        
        
        $src = ASSETS_DIR_PATH.'images/'.$dir;
        $this->delete_all_files($src);
    }

}

