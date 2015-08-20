<?php

$version = 001;

$comments_sql = 'CREATE TABLE `comments` (
					`id` int PRIMARY KEY AUTO_INCREMENT,
					`prof_id` int NOT NULL,
					`user_id` int NOT NULL,
					`status` varchar(15) NOT NULL default "new",
					`title` varchar(30) NOT NULL,
					`estimate` int NOT NULL,
					`comment` text,
					`added` timestamp,
					FOREIGN KEY (prof_id) 
        				REFERENCES professors(id),
        			FOREIGN KEY (user_id)
        				REFERENCES users(id)
				)';
$comments = $this->db->query($comments_sql);

$professors_sql = 'ALTER TABLE `professors`
					ADD rated int NOT NULL default 0,
					ADD rating decimal(3,1) NULL
				';
$professors = $this->db->query($professors_sql);

$this->migrated($comments && $professors);