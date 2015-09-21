<?php 

Class Bootstrap {

	// todo router
	// class autoload

	private $user;
	private $view;
	private $error;
	private $controller;
	private $is_admin = false;

	function __construct($url) {
		$url = $url ?: 'home';
		$url = explode('/', $url);

		$this->adminCheck($url);

		$controller = isset($url[0]) ? $url[0] : 'home';
		$action = isset($url[1]) ? $url[1] : 'index';

		$arg1 = isset($url[2]) ? $url[2] : NULL;	
		$arg2 = isset($url[3]) ? $url[3] : NULL;

		$this->user = new User();
		$this->view = new View($this->user);
		$this->error = new Error($this->view);

		$this->loadController($controller);
		$this->loadModel($controller);
		$this->loadMethod($action, $arg1, $arg2);
	}

	private function adminCheck(&$url){
		if ($url[0] === 'admin'){
			if (isset($url[1]) && $url[1] === 'migrate'){
				require_once 'Migration.php';
				new Migration();
			}
			array_shift($url);
			$this->is_admin = true;
		}
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
			$this->controller = new $controller($this->user, $this->view, $this->error);
		} else {
			$this->error->show('404');
		}
	}

	private function loadModel($controller){
		$model_name = $controller . '_model';
		$model_file = '../models/' . $model_name . '.php';

		if (file_exists($model_file)) {
			require_once $model_file;
			$this->controller->model = new $model_name($controller);
		} 
	}

	private function loadMethod($action, $arg1, $arg2){
		if (method_exists($this->controller, $action)) {
			// page exists, update links and load action
			$this->user->updateLinks();

			$this->controller->$action($arg1, $arg2);
		} else {
			throw new Exception("404");
		}
	}
}