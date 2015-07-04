<?php

Class Model {
	private static $singleDb;
	protected $db;
	public $table;

	function __construct(){
		if (!self::$singleDb) {
			self::$singleDb = new PDO(
				DB_DRIVE . ':host=' . 
				DB_HOST . ';dbname=' .
				DB_NAME, 
				DB_USER,  
				DB_PASSWORD
			);
		}
		$this->db = self::$singleDb;
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

	public function get($data, $separator = 'AND'){
		$set = $this->sqlSet($data, $separator);
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $set");
		$sth->execute($data);

		return $sth->fetchAll();
	}

	public function save($data){
		//todo return state
		$set = $this->sqlSet($data);
		$sth = $this->db->prepare("INSERT INTO {$this->table} SET $set");
		$sth->execute($data);
	}

	private function sqlSet($data, $separator = ', '){
		foreach ($data as $key => $param){
			$set .= $key . '=:' . $key . ' ' . $separator . ' ';
		}

		return substr($set, 0, -4);
	}
}