<?php
defined('BASEPATH') OR exit('No direct scriu access allowed');

class Group extends CI_Model{

	var $table = 'groups';


	function find($limit = null, $offset = 0){
		$categories = $this->db->order_by('name','asc')->get($this->table, $limit, $offset)->result_array();
		return $categories;
	}

	function create($category){
		$this->db->insert($this->table, $category);
	}

	function update($category,$id){
		$this->db->where('id',$id);
		$this->db->update($this->table,$category);
	}

	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

	function find_by_id($id){
		$this->db->where('id',$id);
		return $this->db->get($this->table,1)->row_array();
	}

	function find_list(){
		$this->db->order_by('name','asc');
		$query = $this->db->get($this->table);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$row['id']] = $row['name'];
            }
        }
        return $data;
	}
}