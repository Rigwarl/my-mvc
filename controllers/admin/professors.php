<?php

Class Professors extends Admin{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$this->view->title = 'Admin - Professors';
		$this->view->render('admin/professors/index', $data);
	}

	public function edit($id){
		$data = array(
			'name' => '',
			'patronymic' => '',
			'surname' => '',
			'birth' => '',
			'about' => ''
		);
		$errors = array();

		if ($id){
			$data = $this->model->getId($id);

			if (!$data) {
				throw new exception('404');
			}
		}

		if (globals::is_post()){
			//todo date format
			//todo update if exists
			$data = globals::post(array(
				'name',
				'patronymic',
				'surname',
				'birth',
				'about'
			));

			$this->model->load($data);
			$this->model->validate();

			if ($this->model->is_valid){
				if ($id) {
					if ($this->model->update($id)) {
						$this->view->msgs['saved'] = true;
					} else {
						$errors['save'] = true;
						$data = $this->model->getId($id);
					}
				} else {
					$id = $this->model->save();

					if ($id){
						globals::set_session('added');
						$this->header("/admin/professors/edit/$id");
					} else {
						$errors['save'] = true;
					}
				}
			}
		}

		$data['id'] = $id;
		$this->view->errors = array_merge($errors, $this->model->errors);
		$this->view->title = 'Professors edit';
		$this->view->render('admin/professors/edit', $data);
	}
}