<?php

Class Professors extends Controller{

	public function index(){
		$data = array(
			'name'       => '',
			'patronymic' => '',
			'surname'    => '',
			'professors' => $this->model->getAll()
		);

		$this->view->title = 'All professors';
		$this->view->render('professors/index', $data);
	}

	public function show($id){
		$data = $this->model->getID($id);
		if (!$data)	throw new Exception('404');

		$this->view->title = $title = 'Professor ' . $data['name'] . ' ' . $data['patronymic'] . ' ' . $data['surname'];
		$this->view->render('professors/show', $data);
	}

	public function find(){
		$data = array();
		$search = globals::post(array('surname', 'name', 'patronymic'));

		if (!($search['name'] || $search['patronymic'] || $search['surname'])) {
			//if search rules empty show all
			$this->view->errors['empty'] = true;
			$data['professors'] = $this->model->getAll();
			$title = 'All professors';

		} else {
			//if not empty show relevant
			$data['professors'] = $this->model->find($search);
			$title = 'Search results for - ' . $search['name'] . ' ' . $search['patronymic'] . ' ' . $search['surname'];
		}

		$this->view->title = $title;
		$this->view->render('professors/index', array_merge($search, $data));
	}
}