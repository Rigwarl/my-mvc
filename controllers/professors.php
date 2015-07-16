<?php

Class Professors extends Controller{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$data['title'] = 'Professors';
		$this->view->render('professors/index', $data);
	}

	public function show($id){
		$data = array('professor' => $this->model->getID($id));
		if (!$data)	throw new Exception('404');

		$this->view->render('professors/show', $data);
	}

}