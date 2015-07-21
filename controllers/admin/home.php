<?php

Class Home extends Admin{

	public function index(){
		$this->view->title = 'Admin - Home';
		$this->view->render('admin/home/index');
	}
}