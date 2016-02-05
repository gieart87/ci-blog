<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('BASE_URI', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('THEMES_DIR', 'themes');
define('ADMIN_THEMES_DIR','admin');

class MY_Controller extends CI_Controller {

	protected $data = array();
	protected $assets_path = 'assets/uploads/';
	protected $current_user = array();
	protected $current_groups = array();
	protected $current_groups_ids = array();
	protected $base_assets_url = '';
    protected $parent_menu = '';
    protected $page_title = '';
    protected $theme = '';

    function __construct() {
        parent::__construct();

        // ======== Load Helper =========
        $this->load->helper(array('form','url','text','language','general'));

        // ======== Load Library ========
        $this->load->library(array('session','form_validation','pagination','ion_auth','general'));

        $this->load->config('ci-blog');



        $this->load->model('User');
        if($this->session->userdata('user_id')){
            $this->current_user = $this->User->find_by_id($this->session->userdata('user_id'));
            $this->current_groups = $this->current_groups();
            $this->current_groups_ids =  explode(',', $this->current_user['group_ids']);
        }

        $this->data['current_user'] = $this->current_user;
        $this->data['current_groups'] = $this->current_groups;
        $this->data['current_groups_ids'] = $this->current_groups_ids;

        if(empty($this->data['page_title'])){
            $this->data['page_title'] = $this->config->item('ci_blog_sitename');
        }


        $this->theme = $this->config->item('ci_blog_theme');


    }

    protected function load_theme($content = null, $layout = true) {
        $this->load->model('Menu');
        $this->data['main_menus'] = '';
        if(count($this->Menu->findActive()) > 0){
            $this->data['main_menus'] = $this->general->bootstrap_menu($this->Menu->findActive());
        }
        $this->data['header'] = $this->load->view('themes/'.$this->config->item('ci_blog_theme').'/header',$this->data, TRUE);
        $this->data['right_sidebar'] = $this->load->view('themes/'.$this->config->item('ci_blog_theme').'/right_sidebar',$this->data, TRUE);
        $this->data['footer'] = $this->load->view('themes/'.$this->config->item('ci_blog_theme').'/footer',$this->data, TRUE);
        

        $this->base_assets_url = 'assets/'.THEMES_DIR.'/'.$this->config->item('ci_blog_theme').'/';
        $this->data['base_assets_url'] = BASE_URI.$this->base_assets_url;
        if($layout == true){
            $this->data['content'] = (is_null($content)) ? '' : $this->load->view(THEMES_DIR.'/'.$this->config->item('ci_blog_theme').'/'.$content, $this->data, TRUE);
            $this->load->view(THEMES_DIR . '/' . $this->config->item('ci_blog_theme') . '/layout', $this->data);
        }else{
            $this->load->view(THEMES_DIR.'/'.$this->config->item('ci_blog_theme').'/'.$content, $this->data);
        }


    }

    protected function load_admin($content = null, $layout = true) {

    	$this->base_assets_url = 'assets/admin/'.$this->config->item('ci_blog_admin_theme').'/';
    	$this->data['base_assets_url'] = BASE_URI.$this->base_assets_url;

        //Category status options
        $this->data['category_status'] = array(
            0 => 'Inactive',
            1 => 'Active'
        );

        //Post status option
        $this->data['post_status'] = array(
            0 => 'Draft',
            1 => 'Publish',
            2 => 'Block'
        );

        //User status option
        $this->data['user_status'] = array(
            0 => 'Pending',
            1 => 'Active',
            2 => 'Inactive'
        );

        if(empty($this->data['parent_menu'])){
            $this->data['parent_menu'] = '';
        }
    
    	if($layout == true){
	        $this->data['header'] = $this->load->view(ADMIN_THEMES_DIR.'/'.$this->config->item('ci_blog_admin_theme').'/parts/header', $this->data, TRUE);
	        $this->data['sidebar'] = $this->load->view(ADMIN_THEMES_DIR.'/'.$this->config->item('ci_blog_admin_theme').'/parts/sidebar', $this->data, TRUE);
	        $this->data['content'] = (is_null($content)) ? '' : $this->load->view(ADMIN_THEMES_DIR.'/'.$this->config->item('ci_blog_admin_theme').'/'.$content, $this->data, TRUE);
	        $this->load->view(ADMIN_THEMES_DIR.'/'.$this->config->item('ci_blog_admin_theme').'/layout', $this->data);
    	}else{
    		$this->load->view(ADMIN_THEMES_DIR.'/'.$this->config->item('ci_blog_admin_theme').'/'.$content, $this->data);
    	}
    }
	protected function bootstrap_pagination($paging_config = array()){


		//config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config = array_merge($paging_config,$config);

		$this->pagination->initialize($config);
		return $this->pagination->create_links(); 
	}

	protected function allow_group_access($groups_allowed = array()){
		$allow_access = false;
		
		$match_group_allowed = array_intersect($this->current_groups(), $groups_allowed);
		
		$allow_access = !empty($match_group_allowed);

		if($allow_access == false){
			$this->session->set_flashdata('message', message_box('You are not allowed to access this page!','danger'));
			redirect('signin','refresh');
		}
	}

	protected function current_groups(){
		$current_groups = array();
		if(!empty($this->current_user['groups'])){
			$current_groups = explode(',', $this->current_user['groups']);
		}
		return $current_groups;
	}

	protected function generate_acl_db(){


		$controllers = array();
	    $this->load->helper('file');

	    // Scan files in the /application/controllers directory
	    // Set the second param to TRUE or remove it if you 
	    // don't have controllers in sub directories
	    $files = get_dir_file_info(APPPATH.'controllers');
	  
	    // Loop through file names removing .php extension
	    foreach ($files as $file)
	    {
	        
	        $controller = array(
	        	'name' => $file['name'],
	        	'path' => $file['server_path'],
	        	'parent_id' => 0,
	        );

	        if($file['name'] != 'admin'){

	        	$methods = get_class_methods(str_replace('.php', '', $file['name']));
	        
	    	}



	        if($file['name'] == 'admin'){
	        	$admin_files = get_dir_file_info(APPPATH.'controllers/admin');
	        	print_data($admin_files);exit;
	        }
	    }
	  

	}


}