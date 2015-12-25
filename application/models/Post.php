<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model{

	var $table = 'posts';


	function find($limit = null, $offset = 0, $user_id = null, $q = null){
// 		SELECT pt.post_id AS `post_id`, GROUP_CONCAT(t.tag) AS `tags`
// FROM post_tags AS pt
// INNER JOIN tags AS t ON pt.tag_id = t.tag_id
// GROUP BY `post_id`
		$this->db->select('posts.*,users.username');
        $this->db->join('users', 'users.id = posts.user_id');
        if ($q != null) {
            $this->db->like('title', $q);
        }
        if($user_id != null){
        	$this->db->where('user_id',$user_id);
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('published_at', 'desc');
        $query = $this->db->get($this->table);

        return $query->result_array();
	}

	function create($post){
		$post['slug'] = url_title($post['title'],'-',true);
		$post['body'] = trim(preg_replace('/\s\s+/', ' ',$post['body']));
		$this->db->insert($this->table, $post);
	}

	function update($post,$id){
		$post['slug'] = url_title($post['title'],'-',true);
		$post['body'] = trim(preg_replace('/\s\s+/', ' ',$post['body']));
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
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