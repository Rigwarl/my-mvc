<?php

Class Model {
	protected $db;
	public $table;

	function __construct(){
		$this->db = new PDO('mysql:host=127.0.0.1;dbname=mymvc', 'root', '');
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

	public function save($data){
		$set = $this->sqlSet($data);

		$sth = $this->db->prepare("INSERT INTO {$this->table} SET $set");
		$sth->execute($data);
	}

	private function sqlSet($data){
		foreach ($data as $key => $param){
			$set .= $key . '=:' . $key . ', ';
		}

		return substr($set, 0, -2);
	}
}