<?php

Class Professors extends Controller{

	public function index(){
		$model = $this->getModel('Professors_Model');

		$args = array('professors' => $model->getAll());

		$this->view->render('professors/index', $args);
	}

}