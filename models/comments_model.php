<?php

Class Comments_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'comments';
	}

	protected $rules = array(
		'title'    => 'required',
		'estimate' => 'required|int|min:1|max:10',
		'comment'  => 'required',
		'prof_id'  => 'required'
	);

	public function add(){
		// todo transaction
		$comment_id = $this->save();

		if ($comment_id){
			// update prof rating only if comment saved
			$comments = $this->getBy('prof_id', $this->data['prof_id']);

			$rated = 0;
			$points = 0;

			foreach ($comments as $comment){
				$rated++;
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
}