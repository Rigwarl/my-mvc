<?php

Class Controller {

	public $model;
	public $users;
	public $view;

	function __construct() {
		$this->view = new View;
	}

	protected function loadModel($model){
		$model_name = $model . '_model';
		require_once '../models/' . $model_name . '.php';
		return new $model_name();
	}
}