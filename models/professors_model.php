<?php

Class Professors_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'professors';
	}

	// todo date validation
	protected $rules = array(
		'name'       => 'required',
		'patronymic' => 'required',
		'surname'    => 'required',
		'birth'      => 'required|date',
		'about'      => 'not_required'
	);
}