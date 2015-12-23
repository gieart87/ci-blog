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