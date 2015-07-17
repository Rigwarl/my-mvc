<div class="container">
	<div class="clear">
		<h1 class="pull-left">Professors</h1>
		<a href="/admin/professors/edit/new" class="btn btn-success pull-right">Add new professor</a>
	</div>
	<ul>
		<?php foreach ($professors as $professor): ?>
			
			<li><a href="/professors/show/<?php echo $professor['id']; ?>"><?php echo $professor['name'] . " " . $professor['patronymic'] . " " . $professor['surname'] ; ?></a></li>

		<?php endforeach; ?>
	</ul>
</div>