<div class="container">
	<?php html::nav(array(
		'All'         => '/admin/comments',
		'New'         => '/admin/comments/new',
		'Approved'    => '/admin/comments/approved',
		'Disapproved' => '/admin/comments/disapproved'
	), 'nav nav-pills mb15'); ?>

	<?php if ($this->sms('not_changed')): ?>
		<p class='alert alert-danger'>Sorry, something went wrong. Please try later...</p>
	<?php endif; ?>

	<h1><?php echo $this->title; ?></h1>

	<?php foreach($comments as $comment): ?>
		<hr>
		<p>Status: <strong><?php echo $comment['status']; ?></strong></p>
		<p>Professor: <strong><?php echo $comment['name'] . ' ' . $comment['patronymic'] . ' ' . $comment['surname']; ?></strong></p>
		<p>User: <strong><?php echo $comment['login']; ?></strong></p>
		<p>Estimate: <strong><?php echo $comment['estimate']; ?></strong></p>
		<p>Comment: <strong><?php echo $comment['comment']; ?></strong></p>

		<?php if ($comment['status'] !== 'approved'): ?>
			<a href="/admin/comments/approve/<?php echo $comment['id']; ?>" class="btn btn-success">Approve</a>
		<?php endif; ?>

		<?php if($comment['status'] !== 'disapproved'): ?>
			<a href="/admin/comments/disapprove/<?php echo $comment['id']; ?>" class="btn btn-danger">Disapprove</a>
		<?php endif; ?>

		<a href="/admin/comments/edit/<?php echo $comment['id']; ?>" class="btn btn-primary">Edit</a>
	<?php endforeach; ?>
</div>