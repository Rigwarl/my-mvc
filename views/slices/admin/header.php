<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $this->title; ?></title>

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header class="container">
	<nav class="navbar navbar-default">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/admin">Админка</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<? html::nav(array(
				'Преподаватели' => '/admin/professors',
				'Комментарии'   => '/admin/comments'
			), 'nav navbar-nav'); ?>

			<? html::nav(array(
				'Вернуться на сайт' => '/',
				$this->user->get('login') => '#',
				'Выход' => '/auth/logout'
			), 'nav navbar-nav navbar-right'); ?>
		</div>
	</nav>
</header>