<?php
class Pages extends CI_Controller {



        public function view($page = 'home')
		{
        	if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        	{
                // Whoops, we don't have a page for that!
                show_404();
        	}
        	
        	        	    		        	        	
        	$this->lang->load('shmyde', CURRENT_LANGUAGE);

        	$this->load->view('pages/header');
        	
        	$this->load->view('pages/'.$page);
        	
        	
		}
		
}
?>
