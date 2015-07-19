<?php 

Class Migration extends Model{

	private $migrations;

	function __construct(){
		parent::__construct();
		$this->table = 'options';

		$db = $this->getOneBy('name', 'db');
		$version = $db ? $db['value'] : '-1';
		$this->migrations = glob('../migrations/*.php');

		$this->migrate($version);
	}

	private function migrate($version){
		$migration = isset($this->migrations[$version + 1]) ? $this->migrations[$version + 1] : false;

		if ($migration){
			require_once $migration;
		}
		die('migration done');
	}

	private function migrated($version){
		$sth = $this->db->prepare('UPDATE `options` SET `value`=:value WHERE `name`=:name');
		$migrated = $sth->execute(array(
			'name'  => 'db',
			'value' => $version
		));

		if ($migrated) {
			echo '<p>Migrated to version ' . $version . '</p>';
		} else {
			$this->error($version);
		}

		$this->migrate($version);
	}

	private function error($version){
		throw new exception('Can not migrate database to version ' . $version);
	}
}