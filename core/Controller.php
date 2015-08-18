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

	protected function header($url){
		header("Location: $url");
		exit;
	}

	protected function is_user($class){
		if (is_array($class)){
			foreach ($class as $item){
				if ($this->user['class'] === $item){
					return true;
				}
			}
		} elseif ($this->user['class'] === $class){
			return true;
		}

		return false;
	}

	protected function requireLogin(){
		global $url;

		if (!$this->user['id']){
			globals::set_session(array(
				'require_login' => true,
				'backlink' => $url
			));

			$this->header('/auth/login');
		}
	}
}