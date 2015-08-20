<?php 

Class Bootstrap {

	// todo router
	// class autoload
	// add model table autoload

	private $controller;
	private $users;
	private $is_admin = false;

	function __construct($url) {
		$url = explode('/', $url);

		$this->admin_check($url);

		$controller = isset($url[0]) ? $url[0] : 'home';
		$action = isset($url[1]) ? $url[1] : 'index';

		$arg = isset($url[2]) ? array_slice($url, 2) : null;	

		$this->loadUser();
		$this->loadController($controller);
		$this->loadModel($controller);
		$this->loadMethod($action, $arg);
	}

	private function admin_check(&$url){
		if ($url[0] === 'admin'){
			if (isset($url[1]) && $url[1] === 'migrate'){
				require_once 'Migration.php';
				new Migration();
			}
			array_shift($url);
			$this->is_admin = true;
		}
	}

	private function loadUser(){
		require_once '../models/users_model.php';
		$this->users = new Users_Model();
	}

	private function loadController($controller){
		if ($this->is_admin) {
			require_once '../core/Admin.php';
			$controller_file = '../controllers/admin/' . $controller . '.php';
		} else {
			$controller_file = '../controllers/' . $controller . '.php';
		}

		if (file_exists($controller_file)) {
			require_once $controller_file;
			$this->controller = new $controller($this->users);
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
			if (count($arg) === 1) {
				$arg = $arg[0];
			}

			$this->controller->$action($arg);
		} else {
			throw new Exception("404");
		}
	}
}