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
		$sql = 'UPDATE professors,
				(	SELECT AVG(estimate) as avg, COUNT(*) as count
					FROM comments
					WHERE prof_id=:id AND status="approved"
				) 	as result
				SET rating=result.avg, rated=result.count
				WHERE id=:id';

		$sth = $this->db->prepare($sql);

		return $sth->execute(array('id' => $id));
	}
}