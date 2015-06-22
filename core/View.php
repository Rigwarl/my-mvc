<?php

Class View {

	public $layout = 'default';
	private $args = array();

	public function render($view, $args = array()) {
		$layout = '../views/layouts/' . $this->layout . '.php';
		$this->args = $args;

		require_once $layout;
	}

	public function loadSlice($slice){
		$file = '../views/slices/' . $slice . '.php';

		require_once $file;
	}

	public function loadView($view){
		$file = '../views/' . $view . '.php';
		extract($this->args);

		require_once $file;
	}
}