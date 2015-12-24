<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function print_data($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function message_box($msg, $status = 'success'){
	$response = '';
	if(!empty($msg)){
		$response = '<div class="alert alert-'.$status.' no-margin" style="margin-bottom:15px!important;">'.$msg.'</div>';
	}
	return $response;
}