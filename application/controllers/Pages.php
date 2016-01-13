<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
		{
        	if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        	{
                // Whoops, we don't have a page for that!
                show_404();
        	}
        	
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
			
			$data["application_path"] = base_url().'assets/';
        	        	
        	$this->lang->load('shmyde', $current_language);

        	$data['title'] = ucfirst($page); // Capitalize the first letter

        	$this->load->view('pages/header', $data);

        	$this->load->view('pages/'.$page, $data);
		}
		
}
?>
