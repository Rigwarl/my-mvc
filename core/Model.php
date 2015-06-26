<?php

Class Model {
	protected $db;
	public $table;

	function __construct(){

		$this->db = new PDO('mysql:host=127.0.0.1;dbname=mymvc', 'root', '123456');
	}

	public function getAll(){
		$sth = $this->db->query("SELECT * FROM {$this->table}");

		return $sth->fetchAll();
	}

	public function getID($id){
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id=:id");
		$sth->execute(array('id' => $id));

		return $sth->fetch();
	}
}