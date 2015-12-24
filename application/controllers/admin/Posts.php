<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Post');
		$this->load->model('Category');
	}

	public function index(){
		$config['base_url'] = site_url('admin/posts/index/');
		$config['total_rows'] = count($this->Post->find());
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;

        if ($this->input->get('q')):
            $q = $this->input->get('q');
            $this->data['posts'] = $this->Post->find($config['per_page'], $this->uri->segment(4), $q);
            if (empty($this->data['posts'])) {
                $this->session->set_flashdata('message', message_box('Data tidak ditemukan','danger'));
                redirect('admin/posts/index');
            }
            $config['total_rows'] = count($this->data['posts']);
        else:
            $this->data['posts'] = $this->Post->find($config['per_page'], $this->uri->segment(4));
        endif;
        $this->data['pagination'] = $this->bootstrap_pagination($config);
		$this->render('admin/posts/index');
	}

	public function add(){
		$this->form_validation->set_rules('title', 'title', 'required|is_unique[posts.title]');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('published_at', 'tanggal', 'xss_clean');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
        	
            $data = $_POST;
            unset($data['category']);
            $data['type'] = 'post';
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified'] = date("Y-m-d H:i:s");
            $data['user_id'] = $this->session->userdata('user_id');

            $this->Post->create($data);
      
            $post_id = $this->db->insert_id();
            
            if(!empty($_POST['category'])){
                foreach($_POST['category'] as $key => $cat_id){
                    $post_category = array(
                        'post_id' => $post_id,
                        'category_id' => $cat_id
                    );
                    $this->db->insert('posts_categories',$post_category);
                }
            }
            $this->session->set_flashdata('message', message_box('New post has been saved','success'));
            redirect('admin/posts');
        }
        $this->data['categories'] = $this->Category->find_list();
       	$this->render('admin/posts/add');
	}

	public function edit($id = null){
        if($id == null){
            $id = $this->input->post('id');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('published_at', 'tanggal', 'xss_clean');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
         
            $data = $_POST;
            unset($data['category']);
            $data['type'] = 'post';
            $data['modified'] = date("Y-m-d H:i:s");
            $data['user_id'] = $this->session->userdata('user_id');

            $this->Post->update($data,$id);
      
            $post_id = $id;
      
            if(!empty($_POST['category'])){
                $this->db->where('post_id',$post_id);
                $this->db->where_not_in('category_id',$_POST['category']);
                $this->db->delete('posts_categories');

                foreach($_POST['category'] as $key => $cat_id){
                
                    if($this->db->where(array('post_id' => $post_id, 'category_id' => $cat_id))->get('posts_categories',1)->num_rows() < 1){
                        $post_category = array(
                            'post_id' => $post_id,
                            'category_id' => $cat_id
                        );
                        $this->db->insert('posts_categories',$post_category);
                    }
                }
            }
            $this->session->set_flashdata('message', message_box('New post has been saved','success'));
            redirect('admin/posts');
        }
        $this->data['post'] = $this->Post->find_by_id($id);
        $this->data['categories'] = $this->Category->find_list();
        $current_category = $this->db->select('category_id')->where(array('post_id' => $this->data['post']['id']))->get('posts_categories')->result_array();
       
        $category_ids = array();
        if(!empty($current_category)){
            foreach($current_category as $current){
                $category_ids[] = $current['category_id'];
            }
        }

        $this->data['category_ids'] = $category_ids;


        $this->render('admin/posts/edit');
	}

	public function delete($id = null){
		if(!empty($id)){
            $this->Post->delete($id);
            $this->session->set_flashdata('message',message_box('Post has been deleted','success'));
            redirect('admin/posts/index');
        }else{
            $this->session->set_flashdata('message',message_box('Invalid id','danger'));
            redirect('admin/posts/index');
        }
	}
}
