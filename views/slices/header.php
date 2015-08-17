<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->title; ?></title>

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
		  <a class="navbar-brand" href="/">Brand</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<?php html::nav(array(
				'Professors' => 'professors'
			), 'nav navbar-nav'); ?>

			<?php
			if ($this->user['id']) {
				html::nav(array(
					$this->user['login'] => '#',
					'Logout' => 'auth/logout'
				), 'nav navbar-nav navbar-right');
			} else {
				html::nav(array(
					'Login' => 'auth/login',
					'Register' => 'auth/register'
				), 'nav navbar-nav navbar-right');
			} 
			?>
		</div>
	</nav>
</header>