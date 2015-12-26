<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Public_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Post');
	}

	public function index()
	{
		$posts = $this->Post->find();
	}

	public function read($slug){
		$this->data['post'] = $this->Post->find_by_slug($slug);
		$this->data['header'] = $this->load->view('themes/'.$this->theme.'/posts/header',$this->data, TRUE);
		$this->data['page_title'] = $this->data['post']['title'];
		$this->render('posts/read');
	}
}
