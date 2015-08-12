
<div class="container">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo $name . " " . $patronymic . " " . $surname; ?></h1>
		<a href="/professors" class="btn btn-primary pull-right">← back to all professors</a>
	</div>
	<p>birth date: <?php echo $birth; ?></p>
	<p class="h4">about professor:</p>
	<p><?php echo $about; ?></p>
	<a href="/professors/comment/<?php echo $id ?>" class="btn btn-success">Rate this professor</a>
</div>