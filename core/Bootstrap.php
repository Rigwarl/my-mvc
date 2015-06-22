<?php 

Class Bootstrap {

	function __construct() {
		$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
		$url = explode('/', $url);

		$controller = $url[0];
		$action = isset($url[1]) ? $url[1] : 'index';
		$arg = isset($url[2]) ? $url[2] : null;

		$controller = $this->loadController($controller);
		$this->loadMethod($controller, $action, $arg);
	}

	private function loadController($controller){
		$controller_file = '../controllers/' . $controller . '.php';

		if (file_exists($controller_file)) {
			require_once $controller_file;
			return new $controller;
		} else {
			throw new Exception("404");
		}
	}

	private function loadMethod($controller, $action, $arg){
		if (method_exists($controller, $action)) {
			$controller->$action($arg);
		} else {
			throw new Exception("404");
		}
	}

}