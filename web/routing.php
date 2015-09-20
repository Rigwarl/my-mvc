<?php

// use it if run on php server

$url = $_SERVER["REQUEST_URI"];

if(file_exists($_SERVER["DOCUMENT_ROOT"] . $url)){
	return false;
}

if ($url !== '/') {
	$_GET['url'] = ltrim($url, '/');
}

require_once 'index.php';