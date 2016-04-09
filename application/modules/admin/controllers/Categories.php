<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Category');
		$this->allow_group_access(array('admin'));
		$this->data['parent_menu'] = 'post';
	}

	public function index(){
		
		$config['base_url'] = site_url('admin/categories/index/');
		$config['total_rows'] = count($this->Category->find());
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;
		
		$this->data['categories'] = $this->Category->find($config['per_page'], $this->uri->segment(4));

		$this->data['pagination'] = $this->bootstrap_pagination($config);
		$this->load_admin('categories/index');
	}

	public function add(){
		$this->form_validation->set_rules('name', 'name', 'required|is_unique[categories.name]');
		$this->form_validation->set_rules('status', 'status', 'required');

		if($this->form_validation->run() == true){
			$category = array(
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status')
			);
			$this->Category->create($category);
			$this->session->set_flashdata('message',message_box('Category has been saved','success'));
			redirect('admin/categories/index');
		}

		$this->load_admin('categories/add');
	}

	public function edit($id = null){
		if($id == null){
			$id = $this->input->post('id');
		}

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');

		if($this->form_validation->run() == true){
			$category = array(
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status')
			);
			$this->Category->update($category, $id);
			$this->session->set_flashdata('message',message_box('Category has been saved','success'));
			redirect('admin/categories/index');
		}

		$this->data['category'] = $this->Category->find_by_id($id);

		$this->load_admin('categories/edit');
	}

	public function delete($id = null){
		if(!empty($id)){
			$this->Category->delete($id);
			$this->session->set_flashdata('message',message_box('Category has been deleted','success'));
			redirect('admin/categories/index');
		}else{
			$this->session->set_flashdata('message',message_box('Invalid id','danger'));
			redirect('admin/categories/index');
		}
	}
}
