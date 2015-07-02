<?php

Class Users_Model extends Model{

	function __construct(){
		parent::__construct();
		$this->table = 'users';
		session_start();
	}

	public function login($data){
		// todo
		$user = $this->get(array(
			'login' => $data['login'],
			'password' => $data['password']
		))[0];

		if ($user) {
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $user['login'];
		}
	}
}