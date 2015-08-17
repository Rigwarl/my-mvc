<?php 

Class Migration extends Model{

	private $migrations;
	private $version;

	function __construct(){
		parent::__construct();
		$this->table = 'options';

		// check if table exists
		// todo change it to direct check if table exists, now it will catch any error
		try {
			$this->version = $this->getOneBy('name', 'db');
		} catch(Exception $e) {
			$this->version = -1;
		}

		$this->migrations = glob('../migrations/*.php');
		$this->migrate();
	}

	private function migrate(){
		// check if here any migrations above
		// todo check filename
		$next = ++$this->version;
		$migration = isset($this->migrations[$next]) ? $this->migrations[$next] : false;

		if ($migration){
			require_once $migration;
		}
		die('migration done');
	}

	private function migrated($condition){
		if (!$condition) {
			$this->error();
		}

		$sth = $this->db->prepare('UPDATE `options` SET `value`=:value WHERE `name`=:name');
		$migrated = $sth->execute(array(
			'name'  => 'db',
			'value' => $this->version
		));

		if ($migrated) {
			echo '<p>Migrated to version ' . $this->version . '</p>';
		} else {
			$this->error();
		}

		$this->migrate();
	}

	private function error(){
		throw new exception('Can not migrate database to version ' . $this->version);
	}
}