<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Post');
	}

	public function index()
	{
		$posts = $this->Post->find();
	}

	public function add(){

	}

	public function edit($id = null){

	}

	public function delete($id = null){
		
	}
}
