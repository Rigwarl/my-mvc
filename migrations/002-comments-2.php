<?php

$version = 002;

$comments_sql = 'ALTER TABLE `comments` 
					ADD status varchar(10) NOT NULL default "new"
				';
$comments = $this->db->query($comments_sql);

$professors_sql = 'ALTER TABLE `professors`
					ADD rated int NOT NULL default 0,
					ADD rating int NULL
				';
$professors = $this->db->query($professors_sql);

if ($comments && $professors) {
	$this->migrated($version);
} else {
	$this->error($version);
}