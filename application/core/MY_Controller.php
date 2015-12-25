<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('BASE_URI', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('THEMES_DIR', 'themes');

class MY_Controller extends CI_Controller {

	protected $data = array();
	protected $assets_path = 'assets/uploads/';
	protected $current_user = array();
	protected $current_groups = array();
	protected $current_groups_ids = array();

	function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('pagination');
		$this->load->library('general');
		$this->load->model('User');

		$this->load->model('Setting');
		
		$this->data['page_title'] = 'CI Blog';
		$this->data['before_head'] = 'before head';
		$this->data['before_body'] = 'before body';

		$this->data['assets_path'] = $this->assets_path;

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

		if($this->session->userdata('user_id')){
			$this->current_user = $this->User->find_by_id($this->session->userdata('user_id'));
			$this->current_groups = $this->current_groups();
			$this->current_groups_ids =  explode(',', $this->current_user['group_ids']);
		}

		$this->data['current_user'] = $this->current_user;
		$this->data['current_groups'] = $this->current_groups;
		$this->data['current_groups_ids'] = $this->current_groups_ids;
	}

	protected function render($content = null, $layout = 'public'){

		if($layout == 'json' || $this->input->is_ajax_request()){
			header('Content-Type: application/json');
      		echo json_encode($this->data);
		}else{
			$this->data['content'] = (is_null($content)) ? '' : $this->load->view($content,$this->data,TRUE);
			$this->load->view($layout,$this->data);
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
		return explode(',', $this->current_user['groups']);
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


class Admin_Controller extends MY_Controller{

	protected $layout = 'admin/layout';
	protected $base_assets_url = 'assets/admin/';

	function __construct(){
		parent::__construct();
		$this->data['base_assets_url'] = BASE_URI.$this->base_assets_url;
		$this->data['page_title'] = 'CI Blog - Dashboard';
		$this->data['header'] = $this->load->view('admin/parts/header',$this->data,TRUE);
		$this->data['parent_menu'] = '';
	}

	protected function render($content = null, $layout = 'admin/layout'){
		$this->data['sidebar'] = $this->load->view('admin/parts/sidebar',$this->data,TRUE);
		parent::render($content, $layout);
	}
}


class Public_Controller extends MY_Controller{


	protected $layout = '';
	protected $base_assets_url = 'assets/themes/';
	protected $theme = '';

	function __construct(){
		parent::__construct();
		$this->theme = $this->config->item('ciblog_theme');

		$this->data['base_assets_url'] = BASE_URI.$this->base_assets_url.$this->theme.'/';
		$this->data['page_title'] = 'CI Blog - Simple CMS based on CodeIgniter 3.x';
		$this->data['header'] = $this->load->view('themes/'.$this->theme.'/header',$this->data, TRUE);
		$this->data['right_sidebar'] = $this->load->view('themes/'.$this->theme.'/right_sidebar',$this->data, TRUE);
		$this->data['footer'] = $this->load->view('themes/'.$this->theme.'/footer',$this->data, TRUE);
		
		$this->layout = THEMES_DIR.'/'.$this->theme.'/layout';
	}

	protected function render($content = null, $layout = ''){
		parent::render(THEMES_DIR.'/'.$this->theme.'/'.$content, $this->layout);
	}
}