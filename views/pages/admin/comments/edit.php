<div class="container">
	<div class="clearfix">
		<h1 class="pull-left"><?= $this->title; ?></h1>
		<a href="<?= $this->user->get('backlink'); ?>" class="btn btn-primary pull-right">← назад к комментариям</a>
	</div>

	  <? if ($this->msg('saved')): ?>
	  	<p class='alert alert-success'>Комментарий успешно сохранен.</p>
	  <? elseif ($this->is_error('save')): ?>
	  	<p class='alert alert-danger'>Извините, что-то пошло не так, попробуйте позже...</p>
	  <? endif; ?>

	  <div class="row">
	  	<div class="col-md-8">
	  		<form method="post" action="/admin/comments/edit/<?= $id; ?>">
	  		  <div class="form-group<?= $this->is_error('subject') ? ' has-error' : ''; ?>">
	  		    <label class="control-label" for="subject">
	  		      <? if ($this->is_error('subject', 'required')): ?>
	  		        Укажите предмет
	  		      <? else: ?>
	  		        Предмет
	  		      <? endif; ?>
	  		    </label>
	  		    <input type="text" name="subject" class="form-control" id="subject" placeholder="Предмет" value="<?= $subject ?>">
	  		  </div>

	  		  <div class="form-group<?= $this->is_error('title') ? ' has-error' : ''; ?>">
	  		    <label class="control-label" for="title">
	  		      <? if ($this->is_error('title', 'required')): ?>
	  		        Укажите заголовок отзыва
	  		      <? else: ?>
	  		        Заголовок
	  		      <? endif; ?>
	  		    </label>
	  		    <input type="text" name="title" class="form-control" id="title" placeholder="Краткая характеристика" value="<?= $title ?>">
	  		  </div>

	  			<div class="form-group<?= $this->is_error('comment') ? ' has-error' : ''; ?>">
	  		    <label class="control-label" for="comment">
	  		      <? if ($this->is_error('comment', 'required')): ?>
	  		        Укажите комментарий
	  		      <? else: ?>
	  		        Комментарий
	  		      <? endif; ?>
	  		    </label>
	  		    <textarea name="comment" class="form-control" id="comment"><?= $comment; ?></textarea>
	  		  </div>
	  		  <button type="submit" class="btn btn-success">Сохранить</button>
	  		</form>
	  	</div>
	  	<div class="col-md-3 col-md-offset-1">
				<p>Статус: <b><?= $status; ?></b></p>
				<p>Добавлен: <b><?= $added; ?></b></p>
				<p>Год обучения: <b><?= $year; ?></b></p>
				<p><span class="h4"><?= $clarity; ?> </span>ясность изложения</p>
				<p><span class="h4"><?= $knowledge; ?> </span>владение предметом</p>
				<p><span class="h4"><?= $interest; ?> </span> увлекательность занятий</p>
				<p><span class="h4"><?= $helpfulness; ?> </span>комфортность общения</p>
				<p><span class="h4"><?= $exactingness; ?> </span>требовательность</p>
				<p><span class="h4"><?= $hardness; ?> </span> сложность сдачи экзамена</p>
	  	</div>
	  </div>
</div>