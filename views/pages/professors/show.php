
<div class="container">
	<h1><?php echo $professor['name'] . " " . $professor['patronymic'] . " " . $professor['surname'] ; ?></h1>
	<p>birth date: <?php echo $professor['birth']; ?></p>
	<p class="h4">about professor:</p>
	<p><?php echo $professor['about']; ?></p>
	<a href="/professors" class="btn btn-primary">← back to all professors</a>
</div>