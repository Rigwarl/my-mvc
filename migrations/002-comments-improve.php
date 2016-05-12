<?php

$version = 002;

$comments_sql = 'ALTER TABLE `comments`
          DROP `estimate`,
          MODIFY `added` timestamp NOT NULL default CURRENT_TIMESTAMP,
          ADD `subject` varchar(30) NOT NULL,
          ADD `year` int NOT NULL,
          ADD `clarity` int NOT NULL,
          ADD `knowledge` int NOT NULL,
          ADD `interest` int NOT NULL,
          ADD `helpfulness` int NOT NULL,
          ADD `exactingness` int NOT NULL,
          ADD `hardness` int NOT NULL
        ';
$comments = $this->db->query($comments_sql);

$professors_sql = 'ALTER TABLE `professors`
          ADD `start` YEAR(4) NULL,
          ADD `end` YEAR(4) NULL,
          ADD `clarity` decimal(3,1) NULL,
          ADD `knowledge` decimal(3,1) NULL,
          ADD `interest` decimal(3,1) NULL,
          ADD `helpfulness` decimal(3,1) NULL,
          ADD `exactingness` decimal(3,1) NULL,
          ADD `hardness` decimal(3,1) NULL
        ';
$professors = $this->db->query($professors_sql);

$this->migrated($comments && $professors);