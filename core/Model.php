<?php

Class Model {
	protected $db;
	public $table;

	function __construct(){

		$this->db = new PDO('mysql:host=127.0.0.1;dbname=mymvc', 'root', '123456');
	}

	public function getAll(){
		$all = $this->db->query("SELECT * FROM {$this->table}");

		return $all->fetchAll();
	}
}