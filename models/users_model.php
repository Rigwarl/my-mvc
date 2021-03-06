<?php

Class Users_Model extends Model{

	// todo some check for unallowable symbols
	protected $rules = array(
		'login'    => 'required|min_len:4',
		'password' => 'required|min_len:6',
		'email'    => 'required|email'
	);

	protected $rules_login = array(
		'login'    => 'required',
		'password' => 'required'
	);

	public function login(){
		$user = $this->getOne($this->data_login);

		if ($user) {
			globals::set_session(array(
				'id'     => $user['id'],
				'login'  => $user['login'],
				'class'  => $user['class']
			));
		} else {
			$this->errors['incorrect'] = true;
		}

		return $user;
	}

	public function logout(){
		session_destroy();
	}

	public function register(){
		$user_id = 0;

		$login_exists = $this->getOneBy('login', $this->data['login']);
		$email_exists = $this->getOneBy('email', $this->data['email']);

		if ($login_exists) {
			$this->errors['login'] = 'exists';
		}

		if ($email_exists) {
			$this->errors['email'] = 'exists';
		}

		if (!$login_exists && !$email_exists) {
			$user_id = $this->save($this->data);

			if (!$user_id) {
				$this->errors['save'] = true;
			}
		}

		return $user_id;
	}
}