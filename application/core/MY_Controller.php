<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('BASE_URI', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('THEMES_DIR', 'themes');

class MY_Controller extends CI_Controller {

	protected $data = array();

	function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');
		
		$this->data['page_title'] = 'CI Blog';
		$this->data['before_head'] = 'before head';
		$this->data['before_body'] = 'before body';

		//Category status options
		$this->data['category_status'] = array(
			0 => 'Inactive',
			1 => 'Active'
		);
		
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


}


class Admin_Controller extends MY_Controller{

	protected $layout = 'admin/layout';
	protected $base_assets_url = 'assets/admin/';

	function __construct(){
		parent::__construct();
		$this->data['base_assets_url'] = BASE_URI.$this->base_assets_url;
		$this->data['page_title'] = 'CI Blog - Dashboard';
		$this->data['header'] = $this->load->view('admin/parts/header',$this->data,TRUE);
		$this->data['sidebar'] = $this->load->view('admin/parts/sidebar',$this->data,TRUE);
		
	}

	protected function render($content = null, $layout = 'admin/layout'){
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