<?php

Class Controller {

	function __construct() {
		$this->view = new View();
	}

	public function getModel($name) {
		$file = '../models/' . $name . '.php';

		if (file_exists($file)){
			require_once $file;

			return new $name;

		} else {
			throw new Exception("файл $file не существует");
		}
	}

}