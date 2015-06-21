<?php

Class Home extends Controller {

	public function index(){
		$model = $this->getModel('Home_model');
		$args = $model->getContent();

		$this->view->render('home/index', $args);
	}

	public function add(){
		$args = array(
			'title' => 'Home/add',
			'body' => 'hello world'
		);
		$this->view->render('home/add', $args);
	}
}