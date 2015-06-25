<?php

$url = $_SERVER["REQUEST_URI"];

if ($url !== '/') {
	$_GET['url'] = ltrim($url, '/');
}

require_once 'index.php';