<?php 

Class Auth extends Controller{

	public function logout(){
		$this->users->logout();

		header('Location: /auth/login');
	}

	public function login(){
		if ($_SESSION['logged']){
			header('Location: /');
		}

		$data = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = $this->users->login($_POST);

			if (!$data){
				header('Location: /');
			}
		}

		$this->view->render('auth/login', $data);
	}

	public function register(){
		//todo capcha
		if ($_SESSION['logged']){
			header('Location: /');
		}

		$data = array();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = $this->users->register($_POST);
			
			if (!$data) {
				header('Location: /auth/login');
			}
		}
		$this->view->render('auth/registration', $data);
	}
}