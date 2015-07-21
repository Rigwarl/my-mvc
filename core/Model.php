<?php

Class Model {
	private static $singleDb;
	protected $db;
	public $table;
	protected $data = array();
	protected $rules = array();
	public $errors = array();
	public $is_valid = false;

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

	public function load($data, $name = ''){
		$name = $name ? "_$name" : "";
		foreach ($this->{'rules' . $name} as $key => $item){
			$this->{'data' . $name}[$key] = isset($data[$key]) ? $data[$key] : ''; 
		}
		return $this;
	}

	public function validate($name = ''){
		$name = $name ? "_$name" : "";
		$this->errors = validate($this->{'data' . $name}, $this->{'rules' . $name});

		if (!$this->errors) {
			$this->is_valid = true;
		}
		return $this->is_valid;
	}

	// db methods
	public function getAll(){
		$sth = $this->db->prepare("SELECT * FROM {$this->table}");
		$sth->execute();
		
		return $sth->fetchAll();
	}

	public function get($data, $separator = 'AND'){
		$set = $this->sqlSet($data, $separator);
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $set");
		$sth->execute($data);

		return $sth->fetchAll();
	}

	public function getOne($data, $separator = 'AND'){
		$set = $this->sqlSet($data, $separator);
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $set");
		$sth->execute($data);

		return $sth->fetch();
	}

	public function getBy($name, $value){
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $name=:$name");
		$sth->execute(array($name => $value));

		return $sth->fetchAll();
	}

	public function getOneBy($name, $value){
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE $name=:$name");
		$sth->execute(array($name => $value));

		return $sth->fetch();
	}

	public function getID($id){
		$sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id=:id");
		$sth->execute(array('id' => $id));

		return $sth->fetch();
	}

	public function save($data = null){
		if ($data === null){
			$data = $this->data;
		}
		$set = $this->sqlSet($data);
		$sth = $this->db->prepare("INSERT INTO {$this->table} SET $set");
		$sth->execute($data);

		return $this->db->lastInsertId();
	}

	private function sqlSet($data, $separator = ', '){
		$set = '';
		foreach ($data as $key => $param){
			$set .= $key . '=:' . $key . ' ' . $separator . ' ';
		}

		return substr($set, 0, -4);
	}
}