<?php

Class Comments extends Admin{

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

    public function change($id, $status){
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

		$this->header($this->user->get('backlink'));
	}

    public function edit($id){
        // update prof avg
        $comment = $this->model->getId($id);
        $errors = array();

        if (!$comment) {
            throw new Exception('404');
        }

        if (globals::is_post()) {
            $post = globals::post(array(
                'title',
                'estimate',
                'comment'
            ));

            $comment = array_merge($comment, $post);
            $comment['estimate'] = (int) $comment['estimate'];

            $this->model->load($comment);
            $this->model->validate();

            if ($this->model->is_valid) {
                $saved = $this->model->update($id);

                if ($saved) {
                    $this->view->msgs['saved'] = true;
                } else {
                    $errors['save'] = true;
                }
            }
        }

        $comment['id'] = $id;
        $this->view->title = 'Editing comment';
        $this->view->errors = array_merge($errors, $this->model->errors);
        $this->view->render('admin/comments/edit', $comment);
    }
}