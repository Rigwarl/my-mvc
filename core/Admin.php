<?php

Class Admin extends Controller{

	function __construct($users, $view, $error) {
		parent::__construct($users, $view, $error);

		if (!$this->user->is('admin')) {
			$this->error->show('403');
		}

		$this->view->layout = 'admin';
	}
}