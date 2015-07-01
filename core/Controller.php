<?php

Class Controller {

	public $model;
	public $users;
	public $view;

	function __construct() {
		$this->view = new View;
	}

}