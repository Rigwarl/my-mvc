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

		$comments_model = $this->loadModel('comments');
		$data['comments'] = $comments_model->getBy('prof_id', $id);

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

	public function comment($id){
		$professor = $this->model->getID($id);
		if (!$professor) throw new Exception('404');

		$comment = array(
			'title'    => '',
			'estimate' => '',
			'comment'  => ''
		);
		$errors = array();

		if (globals::is_post()) {
			// todo show message if saved and display comments
			$comment = globals::post(array(
				'title',
				'estimate',
				'comment'
			));
			$comment['prof_id'] = $id;
			$comment['estimate'] = (int) $comment['estimate'];

			$comments_model = $this->loadModel('comments');
			$comments_model->load($comment);
			$comments_model->validate();

			if ($comments_model->is_valid){
				$comment_id = $comments_model->add();

				if ($comment_id){
					// if saved redirect to professor page
					globals::set_session('added');
					$this->header("/professors/show/$id");
				} else {
					// if not saved show error
					$errors['save'] = true;
				}
			}

			$errors = array_merge($errors, $comments_model->errors);
		}

		$data = array_merge($comment, $professor);
		$this->view->errors = $errors;
		$this->view->title = $title = 'Rating professor ' . $data['name'] . ' ' . $data['patronymic'] . ' ' . $data['surname'];
		$this->view->render('professors/comment', $data);
	}
}