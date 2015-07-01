<?php 

Class Bootstrap {

	private $controller;
	private $model;

	function __construct($url) {
		$url = explode('/', $url);

		$controller = $url[0];
		$action = isset($url[1]) ? $url[1] : 'index';
		$arg = isset($url[2]) ? $url[2] : null;

		$this->loadController($controller);
		$this->loadUser();
		$this->loadModel($controller);
		$this->loadMethod($action, $arg);
	}

	private function loadController($controller){
		$controller_file = '../controllers/' . $controller . '.php';

		if (file_exists($controller_file)) {
			require_once $controller_file;
			$this->controller = new $controller();
		} else {
			throw new Exception("404");
		}
	}

	private function loadUser(){
		require_once '../models/users_model.php';
		$this->controller->users = new Users_Model();
	}

	private function loadModel($model){
		$model_name = $model . '_model';
		$model_file = '../models/' . $model_name . '.php';

		if (file_exists($model_file)) {
			require_once $model_file;
			$this->model = new $model_name();
			$this->model->table = $model;
			$this->controller->model = $this->model;
		} 
	}

	private function loadMethod($action, $arg){
		if (method_exists($this->controller, $action)) {
			$this->controller->$action($arg);
		} else {
			throw new Exception("404");
		}
	}

}