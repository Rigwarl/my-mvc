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

	public function add(){
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
}