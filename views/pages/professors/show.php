<div class="container">
	<?php if($this->sms('wait')): ?>
		<p class='alert alert-danger'>You can rate each professor once every six months</p>
	<?php elseif($this->sms('added')): ?>
		<p class='alert alert-success'>Comment is added successfully but it will take time to be approved by moderator.</p>
	<?php endif; ?>
	<div class="clearfix">
		<h1 class="pull-left"><?php echo $name . " " . $patronymic . " " . $surname; ?></h1>
		<a href="/professors" class="btn btn-primary pull-right">← back to all professors</a>
	</div>
	<p>birth date: <?php echo $birth; ?></p>
	<p class="h4">about professor:</p>
	<p><?php echo $about; ?></p>
	<a href="/professors/comment/<?php echo $id ?>" class="btn btn-success">Rate this professor</a>

	<?php if ($rated): ?>
		<p class="h3">Average rating: <?php echo $rating; ?>, rated <?php echo $rated; ?> times</p>
	<?php else: ?>
		<p class="h3">Not rated yet</p>
	<?php endif; ?>
	
	<?php if ($comments): ?>
		<h3>Comments</h3>
		<?php foreach ($comments as $comment): ?>
			<hr>
			<p class="h4">
				<span class="h3"><?php echo $comment['estimate']; ?></span>
				<?php echo $comment['title']; ?>
			</p>
			<p><?php echo $comment['comment']; ?></p>
		<?php endforeach; ?>
	<?php endif; ?>
</div>