<?php

Class Professors extends Controller{

	public function index(){
		$args = array('professors' => $this->model->getAll());

		$this->view->render('professors/index', $args);
	}

}