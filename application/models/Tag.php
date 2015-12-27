<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Model{

	var $table = 'tags';


	function find($limit = null, $offset = 0){
		$tags = $this->db->order_by('name','asc')->get($this->table, $limit, $offset)->result_array();
		return $tags;
	}

	function find_active(){
		$this->db->select('c.*');
		$this->db->join('tags c','pc.tag_id=c.id');
		$this->db->join('posts p','pc.post_id=p.id');
		$this->db->where('c.status',1);
		$this->db->where('p.status',1);
		$this->db->group_by('pc.tag_id');
		$this->db->order_by('c.name','asc');
		$tags = $this->db->get('posts_tags pc')->result_array();
		return $tags;
	}

	function create($tag){
		$tag['slug'] = url_title($tag['name'],'-',true);
		$this->db->insert($this->table, $tag);
	}

	function update($tag,$id){
		$tag['slug'] = url_title($tag['name'],'-',true);
		$this->db->where('id',$id);
		$this->db->update($this->table,$tag);
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