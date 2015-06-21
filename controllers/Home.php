<?php

Class Home extends Controller {

	public function index(){
		$args = array(
			'title' => 'Home/index',
			'body' => 'hello world'
		);
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