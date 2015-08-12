<?php

$version = 001;

$comments_sql = 'CREATE TABLE `comments` (
					`id` int PRIMARY KEY AUTO_INCREMENT,
					`prof_id` int NOT NULL,
					`title` varchar(30) NOT NULL,
					`estimate` int NOT NULL,
					`comment` text,
					`added` timestamp,
					FOREIGN KEY (prof_id) 
        				REFERENCES professors(id)
				)';
$comments = $this->db->query($comments_sql);

if ($comments) {
	$this->migrated($version);
} else {
	$this->error($version);
}