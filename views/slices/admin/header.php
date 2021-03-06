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
		  <a class="navbar-brand" href="/admin">Dashboard</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<?php html::nav(array(
				'Professors' => '/admin/professors',
				'Comments'   => '/admin/comments'
			), 'nav navbar-nav'); ?>

			<?php html::nav(array(
				'Back to site' => '/',
				$this->user->get('login') => '#',
				'Logout' => '/auth/logout'
			), 'nav navbar-nav navbar-right'); ?>
		</div>
	</nav>
</header>