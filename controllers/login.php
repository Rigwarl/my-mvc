<?php 

Class login extends Controller{

	public function index(){
		// check if already logged
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->auth();
		} else {
			$this->view->render('login/index');
		}
	}

	private function auth(){
		$this->users->login($_POST);

		if ($_SESSION['logged']){
			header('Location: /');
		} else {
			$data = array('invalid' => true);
			$this->view->render('login/index', $data);
		}
	}

	public function logout(){
		$this->users->logout();

		header('Location: /login');
	}
}