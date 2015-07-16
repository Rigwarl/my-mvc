<?php

Class View {

	public $user;
	public $layout = 'default';
	private $args = array();

	public function render($view, $args = array()) {
		$layout = '../views/layouts/' . $this->layout . '.php';
		$this->args = $args;

		require_once $layout;
	}

	private function loadSlice($slice){
		$file = '../views/slices/' . $slice . '.php';
		extract($this->args);
		
		require_once $file;
	}

	private function loadPage($view){
		$file = '../views/pages/' . $view . '.php';
		extract($this->args);

		require_once $file;
	}
}