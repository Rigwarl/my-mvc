<?php 

Class Bootstrap {

	function __construct() {

		$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
		$url = explode('/', $url);

		$controller = $url[0];
		$controller_file = '../controllers/' . $controller . '.php';

		$action = isset($url[1]) ? $url[1] : 'index';

		if (file_exists($controller_file)) {
			require_once $controller_file;

			$controller = new $controller();

			if (method_exists($controller, $action)) {
				if (isset($url[2])) {
					$controller->$action($url);
				} else {
					$controller->$action();
				}
			} else {
				throw new Exception("у контроллера $controller_file метода $action не существует");
			}
		} else {
			throw new Exception("контроллера $controller_file не существует");
		}
	}

}