<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{

	var $table = 'categories';


	function find($limit = null, $offset = 0){
		$categories = $this->db->order_by('name','asc')->get($this->table, $limit, $offset)->result_array();
		return $categories;
	}

	function create($category){
		$category['slug'] = url_title($category['name'],'-',true);
		$this->db->insert($this->table, $category);
	}

	function update($category,$id){
		$category['slug'] = url_title($category['name'],'-',true);
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

}