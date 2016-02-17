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

        public function view($page = 'product')
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
            // Whoops, we don't have a page for that!
            show_404();
            }

            if ($this->input->server('REQUEST_METHOD') == 'POST'){

                        if($page == 'product'){

                                $front_view_upload = $this->do_upload('front_view', $this->input->post('name').'_front_view.png');

                                $back_view_upload = $this->do_upload('back_view', $this->input->post('name').'_back_view.png');

                        if($this->admin_model->edit_product($id, $this->input->post('name'),  $this->input->post('url_name'), $this->input->post('target'), $front_view_upload ? $this->input->post('name').'_front_view.png' : '', $back_view_upload ? $this->input->post('name').'_back_view.png' : '' )){

                                        redirect('/admin/view/product', 'refresh');
                        }
                }

                if($page == 'menu'){

                        if($this->admin_model->edit_menu($id, $this->input->post('name'))){

                                        redirect('/admin/view/menu', 'refresh');
                        }
                }

                if($page == 'submenu'){

                        if($this->admin_model->edit_submenu($id, $this->input->post('name'), $this->input->post('type'), $this->input->post('menu'), $this->input->post('product'))){

                                        redirect('/admin/view/submenu', 'refresh');
                        }
                }

                if($page == 'option'){

                        if($this->input->post('type') == 0){

                                        $dir_name = 'style';
                                }

                                if($this->input->post('type') == 1){

                                        $dir_name = 'fabric';
                                }

                                if(isset($dir_name)){

                                        $image_name = $dir_name.'_'.$this->input->post('product').'_'.$this->input->post('menu').'_'.$this->input->post('submenu').'_option_image.png';

                                        $image_upload = $this->do_upload('option_image', $image_name, $dir_name);

                                        $caption_name = $dir_name.'_'.$this->input->post('product').'_'.$this->input->post('menu').'_'.$this->input->post('submenu').'_caption_image.png';

                                        $caption_upload = $this->do_upload('caption', $caption_name, $dir_name);
                                }

                        if($this->admin_model->edit_option(
                                $id, $this->input->post('name'), 
                                $this->input->post('submenu'), 
                                $this->input->post('type'),
                                $this->input->post('applied_to'),
                                $this->input->post('price'), 
                                $this->input->post('description'), 
                                $this->input->post('depth'), 
                                $image_upload ? $image_name : '',
                                $caption_upload ? $caption_name : '',
                                $this->input->post('is_default'))){

                                        redirect('/admin/view/option', 'refresh');
                        }
                }



                return;
        }

            if($page == 'product'){

                $data['product'] = $this->admin_model->get_product($id);

                $product_images = $this->admin_model->get_product_images($id);

                if(isset($product_images['front_view_image']))
                        $data['front_view_image'] = $product_images['front_view_image'];

                if(isset($product_images['back_view_image']))
                        $data['back_view_image'] = $product_images['back_view_image'];	

        }

            if($page == 'menu'){

                    $data['menu'] = $this->admin_model->get_menu($id);
            }

            if($page == 'submenu'){

                    $data['menus'] = $this->admin_model->get_all_menus();

                    $data['products'] = $this->admin_model->get_all_products();

                    $data['submenu'] = $this->admin_model->get_submenu($id);
            }

            if($page == 'option'){

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

                $option_image = $this->admin_model->get_option_image($id);

                if(isset($option_image)){

                    $data['option_image'] = $option_image;
                }

                $data['option'] = $this->admin_model->get_option($id);
            }

            $data['title'] = 'EDIT';  // Capitalize the first letter

            $this->lang->load('shmyde', CURRENT_LANGUAGE);

            $this->load->view('admin/header');
            
            $this->load->view('admin/create_'.$page, $data);


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

                        $front_view_upload = $this->do_upload('front_view', $this->input->post('name').'_front_view.png');

                        $back_view_upload = $this->do_upload('back_view', $this->input->post('name').'_back_view.png');

                        if($this->admin_model->create_product($this->input->post('name'), $this->input->post('target'), $front_view_upload ? $this->input->post('name').'_front_view.png' : '', $back_view_upload ? $this->input->post('name').'_back_view.png' : '' )){

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

                    if($this->input->post('type') == 0){

                        $dir_name = 'style';
                    }

                    if($this->input->post('type') == 1){

                        $dir_name = 'fabric';
                    }

                    if(isset($dir_name)){

                        $image_name = $dir_name.'_'.$this->input->post('product').'_'.$this->input->post('menu').'_'.$this->input->post('submenu').'_option_image.png';

                        $image_upload = $this->do_upload('option_image', $image_name, $dir_name);

                        $caption_name = $dir_name.'_'.$this->input->post('product').'_'.$this->input->post('menu').'_'.$this->input->post('submenu').'_caption_image.png';

                        $caption_upload = $this->do_upload('caption', $caption_name, $dir_name);
                    }


                    if($this->admin_model->create_option(
                            $this->input->post('name'), 
                            $this->input->post('submenu'), 
                            $this->input->post('type'),
                            $this->input->post('applied_to'),
                            $this->input->post('price'), 
                            $this->input->post('description'), 
                            $this->input->post('depth'), 
                            $image_upload ? $image_name : '',
                            $caption_upload ? $caption_name : '',
                            $this->input->post('is_default')
                            )){

                                redirect('/admin/view/option', 'refresh');
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

                    $query_submenu = $this->admin_model->get_all_submenus_simple();

                    $submenus = Array();

                    foreach ($query_submenu->result() as $row)
                            {
                                    $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['name'] = $row->name;
                                    $submenus[$row->shmyde_product_id][$row->shmyde_design_main_menu_id][$row->id]['id'] = $row->id;

                            }

                            $data['submenus'] = $submenus;
            }



            $data['title'] = 'CREATE'; 

            $this->lang->load('shmyde', CURRENT_LANGUAGE);

            $this->load->view('admin/header');

            $this->load->view('admin/create_'.$page, $data);


        }

        private function do_upload($form_file_name, $file_name, $image_directory='products')
    	{
			$this->load->library('upload');
    	
			$this->upload->initialize($this->set_upload_options($file_name, $image_directory)); 

			if($this->upload->do_upload($form_file_name)){
				
				return true;
			}
			else{
				
				//echo $this->upload->display_errors();
				return false;
			}
		
    }

    	private function set_upload_options($file_name, $image_directory)
    	{   
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/shmyde/assets/images/'.$image_directory.'/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name']  = $file_name;
			$config['overwrite']  = true;

			return $config;
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
}
?>
