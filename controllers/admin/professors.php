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

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->save($data);
		}

		$this->view->render('admin/professors/edit', $data);
	}

	private function save($data){
		if ($data['id'] === 'new') {
			$data = $this->model->add($_POST);
			$data['id'] = 'new';
		} else {
			$data = $this->model->change($_POST);
		}

		if (!$data) {
			//todo get the id of saved elem
		} else {
		}

		$this->view->render('admin/professors/edit', $data);
	}
}