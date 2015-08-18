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
		$data['comments'] = $comments_model->getComments(array(
			'prof_id' => $id,
			'status'  => 'approved'
		));

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
		$this->requireLogin();

		$professor = $this->model->getID($id);
		if (!$professor) throw new Exception('404');

		// check last comment date
		$comments_model = $this->loadModel('comments');
		$last_comment = $comments_model->getOne(array(
			'prof_id' => $id,
			'user_id' => $this->user['id']
		));

		if ($last_comment){
			$last_comment_date = new DateTime($last_comment['added']);
			$interval = $last_comment_date->diff(new DateTime());

			if ($interval->m < 6){
				// if last comment this prof was in last 6 moths
				globals::set_session('wait');
				$this->header("/professors/show/$id");
			}
		}

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
			$comment['user_id'] = $this->user['id'];
			$comment['estimate'] = (int) $comment['estimate'];

			$comments_model->load($comment);
			$comments_model->validate();

			if ($comments_model->is_valid){
				$comment_id = $comments_model->save();

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