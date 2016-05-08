<?php

$version = 002;

$comments_sql = 'ALTER TABLE `comments`
          DROP COLUMN estimate,
          ADD year int NOT NULL,
          ADD clarity int NOT NULL,
          ADD knowledge int NOT NULL,
          ADD interest int NOT NULL,
          ADD helpfulness int NOT NULL,
          ADD exactingness int NOT NULL,
          ADD hardness int NOT NULL
        ';
$comments = $this->db->query($comments_sql);

$professors_sql = 'ALTER TABLE `professors`
          ADD clarity decimal(3,1) NULL,
          ADD knowledge decimal(3,1) NULL,
          ADD interest decimal(3,1) NULL,
          ADD helpfulness decimal(3,1) NULL
        ';
$professors = $this->db->query($professors_sql);

$this->migrated($comments && $professors);