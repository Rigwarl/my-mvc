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
		$this->view->title = 'New professor';

		if ($id){
			// save prof, we will show it on get method
			$data = $this->model->getId($id);

			// save prof to new var we will use it and show if update on post fail
			$data_old = $data;

			if (!$data_old) {
				throw new exception('404');
			}
		}

		if (globals::is_post()){
			//todo date format
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
					// if prof exists update
					if ($this->model->update($id)) {
						// if we updated him show success msg
						$this->view->msgs['saved'] = true;
					} else {
						//if not we show old data
						$errors['save'] = true;
						$data = $data_old;
					}
				} else {
					// if prof not exists create
					$id = $this->model->save();

					if ($id){
						// if saved redirect to his edit page
						globals::set_session('added');
						$this->header("/admin/professors/edit/$id");
					} else {
						// if not saved show error
						$errors['save'] = true;
					}
				}
			}
		}

		$data['id'] = $id;
		$this->view->errors = array_merge($errors, $this->model->errors);
		$this->view->title = 'Professor ' . $data['name'] . ' ' . $data['patronymic'] . ' ' . $data['surname'];
		$this->view->render('admin/professors/edit', $data);
	}
}