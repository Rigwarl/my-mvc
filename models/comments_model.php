<?php

Class Comments_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'comments';
	}

	protected $rules = array(
		'title'    => 'required',
		'estimate' => 'required|int|min:1|max:10',
		'comment'  => 'required'
	);
}