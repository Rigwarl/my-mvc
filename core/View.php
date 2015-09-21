<?php

Class View {

	public $user;
	public $layout = 'default';
	public $title = 'mymvc';
	public $errors = array();
	public $msgs = array();
	private $args = array();

	function __construct($user) {
		$this->user = $user;
	}

	public function render($view, $args = array()) {
		$layout = '../views/layouts/' . $this->layout . '.php';
		$this->args = $args;

		require_once $layout;
	}

	// sms - session message!
	protected function sms($name){
		return globals::extract_session($name);
	}

	protected function msg($name, $value = true){
		$msg = isset($this->msgs[$name]) ? $this->msgs[$name] : false;
		return $msg == $value;
	}

	private function is_error($name, $value = true){
		$error = isset($this->errors[$name]) ? $this->errors[$name] : false;
		return $error == $value;
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