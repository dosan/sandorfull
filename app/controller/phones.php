<?php

class Phones extends Controller
{
	public function index()
	{
		require 'templates/layout.php';
	}

	public function getphones(){
		$ngPhones = $this->model('HomeModel');
		$data = $ngPhones->selectAll('products');
		echo json_encode($data);
	}
	public function get($phoneId){
		$ngPhones = $this->model('HomeModel');
		$data = $ngPhones->selectPhone($phoneId);
		echo json_encode($data);
	}
}