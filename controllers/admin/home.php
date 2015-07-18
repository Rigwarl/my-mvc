<?php

Class Home extends Admin{

	public function index(){
		$data['title'] = 'Admin - Home';

		$this->view->render('admin/home/index', $data);
	}
}