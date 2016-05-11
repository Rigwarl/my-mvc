
<div class="container">
	<div class="clearfix">
		<h1 class="pull-left"><?= $this->title; ?></h1>
		<a href="/professors/show/<?= $professor['id']; ?>" class="btn btn-primary pull-right">← назад к преподавателю</a>
	</div>

	  <? if($this->is_error('save')): ?>
	  	<p class='alert alert-danger'>Простите, что-то пошло не так, попробуйте позже...</p>
	  <? endif; ?>

	  <form method="post" action="/professors/comment/<?= $professor['id']; ?>">

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

		  <div class="form-group<?= $this->is_error('year') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="year">
	        <? if ($this->is_error('year', 'required')): ?>
	          Укажите год обучения
	        <? elseif ($this->is_error('year')): ?>
	          Год указан не верно
	        <? else: ?>
	          Год обучения
	        <? endif; ?>
	      </label>
	      <input type="text" name="year" class="form-control" id="year" placeholder="Год обучения" value="<?= $year ?>">
	    </div>

	    <div class="form-group<?= $this->is_error('clarity') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="clarity">
	        <? if ($this->is_error('clarity', 'required')): ?>
	          Укажите ясность изложения
	        <? elseif ($this->is_error('clarity')): ?>
	          Ясность изложения должна быть числом от 1 до 5
	      	<? else: ?>
	          Ясность изложения
	        <? endif; ?>
	      </label>
	      <input type="text" name="clarity" class="form-control" id="clarity" placeholder="Число от 1 до 5" value="<?= $clarity ?>">
	    </div>

			<div class="form-group<?= $this->is_error('knowledge') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="knowledge">
	        <? if ($this->is_error('knowledge', 'required')): ?>
	          Укажите владение предметом
	        <? elseif ($this->is_error('knowledge')): ?>
	          Владение предметом должно быть числом от 1 до 5
	      	<? else: ?>
	          Владение предметом
	        <? endif; ?>
	      </label>
	      <input type="text" name="knowledge" class="form-control" id="knowledge" placeholder="Число от 1 до 5" value="<?= $knowledge ?>">
	    </div>

			<div class="form-group<?= $this->is_error('interest') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="interest">
	        <? if ($this->is_error('interest', 'required')): ?>
	          Укажите увлекательность занятий
	        <? elseif ($this->is_error('interest')): ?>
	          Увлекательность занятий должна быть числом от 1 до 5
	      	<? else: ?>
	          Увлекательность занятий
	        <? endif; ?>
	      </label>
	      <input type="text" name="interest" class="form-control" id="interest" placeholder="Число от 1 до 5" value="<?= $interest ?>">
	    </div>

			<div class="form-group<?= $this->is_error('helpfulness') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="helpfulness">
	        <? if ($this->is_error('helpfulness', 'required')): ?>
	          Укажите комфортность общения
	        <? elseif ($this->is_error('helpfulness')): ?>
	          Комфортность общения должна быть числом от 1 до 5
	      	<? else: ?>
	          Комфортность общения
	        <? endif; ?>
	      </label>
	      <input type="text" name="helpfulness" class="form-control" id="helpfulness" placeholder="Число от 1 до 5" value="<?= $helpfulness ?>">
	    </div>

			<div class="form-group<?= $this->is_error('exactingness') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="exactingness">
	        <? if ($this->is_error('exactingness', 'required')): ?>
	          Укажите требовательность
	        <? elseif ($this->is_error('exactingness')): ?>
	          Требовательность должна быть числом от 1 до 5
	      	<? else: ?>
	          Требовательность (к ясности и полноте ответа)
	        <? endif; ?>
	      </label>
	      <input type="text" name="exactingness" class="form-control" id="exactingness" placeholder="Число от 1 до 5" value="<?= $exactingness ?>">
	    </div>

	    <div class="form-group<?= $this->is_error('hardness') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="hardness">
	        <? if ($this->is_error('hardness', 'required')): ?>
	          Укажите сложность сдачи экзамена
	        <? elseif ($this->is_error('hardness')): ?>
	          Сложность сдачи экзамена должна быть числом от 1 до 5
	      	<? else: ?>
	          Сложность сдачи экзамена
	        <? endif; ?>
	      </label>
	      <input type="text" name="hardness" class="form-control" id="hardness" placeholder="Число от 1 до 5" value="<?= $hardness ?>">
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