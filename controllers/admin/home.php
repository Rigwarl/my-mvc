<?php

Class Home extends Admin{

	public function index(){
		$this->view->render('admin/home/index');
	}
}