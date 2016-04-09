<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->allow_group_access(array('admin'));
        
		$this->load->model('Page');
        $this->data['parent_menu'] = 'page';
    
	}

	public function index(){
		$config['base_url'] = site_url('admin/pages/index/');
		$config['total_rows'] = count($this->Page->find());
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;

        $user_id = null;

        if(!in_array('admin', $this->current_groups)){
            $user_id = $this->session->userdata('user_id');
        }


        if ($this->input->get('q')):
            $q = $this->input->get('q');
            $this->data['pages'] = $this->Page->find($config['per_page'], $this->uri->segment(4),$user_id, $q);
            if (empty($this->data['pages'])) {
                $this->session->set_flashdata('message', message_box('Data tidak ditemukan','danger'));
                redirect('admin/pages/index');
            }
            $config['total_rows'] = count($this->data['pages']);
        else:
            $this->data['pages'] = $this->Page->find($config['per_page'], $this->uri->segment(4),$user_id);
        endif;
        $this->data['pagination'] = $this->bootstrap_pagination($config);
        
		$this->load_admin('pages/index');
	}

	public function add(){

		$this->form_validation->set_rules('title', 'title', 'required|is_unique[posts.title]');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('published_at', 'date', '');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
        	
            $data = $_POST;
            $data['type'] = 'page';
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified'] = date("Y-m-d H:i:s");
            $data['user_id'] = $this->session->userdata('user_id');

            $this->Page->create($data);
    
            $this->session->set_flashdata('message', message_box('New page has been saved','success'));
            redirect('admin/pages');
        }

       	$this->load_admin('pages/add');
	}

	public function edit($id = null){
        if($id == null){
            $id = $this->input->post('id');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('published_at', 'date', '');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
         
            $data = $_POST;
            $data['modified'] = date("Y-m-d H:i:s");
            $this->Page->update($data,$id);
      
            $this->session->set_flashdata('message', message_box('Page has been saved','success'));
            redirect('admin/pages');
        }
        $this->data['page'] = $this->Page->find_by_id($id);

        $this->load_admin('pages/edit');
	}

	public function delete($id = null){
		if(!empty($id)){
            $this->Page->delete($id);
            $this->session->set_flashdata('message',message_box('Page has been deleted','success'));
            redirect('admin/pages/index');
        }else{
            $this->session->set_flashdata('message',message_box('Invalid id','danger'));
            redirect('admin/pages/index');
        }
	}
}
