<div class="container">
	<? html::nav(array(
		'Все'         => '/admin/comments/all',
		'Новые'         => '/admin/comments/newest',
		'Одобренные'    => '/admin/comments/approved',
		'Отклоненные' => '/admin/comments/disapproved'
	), 'nav nav-pills mb15'); ?>

	<? if ($this->sms('not_changed')): ?>
		<p class='alert alert-danger'>Извините, что-то пошло не так, попробуйте позже...</p>
	<? endif; ?>

	<h1><?= $this->title; ?></h1>

	<? foreach($comments as $comment): ?>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<p>Статус: <b><?= $comment['status']; ?></b></p>
				<p>Преподаватель: <b><?= $comment['name'] . ' ' . $comment['patronymic'] . ' ' . $comment['surname']; ?></b></p>
				<p>Пользователь: <b><?= $comment['login']; ?></b></p>
				<p>Добавлен: <b><?= $comment['added']; ?></b></p>
				<p>Предмет: <b><?= $comment['subject']; ?></b></p>
				<p>Год обучения: <b><?= $comment['year']; ?></b></p>
				<? if($comment['start'] && $comment['start'] > $comment['year'] || $comment['end'] && $comment['end'] < $comment['year']): ?>
				  <p class="text-danger">Год обучения не соответствует</p>
				<? endif; ?>
			</div>

			<div class="col-md-3">
				<p><b><?= $comment['clarity'] ?> </b>ясность изложения</p>
				<p><b><?= $comment['knowledge'] ?> </b>владение предметом</p>
				<p><b><?= $comment['interest'] ?> </b> увлекательность занятий</p>
				<p><b><?= $comment['helpfulness'] ?> </b>комфортность общения</p>
				<p><b><?= $comment['exactingness'] ?> </b>требовательность</p>
				<p><b><?= $comment['hardness'] ?> </b> сложность сдачи экзамена</p>
			</div>
			<div class="col-md-5">
				<p>Заголовок: <b><?= $comment['title']; ?></b></p>
				<p>Комментарий: <b><?= $comment['comment']; ?></b></p>
			</div>
		</div>

		<? if ($comment['status'] !== 'approved'): ?>
			<a href="/admin/comments/change/<?= $comment['id']; ?>/approve" class="btn btn-success">Одобрить</a>
		<? endif; ?>

		<? if($comment['status'] !== 'disapproved'): ?>
			<a href="/admin/comments/change/<?= $comment['id']; ?>/disapprove" class="btn btn-danger">Отклонить</a>
		<? endif; ?>

		<a href="/admin/comments/edit/<?= $comment['id']; ?>" class="btn btn-primary">Редактировать</a>
	<? endforeach; ?>
</div>