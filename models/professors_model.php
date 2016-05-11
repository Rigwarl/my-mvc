<?php

Class Professors_Model extends Model{

	protected $rules = array(
		'name'       => 'required',
		'patronymic' => 'required',
		'surname'    => 'required',
		'birth'      => 'required|date',
		'about'      => 'not_required'
	);

	public function recalc($id){
		$sql = 'UPDATE professors as p,
				(	SELECT AVG(clarity) as clarity, AVG(knowledge) as knowledge, AVG(interest) as interest, AVG(helpfulness) as helpfulness, AVG(exactingness) as exactingness, AVG(hardness) as hardness, COUNT(*) as count
					FROM comments
					WHERE prof_id=? AND status="approved"
				) 	as r
				SET p.clarity=r.clarity, p.knowledge=r.knowledge, p.interest=r.interest, p.helpfulness=r.helpfulness, p.exactingness=r.exactingness, p.hardness=r.hardness, p.rating=(r.clarity + r.knowledge + r.interest + r.helpfulness)/4, p.rated=r.count
				WHERE id=?';

		$sth = $this->db->prepare($sql);

		return $sth->execute(array($id, $id));
	}
}