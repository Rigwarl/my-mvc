<?php

Class Controller {

	public $model;
	protected $users;
	protected $user;
	protected $view;

	function __construct($users) {
		$this->users = $users;
		$this->user = $users->user;
		$this->view = new View;
		$this->view->user = $this->user;
	}

	protected function loadModel($model){
		$model_name = $model . '_model';
		require_once '../models/' . $model_name . '.php';
		return new $model_name();
	}
}