<?php

Class Admin extends Controller{

	function __construct($users) {
		parent::__construct($users);

		if (!$this->is_user('admin')) {
			throw new Exception('403');
		}

		$this->view->layout = 'admin';
	}
}