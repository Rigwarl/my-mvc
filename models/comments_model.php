<?php

Class Comments_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'comments';
	}

	protected $rules = array(
		'prof_id'  => 'required',
		'user_id'  => 'required',
		'title'    => 'required',
		'estimate' => 'required|int|min:1|max:10',
		'comment'  => 'required'
	);

	public function approve(){
		// todo transaction
		$comment_id = $this->save();

		if ($comment_id){
			// update prof rating only if comment saved
			$comments = $this->getBy('prof_id', $this->data['prof_id']);

			$rated = count($comments);
			$points = 0;
			
			foreach ($comments as $comment){
				$points += $comment['estimate'];
			}

			$rating = $points/$rated;

			$this->table = 'professors';
			$this->update($this->data['prof_id'], array(
				'rated'  => $rated,
				'rating' => $rating
			));
		}

		return $comment_id;
	}

	public function disapprove(){

	}

	public function getProfComments($prof_id, $status = NULL){
		$data = array('prof_id' => $prof_id);

		$sql = 'SELECT 
					c.title, c.estimate, c.comment, u.login
				FROM 
					users as u, comments as c
				WHERE
					u.id = c.user_id
					AND c.prof_id=:prof_id';

		if ($status){
			$sql .= ' AND c.status=:status';
			$data['status'] = $status;
		}

		$sth = $this->db->prepare($sql);
		$sth->execute($data);

		return $sth->fetchAll();
	}

	public function getComments($status = NULL){
		$data = array();

		$sql = 'SELECT 
					c.id, c.status, c.title, c.estimate, c.comment, u.login, p.name, p.patronymic, p.surname
				FROM 
					users as u, comments as c, professors as p
				WHERE
					u.id = c.user_id
					AND p.id = c.prof_id';

		if ($status){
			$sql .= ' AND c.status=:status';
			$data['status'] = $status;
		}

		$sth = $this->db->prepare($sql);
		$sth->execute($data);

		return $sth->fetchAll();
	}
}