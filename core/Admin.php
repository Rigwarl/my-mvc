<?php

Class Admin extends Controller{

	function __construct() {
		parent::__construct();

		if ($_SESSION['group'] !== 'admin') {
			throw new Exception('403');
		}

		$this->view->layout = 'admin';
	}
}