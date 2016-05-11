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
		  <a class="navbar-brand" href="/">Ratemyprofessor</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<? html::nav(array(
				'Преподаватели' => '/professors'
			), 'nav navbar-nav'); ?>

			<?
			if ($this->user->get('id')) {
				$nav = array();

				if ($this->user->is('admin')){
					$nav['Админка'] = '/admin';
				}

				$nav += array(
					$this->user->get('login') => '#',
					'Выход' => '/auth/logout'
				);

			} else {
				$nav = array(
					'Войти' => '/auth/login',
					'Регистрация' => '/auth/register'
				);
			}

			html::nav($nav, 'nav navbar-nav navbar-right');
			?>
		</div>
	</nav>
</header>