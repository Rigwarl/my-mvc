<?php

Class Users_Model extends Model{

	function __construct(){
		parent::__construct();
		$this->table = 'users';
		session_start();
	}

	public function login($data){
		$result = array();

		if ($data['login'] == '') {
			$result['login'] = 'Login required';
		}

		if ($data['password'] == '') {
			$result['password'] = 'Password required';
		}

		if (!$result) {
			$user = $this->get(array(
				'login' => $data['login'],
				'password' => $data['password']
			))[0];

			if ($user) {
				$_SESSION['logged'] = true;
				$_SESSION['login'] = $user['login'];
			} else {
				$result['incorrect'] = 'Login or password is incorrect';
			}
		}

		return $result;
	}

	public function logout(){
		// todo mb some session unsets
		session_destroy();
	}

	public function register($data){
		$result = array();

		if ($data['login'] == '') {
			$result['login'] = 'Login required';
		} elseif (strlen($data['login']) < 4) {
			$result['login'] = 'Login too short. Use at least 4 characters';
		} elseif ($this->get(array('login' => $data['login']))) {
			$result['login'] = 'Login '. $data['login'] .' already used.';
		}

		if ($data['password'] == '') {
			$result['password'] = 'Password required';
		} elseif (strlen($data['password']) < 6) {
			$result['password'] = 'Password too short. Use at least 6 characters';
		} elseif ($data['password'] !== $data['password2']) {
			$result['password'] = 'Passwords does not match';
			$result['password2'] = 'Passwords does not match';
		}

		if ($data['email'] == '') {
			$result['email'] = 'Email required';
		} elseif (!stripos($data['email'], '@') || !stripos($data['email'], '.')) {
			$result['email'] = 'Email invalid';
		} elseif ($this->get(array('email' => $data['email']))) {
			$result['email'] = 'Email '. $data['email'] .' already used.';
		}

		if (!$result) {
			$user = array(
				'login' => $data['login'],
				'password' => $data['password'],
				'email' => $data['email'],
			);
			// todo mb some check
			$this->save($user);
		}

		return $result;
	}
}