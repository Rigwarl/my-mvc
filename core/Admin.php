<?php

Class Admin extends Controller{

	function __construct() {
		parent::__construct();

		if ($this->user['class'] !== 'admin') {
			throw new Exception('403');
		}

		$this->view->layout = 'admin';
	}
}