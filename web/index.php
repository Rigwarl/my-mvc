<?php

require_once '../config/general.php';
require_once '../config/errors.php';
require_once '../config/db.php';

require_once '../core/bootstrap.php';
require_once '../core/controller.php';
require_once '../core/model.php';
require_once '../core/view.php';

require_once '../libs/validator.php';
require_once '../libs/globals.php';
require_once '../libs/html.php';

$url = rtrim(globals::get('url'), '/') ?: 'home';

$app = new Bootstrap($url);