<?php
defined('BASEPATH') OR exit('No direct scriu access allowed');

class User extends CI_Model{

	var $table = 'users';


	function find($limit = null, $offset = 0){

		$this->db->select('ug.user_id, u.*, GROUP_CONCAT(g.name) AS groups');
		$this->db->join('groups g','ug.group_id=g.id');
		$this->db->join('users u','ug.user_id=u.id');
		$this->db->group_by('ug.user_id');
		$users = $this->db->get('users_groups ug',$limit,$offset)->result_array();
		return $users;
	}

	function create($user){
		$this->db->insert($this->table, $user);
	}

	function update($user,$id){
		$this->db->where('id',$id);
		$this->db->update($this->table,$user);
	}

	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

	function find_by_id($id){
		$this->db->select('ug.user_id, u.*, GROUP_CONCAT(g.id) AS group_ids,GROUP_CONCAT(g.name) AS groups');
		$this->db->join('groups g','ug.group_id=g.id');
		$this->db->join('users u','ug.user_id=u.id');
		$this->db->group_by('ug.user_id');
		$this->db->where('u.id',$id);
		return $this->db->get('users_groups ug')->row_array();
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