<?php

Class Error {

	// mb just add error method to view...
	function __construct($view){
		$this->view = $view;
	}

	public function show($code) {
		http_response_code($code);

		$this->view->title = "Error $code";
		$this->view->render("errors/$code");

		exit();
	}
}