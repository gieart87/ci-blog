<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Setting extends CI_Model {

    var $table = 'settings';

    function __construct() {
        parent::__construct();
    }

    function create() {
        $data = array(
            'key' => $this->input->post('key'),
            'value' => $this->input->post('value'),
            'description' => $this->input->post('description')
        );

        $this->db->insert($this->table, $data);
    }

    function update($id) {
        $data = array(
            'value' => $this->input->post('value'),
            'description' => $this->input->post('description')
        );

        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function update_by_key($key,$value) {
        $data = array(
            'value' => $value
        );

        $this->db->where('key', $key);
        $this->db->update($this->table, $data);
    } 

    function findByKey($key) {
        $this->db->select('*');
        $this->db->where('key', $key);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            $result = $query->row_array();
            return $result['value'];
        }
    }

    function findById($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function findAll() {
        $this->db->select('*');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

?>
