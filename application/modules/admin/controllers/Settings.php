<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->allow_group_access(array('admin'));
		
		$this->load->model('Setting');
		$this->data['parent_menu'] = 'post';
	}

	public function index(){
		
		if(!empty($_POST['settings'])){
			

			foreach($_POST['settings'] as $key => $setting){
				$this->Setting->update_by_key($key,$setting);
			}

			$this->session->set_flashdata('message',message_box('Setting has been saved','success'));
			redirect('admin/settings/index');
		}
		$this->data['settings'] = $this->Setting->findAll();
		$this->load_admin('settings/index');
	}
}
