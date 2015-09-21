<?php

Class Controller {

	public $model;
	protected $user;
	protected $view;

	function __construct($user, $view, $error) {
		$this->user = $user;
		$this->view = $view;
		$this->error = $error;
	}

	protected function loadModel($model){
		$model_name = $model . '_model';
		require_once '../models/' . $model_name . '.php';
		return new $model_name($model);
	}

	protected function header($url){
		header("Location: $url");
		exit;
	}

	protected function requireLogin(){
		if (!$this->user->get('id')) {
			globals::set_session(array(
				'require_login' => true
			));

			$this->header('/auth/login');
		}
	}
}