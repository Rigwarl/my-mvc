<?php

Class Comments extends Admin{

	public function index(){
		$data['comments'] = $this->model->getComments();

		$this->view->title = 'All comments';
		$this->view->render('admin/comments/index', $data);
	}
}