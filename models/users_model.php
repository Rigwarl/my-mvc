<?php

Class Users_Model extends Model{

	function __construct(){
		parent::__construct();
		session_start();
	}
}