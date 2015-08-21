<?php

Class Professors_Model extends Model{

	protected $rules = array(
		'name'       => 'required',
		'patronymic' => 'required',
		'surname'    => 'required',
		'birth'      => 'required|date',
		'about'      => 'not_required'
	);
}