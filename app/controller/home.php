<?php

class Home extends Controller
{
	public function index()
	{
		$mod = $this->model('OOPModel');
		$result = $mod->home();
		require VIEWS_PATH.'layouts'.DS.'header.php';
		require VIEWS_PATH.'home'.DS.'home.php';
		require VIEWS_PATH.'layouts'.DS.'footer.php';
	}
}