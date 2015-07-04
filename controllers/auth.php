<?php 

Class Auth extends Controller{

	public function index(){
		if ($_SESSION['logged']){
			header('Location: /');
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->auth();
		} else {
			$this->view->render('auth/login');
		}
	}

	private function auth(){
		$this->users->login($_POST);

		if ($_SESSION['logged']){
			header('Location: /');
		} else {
			$data = array('invalid' => true);
			$this->view->render('auth/login', $data);
		}
	}

	public function logout(){
		$this->users->logout();

		header('Location: /login');
	}
}