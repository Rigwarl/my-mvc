<?php

Class Professors extends Admin{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$this->view->title = 'Admin - Professors';
		$this->view->render('admin/professors/index', $data);
	}

	public function comments($id, $status){
		// status can be in this states or NULL
		if ($status !== 'all' && $status !== 'approved' && $status !== 'disapproved' && $status !== 'newest') {
		    throw new Exception('404');
		}

		$professor = $this->model->getId($id);

		if (!$professor){
			throw new Exception('404');
		}

		$status = ($status === 'all') ? NULL : $status;
		$comments_model = $this->loadModel('comments');
		$professor['comments'] = $comments_model->getProfComments($id, $status);

		$this->view->title = 'Comments about professor '. $professor['name'] . ' ' . $professor['patronymic'] . ' ' . $professor['surname'];
		$this->view->render('admin/professors/comments', $professor);
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
		$title = 'New professor';

		if ($id){
			// save prof to var, we will show it on get method
			$data = $this->model->getId($id);

			if (!$data){
				throw new exception('404');
			}
				

			// save prof to new var we will use it and show if update on post fail
			$data_old = $data;
			
			$title = 'Professor ' . $data['name'] . ' ' . $data['patronymic'] . ' ' . $data['surname'];
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
		$this->view->title = $title;
		$this->view->render('admin/professors/edit', $data);
	}
}