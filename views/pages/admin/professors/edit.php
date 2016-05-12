<div class="container">
	<h1><?= $this->title; ?></h1>

	<? if($this->is_error('save')): ?>
    <p class='alert alert-danger'>Извините, что-то пошло не так, попробуйте позже...</p>
  <? elseif($this->sms('added')): ?>
    <p class='alert alert-success'>Преподаватель успешно добавлен! <a href="/admin/professors/edit" class="btn btn-success"> Добавить еще одного</a></p>
  <? elseif($this->msg('saved')): ?>
    <p class='alert alert-success'>Преподаватель успешно изменен <a href="/admin/professors" class="btn btn-primary">← Назад к списку</a></p>
  <? endif; ?>

  <form method="post" action="/admin/professors/edit/<?= $id; ?>">
    <div class="form-group<?= $this->is_error('name') ? ' has-error' : ''; ?>">
      <label class="control-label" for="name">
        <? if ($this->is_error('name', 'required')): ?>
          Укажите имя
        <? else: ?>
          Имя
        <? endif; ?>
      </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Имя" value="<?= $name ?>">
    </div>

    <div class="form-group<?= $this->is_error('patronymic') ? ' has-error' : ''; ?>">
      <label class="control-label" for="patronymic">
        <? if ($this->is_error('patronymic', 'required')): ?>
          Укажите отчество
        <? else: ?>
          Отчество
        <? endif; ?>
      </label>
      <input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Отчество" value="<?= $patronymic ?>">
    </div>

    <div class="form-group<?= $this->is_error('surname') ? ' has-error' : ''; ?>">
      <label class="control-label" for="surname">
        <? if ($this->is_error('surname', 'required')): ?>
          Укажите фамилию
        <? else: ?>
          Фмилия
        <? endif; ?>
      </label>
      <input type="surname" name="surname" class="form-control" id="surname" placeholder="Фамилия" value="<?= $surname ?>">
    </div>

    <div class="form-group<?= $this->is_error('birth') ? ' has-error' : ''; ?>">
      <label class="control-label" for="birth">
        <? if ($this->is_error('birth', 'required')): ?>
          Укажите дату рождения
        <? elseif ($this->is_error('birth', 'date')): ?>
          Неверный формат даты (ГГГГ-ММ-ДД)
        <? else: ?>
          Дата рождения
        <? endif; ?>
      </label>
      <input type="text" name="birth" class="form-control" id="birth" placeholder="ГГГГ-ММ-ДД" value="<?= $birth ?>">
    </div>

    <div class="form-group<?= $this->is_error('start') ? ' has-error' : ''; ?>">
      <label class="control-label" for="start">
        <? if ($this->is_error('start')): ?>
          Год начала преподавания указан не верно
        <? else: ?>
          Год начала преподавания
        <? endif; ?>
      </label>
      <input type="text" name="start" class="form-control" id="start" placeholder="Если оставить поле пустым проверки по началу преподавания не будет" value="<?= $start; ?>">
    </div>

    <div class="form-group<?= $this->is_error('end') ? ' has-error' : ''; ?>">
      <label class="control-label" for="end">
        <? if ($this->is_error('end')): ?>
          Год окончания преподавания указан не верно
        <? else: ?>
          Год окончания преподавания
        <? endif; ?>
      </label>
      <input type="text" name="end" class="form-control" id="end" placeholder="Если оставить поле пустым проверки по окончинию преподавания не будет" value="<?= $end; ?>">
    </div>

    <div class="form-group<?= $this->is_error('about') ? ' has-error' : ''; ?>">
      <label class="control-label" for="about">
          Дополнительная информация
      </label>
      <input type="text" name="about" class="form-control" id="about" placeholder="Дополнительная информация" value="<?= $about ?>">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>

    <? if($id): ?>
      <a href="/admin/professors/comments/<?= $id; ?>/all" class="btn btn-primary pull-right">Оценки этого преподавателя</a>
    <? endif; ?>
  </form>
</div>