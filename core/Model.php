<?php

Class Model {
	protected $db;
	public $table;

	// вынести работу с базой?
	function __construct(){
		echo 'k';
		$this->db = new PDO(
			DB_DRIVE . ':host=' . 
			DB_HOST . ';dbname=' .
			DB_NAME, 
			DB_USER,  
			DB_PASSWORD
		);
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

	public function get($data){
		$set = $this->sqlSet($data);
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $set");
		$sth->execute($data);

		return $sth->fetchAll();
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