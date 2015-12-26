<?php

class Menu extends CI_Model {

    // Protected or private properties
    var $table = 'menus';
    var $status = array(
        0 => 'Inactive',
        1 => 'Active'
    );

    // Constructor
    function __construct() {
        parent::__construct();
    }

    // Public methods
    public function findAll() {
        $this->db->select('*');
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function findActive() {

        $this->db->select('*');
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function findById($id) {
        $this->db->select('*');
        $this->db->where('id', $id);

        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    function findByUrl($url) {

        $this->db->where('url', $url);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    public function findList() {

        $data = array();
        $this->db->select('id, name,parent_id');

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['id']] = $row['name'];
            }

            $data[0] = '#';
        }
        $query->free_result();

        return $data;
    }

    function findByPosition($position) {
        $this->db->select('menus.*');
        $this->db->where('position', $position);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    public function create($data = array()) {

        $this->db->insert($this->table, $data);
    }

    function addPageToMenu($title, $url) {
        $data = array(
            'name' => $title,
            'url' => $url
        );


        $this->db->insert($this->table, $data);
    }

    public function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function setPosition($id, $position) {
        $data = array(
            'position' => $position
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function getPrevMenu($position) {
        $this->db->where('position <', $position);
        $this->db->order_by('position', 'DESC');
        $query = $this->db->get($this->table, 1);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getNextMenu($position) {
        $this->db->where('position >', $position);
        $this->db->order_by('position', 'ASC');
        $query = $this->db->get($this->table, 1);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    public function delete($id) {
        $this->db->where('id', $id);

        $this->db->delete($this->table);
    }

}