<?php

Class Comments extends Admin{

    public function index(){
        $this->header('/admin/comments/all');
    }

    public function all(){
        $this->showComments('Все комментарии');
    }

    public function newest(){
        $this->showComments('Новые комментарии', 'new');
    }

    public function approved(){
        $this->showComments('Одобренные комментарии', 'approved');
    }

    public function disapproved(){
        $this->showComments('Отклоненные комментарии', 'disapproved');
    }

    private function showComments($title, $type = NULL){
        $data['comments'] = $this->model->getComments($type);

        $this->view->title = $title;
        $this->view->render('admin/comments/index', $data);
    }

    public function change($id, $status){
        // status can be changed only to this states
        if ($status !== 'approve' && $status !== 'disapprove') {
            $this->error->show('404');
        }

		$comment = $this->model->getId($id);

		if (!$comment) {
            $this->error->show('404');
        }

        $updated = $this->model->update($id, array('status' => $status . 'd'));

        $professors_model = $this->loadModel('professors');
		$recalculated = $professors_model->recalc($comment['prof_id']);

		if (!$updated || !$recalculated) {
            globals::set_session('not_changed');
        }

		$this->header($this->user->get('backlink'));
	}

    public function edit($id){
        $comment = $this->model->getId($id);
        $errors = array();

        if (!$comment) {
            $this->error->show('404');
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

                $professors_model = $this->loadModel('professors');
                $recalc = $professors_model->recalc($comment['prof_id']);

                if ($saved && $recalc) {
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