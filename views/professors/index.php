
<div class="container">
	<h1>Professors</h1>

	<ul>
		<?php foreach ($professors as $professor): ?>
			
			<li><?php echo $professor['name']; ?></li>

		<?php endforeach; ?>
	</ul>
</div>