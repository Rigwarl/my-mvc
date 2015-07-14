<?php

Class Home extends Controller{

	function __construct(){
		if ($_SESSION['group'] !== 'admin') {
			throw new Exception('403');
		}
	}

	public function index(){
		echo 'admin panel coming soon';
	}
}