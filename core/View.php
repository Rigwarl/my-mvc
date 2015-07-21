<?php

Class View {

	public $user;
	public $layout = 'default';
	private $args = array();
	// todo change title in all controllers
	public $title = 'mymvc';
	public $errors = array();

	protected function message($name){
		if (globals::session($name)){
			globals::unset_session($name);
			return true;
		}
		return false;
	}

	public function is_error($name, $value = true){
		$error = isset($this->errors[$name]) ? $this->errors[$name] : false;
		return $error == $value;
	}

	public function render($view, $args = array()) {
		$layout = '../views/layouts/' . $this->layout . '.php';
		$this->args = $args;

		require_once $layout;
	}

	private function loadSlice($slice){
		$file = '../views/slices/' . $slice . '.php';
		
		require_once $file;
	}

	private function loadPage($view){
		$file = '../views/pages/' . $view . '.php';
		extract($this->args);

		require_once $file;
	}
}