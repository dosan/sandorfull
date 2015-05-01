<?php

class Phones extends Controller
{
	public function index()
	{
		require VIEWS_PATH.'home'.DS.'index.php';
	}

	public function getphones(){
		$ngPhones = $this->model('HomeModel');
		$data = $ngPhones->selectAll('ng-phones');
		echo json_encode($data);
	}
}