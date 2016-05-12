<?php

Class Comments_Model extends Model{

	protected $rules = array(
		'prof_id'      => 'required',
		'user_id'      => 'required',
		'subject'      => 'required',
		'year'         => 'required|date:Y|min:1900|max:2100',
		'clarity'      => 'required|int|min:1|max:5',
		'knowledge'    => 'required|int|min:1|max:5',
		'interest'     => 'required|int|min:1|max:5',
		'helpfulness'  => 'required|int|min:1|max:5',
		'exactingness' => 'required|int|min:1|max:5',
		'hardness'     => 'required|int|min:1|max:5',
		'title'        => 'required',
		'comment'      => 'required'
	);

	public function getProfComments($prof_id, $status = NULL){
		$data = array('prof_id' => $prof_id);
		$status_sql = '';

		if ($status){
			$status_sql .= ' AND c.status=:status';
			$data['status'] = $status;
		}

		$sql = "SELECT c.id, c.added, c.subject, c.clarity, c.knowledge, c.interest, c.helpfulness, c.exactingness, c.hardness, c.title, c.comment, c.status, c.year, u.login
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

		$sql = "SELECT c.id, c.added, c.subject, c.clarity, c.knowledge, c.interest, c.helpfulness, c.exactingness, c.hardness, c.title, c.comment, c.status, c.year, u.login, p.name, p.patronymic, p.surname, p.start, p.end
				FROM users as u, comments as c, professors as p
				WHERE u.id = c.user_id AND p.id = c.prof_id$status_sql
				ORDER BY c.id DESC";

		$sth = $this->db->prepare($sql);
		$sth->execute($data);

		return $sth->fetchAll();
	}
}