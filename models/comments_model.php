<?php

Class Comments_Model extends Model{

	protected $rules = array(
		'prof_id'  => 'required',
		'user_id'  => 'required',
		'title'    => 'required',
		'estimate' => 'required|int|min:1|max:10',
		'comment'  => 'required'
	);

	public function getProfComments($prof_id, $status = NULL){
		$data = array('prof_id' => $prof_id);
		$status_sql = '';

		if ($status){
			$status_sql .= ' AND c.status=:status';
			$data['status'] = $status;
		}

		$sql = "SELECT c.title, c.estimate, c.comment, u.login
				FROM users as u, comments as c
				WHERE u.id = c.user_id AND c.prof_id=:prof_id$status_sql
				ORDER BY c.id DESC";

		$sth = $this->db->prepare($sql);
		$sth->execute($data);

		return $sth->fetchAll();
	}

	public function getComments($status = NULL){
		$data = array();
		$status_sql = '';

		if ($status){
			$status_sql .= ' AND c.status=:status';
			$data['status'] = $status;
		}

		$sql = "SELECT c.id, c.status, c.title, c.estimate, c.comment, u.login, p.name, p.patronymic, p.surname
				FROM users as u, comments as c, professors as p
				WHERE u.id = c.user_id AND p.id = c.prof_id$status_sql
				ORDER BY c.id DESC";

		$sth = $this->db->prepare($sql);
		$sth->execute($data);

		return $sth->fetchAll();
	}
}