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

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = $_POST;
			$this->users->load($data, 'login');
			$this->users->validate('login');

			if ($this->users->is_valid) {
				$user = $this->users->login($data);

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
		//todo capcha
		if ($this->user['logged']){
			header('Location: /');
		}

		$data = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = $this->users->register($_POST);
			
			if (!$data) {
				header('Location: /auth/login');
			}
		}

		$data['title'] = 'Registration';
		$this->view->render('auth/registration', $data);
	}
}