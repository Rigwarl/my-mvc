<?php

require_once '../config/db.php';
require_once '../core/bootstrap.php';
require_once '../core/controller.php';
require_once '../core/model.php';
require_once '../core/view.php';
require_once '../libs/html.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$app = new Bootstrap($url);