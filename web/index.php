<?php

require_once '../config/config.php';

require_once '../core/Bootstrap.php';
require_once '../core/User.php';
require_once '../core/View.php';
require_once '../core/Error.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';

require_once '../libs/validator.php';
require_once '../libs/globals.php';
require_once '../libs/html.php';

if (DEVELOP) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('error_reporting', E_ALL);
} else {
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
}

$url = rtrim(globals::get('url'), '/');

$app = new Bootstrap($url);