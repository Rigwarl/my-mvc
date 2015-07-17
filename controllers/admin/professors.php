<?php

Class Professors extends Admin{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$data['title'] = 'Admin - Professors';
		$this->view->render('admin/professors/index', $data);
	}

	public function edit($id){
		if ($id !== 'new') {
			$data = $this->model->getId($id);
			if (!$data) {
				throw new exception('404');
			}

			$data['title'] = 'Admin - Edit professor' . $data['name'];
		} else {
			$data['title'] = 'Admin - New professor';
			$data['id'] = 'new';
		}

		$this->view->render('admin/professors/edit', $data);
	}

	public function save($id){
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			throw new exception('404');
		}

		if ($id === 'new') {
			$data = $this->model->add($_POST);
		} else {
			$data = $this->model->edit($_POST);
		}

		if (!$data) {
			$data['success'] = 'Saved';
			$this->view->render('admin/professors/edit' . $id);
		}

	}
}