<?php

Class Home extends Controller {

	public function index(){
		$data = array(
			'body' => 'hello world'
		);

		$this->view->title = 'home index';
		$this->view->render('home/index', $data);
	}
}
