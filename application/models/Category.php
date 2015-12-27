<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model{

	var $table = 'categories';


	function find($limit = null, $offset = 0, $conditions = array()){
		$categories = $this->db->where($conditions)->order_by('name','asc')->get($this->table, $limit, $offset)->result_array();
		return $categories;
	}

	function find_active(){
		$this->db->select('c.*');
		$this->db->join('categories c','pc.category_id=c.id');
		$this->db->join('posts p','pc.post_id=p.id');
		$this->db->where('c.status',1);
		$this->db->where('p.status',1);
		$this->db->group_by('pc.category_id');
		$this->db->order_by('c.name','asc');
		$categories = $this->db->get('posts_categories pc')->result_array();
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

	function find_by_slug($id){
		$this->db->where('slug',$id);
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