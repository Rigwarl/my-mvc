
<div class="container">
	<h1>Professors</h1>

	<ul>
		<?php foreach ($professors as $professor): ?>
			
			<li><a href="/professors/show/<?php echo $professor['id']; ?>"><?php echo $professor['name']; ?></a></li>

		<?php endforeach; ?>
	</ul>
</div>