<?php

Class Comments extends Admin{

    // todo refactor, mb write router
    public function index(){
        $this->header('/admin/comments/all');
    }

    public function all(){
        $this->showComments('All comments');
    }

    public function newest(){
        $this->showComments('New comments', 'new');
    }

    public function approved(){
        $this->showComments('Approved comments', 'approved');
    }

    public function disapproved(){
        $this->showComments('Disapproved comments', 'disapproved');
    }

    private function showComments($title, $type = NULL){
        $data['comments'] = $this->model->getComments($type);

        $this->view->title = $title;
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

        $link = globals::server('HTTP_REFERER') ?: '/admin/comments/all';
		$this->header($link);
	}
}