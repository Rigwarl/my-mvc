<?php

Class Professors extends Controller{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$this->view->title = 'All professors';
		$this->view->render('professors/index', $data);
	}

	public function show($id){
		$data = $this->model->getID($id);
		if (!$data)	throw new Exception('404');

		$this->view->title = $title = 'Professor ' . $data['name'] . ' ' . $data['patronymic'] . ' ' . $data['surname'];
		$this->view->render('professors/show', $data);
	}
}