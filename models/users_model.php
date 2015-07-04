<?php

Class Users_Model extends Model{

	function __construct(){
		parent::__construct();
		$this->table = 'users';
		session_start();
	}

	public function login($data){
		$user = $this->get(array(
			'login' => $data['login'],
			'password' => $data['password']
		))[0];

		if ($user) {
			$_SESSION['logged'] = true;
			$_SESSION['login'] = $user['login'];
		}
	}

	public function logout(){
		// todo mb some session unsets
		session_destroy();
	}

	public function register($data){
		//todo validation
		$user = array(
			'login' => $data['login'],
			'password' => $data['password'],
			'email' => $data['email'],
		);

		$this->save($user);
	}
}