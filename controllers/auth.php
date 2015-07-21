<?php 

Class Auth extends Controller{

	public function logout(){
		$this->users->logout();

		$this->header('/auth/login');
	}

	public function login(){
		if ($this->user['logged']){
			$this->header('/');
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
					$this->header('/');
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
			$this->header('/');
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
					$this->header('/auth/login');
				}
			}
		}

		$this->view->title = 'Registration';
		$this->view->errors = array_merge($errors, $this->users->errors);
		$this->view->render('auth/registration', $data);
	}
}