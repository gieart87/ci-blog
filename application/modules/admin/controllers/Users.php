<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->model('User');
		$this->load->model('Group');
		
		$this->data['parent_menu'] = 'user';
	}

	//activate the user
	function activate($id, $code=false)
	{

		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', message_box($this->ion_auth->messages(),'success'));
			redirect("signin", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', message_box($this->ion_auth->errors(),'danger'));
			redirect("users/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('users/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}


	public function index(){
		$this->allow_group_access(array('admin'));
		$config['base_url'] = site_url('admin/users/index/');
		$config['total_rows'] = count($this->User->find());
		$config['per_page'] = 10;
		$config["uri_segment"] = 4;
		
		$this->data['users'] = $this->User->find($config['per_page'], $this->uri->segment(4));

		$this->data['pagination'] = $this->bootstrap_pagination($config);
		$this->load_admin('users/index');
	}

	public function add(){
		$this->allow_group_access(array('admin'));
		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'first name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');


		if($this->form_validation->run() == true){
			$username = $this->input->post('username');
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);

			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data,$this->input->post('groups'))){
				$this->session->set_flashdata('message',message_box('User has been saved','success'));
			}else{
				$this->session->set_flashdata('message',message_box('Failed, please try again!','danger'));
			}
			redirect('admin/users/index');
		}

		$this->data['groups'] = $this->Group->find_list();
		$this->load_admin('users/add');
	}

	public function edit($id = null){
		$this->allow_group_access(array('admin'));
		if($id == null){
			$id = $this->input->post('id');
		}

		if($id == $this->current_user['user_id']){
			redirect('admin/users/profile');
		}

		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('active', 'status', 'required');

		if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirm_password', 'konfirmasi password', 'required|matches[password]');
        endif;

		if($this->form_validation->run() == true){
			$data = $_POST;
            unset($data['groups']);
            unset($data['confirm_password']);
            unset($data['password']);

            $this->User->update($data,$id);
      
            $user_id = $id;
      
            if(!empty($_POST['groups'])){
                $this->db->where('user_id',$user_id);
                $this->db->where_not_in('group_id',$_POST['groups']);
                $this->db->delete('users_groups');

                foreach($_POST['groups'] as $key => $group_id){
                
                    if($this->db->where(array('user_id' => $user_id, 'group_id' => $group_id))->get('users_groups',1)->num_rows() < 1){
                        $user_group = array(
                            'user_id' => $user_id,
                            'group_id' => $group_id
                        );
                        $this->db->insert('users_groups',$user_group);
                    }
                }
            }
			$this->session->set_flashdata('message',message_box('User has been saved','success'));
			redirect('admin/users/index');
		}

		$this->data['user'] = $this->User->find_by_id($id);
		$this->data['groups'] = $this->Group->find_list();

		$this->load_admin('users/edit');
	}

	public function delete($id = null){
		$this->allow_group_access(array('admin'));
		$user  = $this->User->find_by_id($id);
		$user_groups = explode(',', $user['groups']);

		if(in_array('admin', $user_groups)){
			$this->session->set_flashdata('message',message_box('Failed, could not delete admin user','danger'));
			redirect('admin/users/index');
		}

		if($current_user['user_id'] == $id){
			$this->session->set_flashdata('message',message_box('Failed, you could not delete yourself','danger'));
			redirect('admin/users/index');
		}
		
		if(!empty($id)){
			$this->User->delete($id);
			$this->session->set_flashdata('message',message_box('User has been deleted','success'));
			redirect('admin/users/index');
		}else{
			$this->session->set_flashdata('message',message_box('Invalid id','danger'));
			redirect('admin/users/index');
		}
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


}
