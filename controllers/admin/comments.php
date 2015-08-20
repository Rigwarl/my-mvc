<?php

Class Comments extends Admin{

	public function index(){
        $data['comments'] = $this->model->getComments();

        $this->view->title = 'All comments';
        $this->view->render('admin/comments/index', $data);
    }

    public function change($data){
        $id = $data[0];
        $status = $data[1];

        // status can be changed only to this states
        if ($status !== 'approve' && $status !== 'disapprove') {
            throw new Exception('404');
        }

		$comment = $this->model->getId($id);

		if (!$comment) {
            throw new Exception('404');
        }

		$changed = $this->model->changeStatus($id, $comment['prof_id'], $status . 'd');

		if (!$changed) {
            globals::set_session('not_changed');
        }

		$this->header('/admin/comments/index');
	}
}