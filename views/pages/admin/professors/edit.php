<div class="container">
	<h1><?php echo $this->title; ?></h1>

	<?php if($this->is_error('save')): ?>
    <p class='alert alert-danger'>Sorry, something went wrong. Please try later...</p>
  <?php elseif($this->sms('added')): ?>
    <p class='alert alert-success'>Professor successfully added! <a href="/admin/professors/edit" class="btn btn-success"> Add one more</a></p>
  <?php elseif($this->msg('saved')): ?>
    <p class='alert alert-success'>Professor successfully changed! <a href="/admin/professors" class="btn btn-primary"> Back to list</a></p>
  <?php endif; ?>

  <form method="post" action="/admin/professors/edit/<?php echo $id; ?>">
    <div class="form-group<?php echo $this->is_error('name') ? ' has-error' : ''; ?>">
      <label class="control-label" for="name">
        <?php if ($this->is_error('name', 'required')): ?>
          Name must not be blank
        <?php else: ?>
          Name
        <?php endif; ?>
      </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $name ?>">
    </div>
    <div class="form-group<?php echo $this->is_error('patronymic') ? ' has-error' : ''; ?>">
      <label class="control-label" for="patronymic">
        <?php if ($this->is_error('patronymic', 'required')): ?>
          Patronymic must not be blank
        <?php else: ?>
          Patronymic
        <?php endif; ?>
      </label>
      <input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Patronymic" value="<?php echo $patronymic ?>">
    </div>
    <div class="form-group<?php echo $this->is_error('surname') ? ' has-error' : ''; ?>">
      <label class="control-label" for="surname">
        <?php if ($this->is_error('surname', 'required')): ?>
          Surname must not be blank
        <?php else: ?>
          Surname
        <?php endif; ?>
      </label>
      <input type="surname" name="surname" class="form-control" id="surname" placeholder="Surname" value="<?php echo $surname ?>">
    </div>
    <div class="form-group<?php echo $this->is_error('birth') ? ' has-error' : ''; ?>">
      <label class="control-label" for="birth">
        <?php if ($this->is_error('birth', 'required')): ?>
          Birth must not be blank
        <?php elseif ($this->is_error('birth', 'date')): ?>
          Birth format is incorrect
        <?php else: ?>
          Birth
        <?php endif; ?>
      </label>
      <input type="text" name="birth" class="form-control" id="birth" placeholder="Birth date" value="<?php echo $birth ?>">
    </div>
    <div class="form-group<?php echo $this->is_error('about') ? ' has-error' : ''; ?>">
      <label class="control-label" for="about">
        <?php if ($this->is_error('about', 'required')): ?>
          About must not be blank
        <?php else: ?>
          About
        <?php endif; ?>
      </label>
      <input type="text" name="about" class="form-control" id="about" placeholder="About" value="<?php echo $about ?>">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="/admin/professors/comments/<?php echo $id; ?>/all" class="btn btn-primary pull-right">Comments about this professor</a>
  </form>
</div>