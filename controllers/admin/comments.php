<?php

Class Comments extends Admin{

	public function index(){
		$data['comments'] = $this->model->getComments();

		$this->view->title = 'All comments';
		$this->view->render('admin/comments/index', $data);
	}

	public function approve($id){
		$comment = $this->model->getId($id);
		if (!$comment) throw new Exception('404');

		$this->model->approve($id, $comment['prof_id']);

		$this->header('/admin/comments/index');
	}
}