<?php
class admin extends CI_Controller {



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
				
        			if($this->admin_model->edit_product($id, $this->input->post('name'), $this->input->post('target'), $front_view_upload ? $this->input->post('name').'_front_view.png' : '', $back_view_upload ? $this->input->post('name').'_back_view.png' : '' )){

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

		}

		public function create($page = 'product')
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
        		
        		return;
        	}
        	
        	if($page == 'submenu'){
        		
        		$data['menus'] = $this->admin_model->get_all_menus();
        		
        		$data['products'] = $this->admin_model->get_all_products();
        	}
        	
        	$data['title'] = 'CREATE'; 

        	$this->lang->load('shmyde', CURRENT_LANGUAGE);
        	
        	$this->load->view('admin/header');

        	$this->load->view('admin/create_'.$page, $data);


		}









		private function do_upload($form_file_name, $file_name)
    	{
    	$this->load->library('upload');
    	
    	$this->upload->initialize($this->set_upload_options($file_name)); 

		if($this->upload->do_upload($form_file_name)){
    		
    		return true;
		}
		else{
			
			//echo $this->upload->display_errors();
			return false;
		}
		
    }

    	private function set_upload_options($file_name)
    	{   
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/shmyde/assets/images/products/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name']  = $file_name;
		$config['overwrite']  = true;

        return $config;
    }

}
?>
