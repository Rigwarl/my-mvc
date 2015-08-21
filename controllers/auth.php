<?php 

Class Auth extends Controller{

	function __construct($user){
		parent::__construct($user);
		$this->model = $this->loadModel('users');
	}

	public function logout(){
		$this->model->logout();

		$this->header('/auth/login');
	}

	public function login(){
		if ($this->user->get('id')){
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

			$this->model->load($data, 'login');
			$this->model->validate('login');

			if ($this->model->is_valid) {
				$user = $this->model->login();

				if ($user){
					$this->header($this->user->get('backlink'));
				}
			}
		}

		$this->view->title = 'Log in';
		$this->view->errors = $this->model->errors;
		$this->view->render('auth/login', $data);
	}

	public function register(){
		//todo capcha and encrypt
		if ($this->user->get('id')){
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

			$errors = validator::validate($data, array(
				'password2' => 'required|equal:password'
			));

			$this->model->load($data);
			$this->model->validate();

			if (!$errors && $this->model->is_valid){
				$user_id = $this->model->register();

				if ($user_id) {
					$this->header('/auth/login');
				}
			}
		}

		$this->view->title = 'Registration';
		$this->view->errors = array_merge($errors, $this->model->errors);
		$this->view->render('auth/registration', $data);
	}
}