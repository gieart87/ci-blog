<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends CI_Model{

	var $table = 'assets';


	function find($limit = null, $offset = 0){
		$assets = $this->db->order_by('name','asc')->get($this->table, $limit, $offset)->result_array();
		return $assets;
	}

	function create($asset){
		$this->db->insert($this->table, $asset);
	}

	function update($asset,$id){
		$this->db->where('id',$id);
		$this->db->update($this->table,$asset);
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