<?php

Class Professors extends Admin{

	public function index(){
		$data = array('professors' => $this->model->getAll());

		$data['title'] = 'Admin - Professors';
		$this->view->render('admin/professors/index', $data);
	}
}