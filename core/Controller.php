<?php

Class Controller {

	public $model;
	protected $user;
	protected $view;

	function __construct($user) {
		$this->user = $user;
		$this->view = new View;
		$this->view->user = $this->user;
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
		global $url;

		if (!$this->user->get('id')) {
			globals::set_session(array(
				'require_login' => true
			));

			$this->header('/auth/login');
		}
	}
}