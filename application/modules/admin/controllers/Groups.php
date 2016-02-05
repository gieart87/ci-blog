<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Group');
		$this->allow_group_access(array('admin'));
		$this->data['parent_menu'] = 'user';
	}

	public function index(){
		
		$config['base_url'] = site_url('admin/groups/index/');
		$config['total_rows'] = count($this->Group->find());
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;
		
		$this->data['groups'] = $this->Group->find($config['per_page'], $this->uri->segment(4));

		$this->data['pagination'] = $this->bootstrap_pagination($config);
		$this->load_admin('groups/index');
	}

	public function add(){
		$this->form_validation->set_rules('name', 'name', 'required|is_unique[categories.name]');

		if($this->form_validation->run() == true){
			$group = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			);
			$this->Group->create($group);
			$this->session->set_flashdata('message',message_box('Group has been saved','success'));
			redirect('admin/groups/index');
		}

		$this->load_admin('groups/add');
	}

	public function edit($id = null){
		if($id == null){
			$id = $this->input->post('id');
		}

		$this->form_validation->set_rules('name', 'name', 'required');

		if($this->form_validation->run() == true){
			$group = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			);
			$this->Group->update($group, $id);
			$this->session->set_flashdata('message',message_box('Group has been saved','success'));
			redirect('admin/groups/index');
		}

		$this->data['group'] = $this->Group->find_by_id($id);

		$this->load_admin('groups/edit');
	}

	public function delete($id = null){
		// if(!empty($id)){
		// 	$this->Group->delete($id);
		// 	$this->session->set_flashdata('message',message_box('Group has been deleted','success'));
		// 	redirect('admin/groups/index');
		// }else{
		// 	$this->session->set_flashdata('message',message_box('Invalid id','danger'));
		// 	redirect('admin/groups/index');
		// }
	}
}
