<?php

Class Users_Model extends Model{

	public $user;

	function __construct(){
		parent::__construct();
		$this->table = 'users';

		session_start();
		$this->user = array(
			'logged' => isset($_SESSION['logged']),
			'login' => isset($_SESSION['login']) ? $_SESSION['login'] : null,
			'class' => isset($_SESSION['class']) ? $_SESSION['class'] : null
		);
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
			$users = $this->get(array(
				'login' => $data['login'],
				'password' => $data['password']
			));

			if ($users) {
				$user = $users[0];
				$_SESSION['logged'] = true;
				$_SESSION['login'] = $user['login'];
				$_SESSION['class'] = $user['class'];
			} else {
				$result['incorrect'] = 'Login or password is incorrect';
			}
		}

		return $result;
	}

	public function logout(){
		// todo mb some unsets?
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
			// todo some check for unallowable symbols
			$saved = $this->save($user);

			if (!$saved) {
				$result['error'] = 'Sorry, something went wrong. Plese try later...';
			}
		}

		return $result;
	}
}