<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		redirect('admin/posts');
		// $this->data['welcome'] = 'Ini adalah halaman admin';
		// $this->render('admin/dashboard/index');
	}
}