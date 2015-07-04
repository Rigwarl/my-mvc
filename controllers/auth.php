<?php 

Class Auth extends Controller{

	public function login(){
		if ($_SESSION['logged']){
			header('Location: /');
		}

		$data = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->users->login($_POST);

			if ($_SESSION['logged']){
				header('Location: /');
			}

			$data['invalid'] = true;
		}

		$this->view->render('auth/login', $data);
	}

	public function logout(){
		$this->users->logout();

		header('Location: /auth/login');
	}

	public function register(){
		//todo validation
		if ($_SESSION['logged']){
			header('Location: /');
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->users->register($_POST);
		} else {
			$this->view->render('auth/registration');
		}
	}
}