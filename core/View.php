<?php

Class View {

	public function render($name, $args = array()) {
		$file = '../views/' . $name . '.php';

		extract($args);

		if (file_exists($file)){
			require_once $file;
		} else {
			throw new Exception("файл $file не существует");
		}
	}

}