<div class="container">
	<? if($this->sms('wait')): ?>
		<p class='alert alert-danger'>Вы можете оценивать преподавателя не чаще чем раз в полгода</p>
	<? elseif($this->sms('added')): ?>
		<p class='alert alert-success'>Ваша оценка была добавлена и отправлена на модерацию</p>
	<? endif; ?>

	<div class="clearfix">
		<h1 class="pull-left"><?= $name . " " . $patronymic . " " . $surname; ?></h1>
		<a href="/professors" class="btn btn-primary pull-right">← назад ко всем преподавателям</a>
	</div>

	<p>Дата рождения: <?= $birth; ?></p>

	<? if($about): ?>
		<p class="h4">О преподавателе:</p>
		<p><?= $about; ?></p>
	<? endif ?>

	<a href="/professors/comment/<?= $id ?>" class="btn btn-success">Оценить преподавателя</a>

	<? if ($rated): ?>
		<p class="h2 mb20">Общая оценка: <?= $rating; ?> из <?= $rated; ?> отзывов</p>
		<div class="row">
			<div class="col-md-4">
				<p class="lead"><span class="h3"><?= $clarity; ?> </span>ясность изложения</p>
				<p class="lead"><span class="h3"><?= $knowledge; ?> </span>владение предметом</p>
				<p class="lead"><span class="h3"><?= $interest; ?> </span> увлекательность занятий</p>
			</div>
			<div class="col-md-4">
				<p class="lead"><span class="h3"><?= $helpfulness; ?> </span>комфортность общения</p>
				<p class="lead"><span class="h3"><?= $exactingness; ?> </span>требовательность</p>
				<p class="lead"><span class="h3"><?= $hardness; ?> </span> сложность сдачи экзамена</p>
			</div>
		</div>
	<? else: ?>
		<p class="h3">Этого преподавателя еще не оценили</p>
	<? endif; ?>

	<? if ($comments): ?>
		<h3>Оценки:</h3>
		<? foreach ($comments as $comment): ?>
			<hr>
			<div class="row">
				<div class="col-md-2">
					<p><b><?= date('d-m-Y', strtotime($comment['added'])); ?></b></p>
					<p><?= $comment['login']; ?></p>
					<p><?= $comment['subject']; ?></p>
				</div>
				<div class="col-md-3">
					<p><span class="h4"><?= $comment['clarity']; ?> </span>ясность изложения</p>
					<p><span class="h4"><?= $comment['knowledge']; ?> </span>владение предметом</p>
					<p><span class="h4"><?= $comment['interest']; ?> </span> увлекательность занятий</p>
					<p><span class="h4"><?= $comment['helpfulness']; ?> </span>комфортность общения</p>
					<p><span class="h4"><?= $comment['exactingness']; ?> </span>требовательность</p>
					<p><span class="h4"><?= $comment['hardness']; ?> </span> сложность сдачи экзамена</p>
				</div>
				<div class="col-md-7">
					<p><span class="h4"><?= $comment['title']; ?></span></p>
					<p><?= $comment['comment']; ?></p>
				</div>
			</div>
		<? endforeach; ?>
	<? endif; ?>
</div>