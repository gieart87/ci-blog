<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Menus extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->allow_group_access(array('admin'));
        
        $this->load->model('Menu');
        $this->load->model('Post');

    }

    function index() {
        $this->data['menus'] = $this->Menu->findAll();
        $this->data['menusList'] = $this->Menu->findList();
        $this->data['status'] = $this->Menu->status;
        $this->load_admin('menus/index');
    }

    function add() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $parent_id = 0;
            if(!empty($this->input->post('parent_id'))){
                $parent_id = $this->input->post('parent_id');
            }

            $data = array(
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'parent_id' => $parent_id,
                'status' => $this->input->post('status')
            );
            $this->Menu->create($data);
            $menu_id = $this->db->insert_id();
            $this->Menu->setPosition($menu_id, $menu_id);
            $this->session->set_flashdata('success', 'Menu has been saved');
            redirect('admin/menus');
        }

        $this->data['menus'] = $this->Menu->findAll();
        $this->data['status'] = $this->Menu->status;
        $this->data['all_post_urls'] = $this->Post->all_urls();
        $this->load_admin('menus/add');
    }

    function edit($id = null) {
        if ($id == null) {
            $id = $this->input->post('id');
        }

        $this->form_validation->set_rules('name', 'nama', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $parent_id = 0;
            if(!empty($this->input->post('parent_id'))){
                $parent_id = $this->input->post('parent_id');
            }

            $data = array
                (
                'name' => $this->input->post('name'),
                'url' => $this->input->post('url'),
                'parent_id' => $parent_id,
                'status' => $this->input->post('status')
            );

            $this->Menu->update($data,$id);
            $this->session->set_flashdata('success', 'Menu updated');
            redirect('admin/menus');
        }

        $this->data['menu'] = $this->Menu->findById($id);
        $this->data['menus'] = $this->Menu->findAll();
        $this->data['status'] = $this->Menu->status;
        $this->data['all_post_urls'] = $this->Post->all_urls();
        $this->load_admin('menus/edit');
    }

    function up($position = null) {
        if ($position == null) {
            $this->session->set_flashdata('error', 'Invalid Menu');
            redirect('admin/menus');
        } else {
            $currentMenu = $this->Menu->findByPosition($position);
            $prevMenu = $this->Menu->getPrevMenu($position);
            if (!empty($prevMenu)) {
                $currentMenuId = $currentMenu['id'];
                $currentMenuNewPosition = $prevMenu['position'];
                $this->Menu->setPosition($currentMenuId, $currentMenuNewPosition);

                $prevMenuId = $prevMenu['id'];
                $prevMenuNewPosition = $currentMenu['position'];
                $this->Menu->setPosition($prevMenuId, $prevMenuNewPosition);
                redirect('admin/menus');
            } else {
                $this->session->set_flashdata('error', 'No previous menu found');
                redirect('admin/menus');
            }
        }
    }

    function down($position = null) {
        if ($position == null) {
            $this->session->set_flashdata('error', 'Invalid Menu');
            redirect('admin/menus');
        } else {
            $currentMenu = $this->Menu->findByPosition($position);

            $nextMenu = $this->Menu->getNextMenu($position);

            if (!empty($nextMenu)) {
                $currentMenuId = $currentMenu['id'];
                $currentMenuNewPosition = $nextMenu['position'];
                $this->Menu->setPosition($currentMenuId, $currentMenuNewPosition);

                $nextMenuId = $nextMenu['id'];
                $nextMenuNewPosition = $currentMenu['position'];
                $this->Menu->setPosition($nextMenuId, $nextMenuNewPosition);
                redirect('admin/menus');
            } else {
                $this->session->set_flashdata('error', 'No next menu found');
                redirect('admin/menus');
            }
        }
    }

    function delete($id = null) {
        if ($id == null) {
            $this->session->set_flashdata('success', 'Invalid Menu');
            redirect('admin/menus');
        } else {
            $this->Menu->delete($id);
            $this->session->set_flashdata('success', 'Menu deleted');
            redirect('admin/menus');
        }
    }


}

?>
