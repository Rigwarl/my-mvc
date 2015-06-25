<?php

Class Home extends Controller {

	public function index(){
		$args = $this->model->getContent();

		$this->view->render('home/index', $args);
	}
}