<?php 

Class Bootstrap {

	//todo router

	private $controller;
	private $users;
	private $is_admin = false;

	function __construct($url) {
		$url = explode('/', $url);

		if ($url[0] === 'admin'){
			array_shift($url);
			$this->is_admin = true;
		}

		$controller = isset($url[0]) ? $url[0] : 'home';
		$action = isset($url[1]) ? $url[1] : 'index';
		$arg = isset($url[2]) ? $url[2] : null;	

		$this->loadUser();
		$this->loadController($controller);
		$this->loadModel($controller);
		$this->loadMethod($action, $arg);
	}

	private function loadUser(){
		require_once '../models/users_model.php';
		$this->users = new Users_Model();
	}

	private function loadController($controller){
		if ($this->is_admin) {
			if ($_SESSION['group'] !== 'admin') {
				throw new Exception('403');
			}
			$controller_file = '../controllers/admin/' . $controller . '.php';
		} else {
			$controller_file = '../controllers/' . $controller . '.php';
		}

		if (file_exists($controller_file)) {
			require_once $controller_file;
			$this->controller = new $controller();
			$this->controller->users = $this->users;
		} else {
			throw new Exception("404");
		}
	}

	private function loadModel($model){
		$model_name = $model . '_model';
		$model_file = '../models/' . $model_name . '.php';

		if (file_exists($model_file)) {
			require_once $model_file;
			$this->controller->model = new $model_name();
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