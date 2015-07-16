<?php

$version = 000;

$options_sql = 'CREATE TABLE `options` (
					`name`  varchar(50) PRIMARY KEY,
					`value` varchar(50)
				)';
$options = $this->db->query($options_sql);

$users_sql = 'CREATE TABLE `users` (
				`id` int PRIMARY KEY AUTO_INCREMENT,
				`login` varchar(50) NOT NULL UNIQUE,
				`password` varchar(50) NOT NULL,
				`email` varchar(50) NOT NULL UNIQUE,
				`class` varchar(50) NOT NULL default "student",
				`registered` timestamp
			)';
$users = $this->db->query($users_sql);


$professors_sql = 'CREATE TABLE `professors` (
					`id` int PRIMARY KEY AUTO_INCREMENT,
					`name` varchar(30) NOT NULL,
					`patronymic` varchar(30) NOT NULL,
					`surname` varchar(30) NOT NULL,
					`birth` date  NOT NULL,
					`about` text
				)';
$professors = $this->db->query($professors_sql);

$this->table = 'users';
$admin = $this->save(array(
			'login' => 'admin',
			'password' => 'admin',
			'email' => 'admin@admin.admin',
			'class' => 'admin'
		));
$this->table = 'options';

if ($options && $users && $professors && $admin) {
	$this->migrated($version);
} else {
	$this->error($version);
}