<?php

Class Home extends Controller {

	public function index(){
		$data = array(
			'title' => 'Home/index',
			'body' => 'hello world'
		);

		$this->view->render('home/index', $data);
	}
}
