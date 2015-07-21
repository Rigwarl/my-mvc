<?php 

Class Auth extends Controller{

	public function logout(){
		$this->users->logout();

		header('Location: /auth/login');
	}

	public function login(){
		if ($this->user['logged']){
			header('Location: /');
		}

		$data = array(
			'login' => '',
			'password' => ''
		);

		if (globals::is_post()) {
			$data = globals::post(array(
				'login', 
				'password'
			));

			$this->users->load($data, 'login');
			$this->users->validate('login');

			if ($this->users->is_valid) {
				$user = $this->users->login();

				if ($user){
					header('Location: /');
				}
			}
		}

		$this->view->title = 'Log in';
		$this->view->errors = $this->users->errors;
		$this->view->render('auth/login', $data);
	}

	public function register(){
		//todo capcha and encrypt
		if ($this->user['logged']){
			header('Location: /');
		}

		$data = array(
			'login' => '',
			'password' => '',
			'password2' => '',
			'email' => ''
		);

		$errors = array();

		if (globals::is_post()) {
			$data = globals::post(array(
				'login',
				'password',
				'password2',
				'email'
			));

			$errors = validate($data, array(
				'password2' => 'required|equal:password'
			));

			$this->users->load($data);
			$this->users->validate();

			if (!$errors && $this->users->is_valid){
				$user_id = $this->users->register();

				if ($user_id) {
					header('Location: /auth/login');
				}
			}
		}

		$this->view->title = 'Registration';
		$this->view->errors = array_merge($errors, $this->users->errors);
		$this->view->render('auth/registration', $data);
	}
}