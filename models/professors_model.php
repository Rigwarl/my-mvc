<?php

Class Professors_Model extends Model{
	
	function __construct(){
		parent::__construct();
		$this->table = 'professors';
	}
}