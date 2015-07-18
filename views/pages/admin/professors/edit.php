<div class="container">
	<h1>Adding new professor</h1>

	<?php echo isset($error) ? "<p class='alert alert-danger'>$error</p>" : ''; ?>

  <form method="post" action="/admin/professors/edit/<?php echo $id; ?>">
    <div class="form-group<?php echo isset($name) ? ' has-error' : ''; ?>">
      <label class="control-label" for="name">
        <?php echo isset($name) ? $name : 'Name'; ?>
      </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
    </div>
    <div class="form-group<?php echo isset($patronymic) ? ' has-error' : ''; ?>">
      <label class="control-label" for="patronymic">
        <?php echo isset($patronymic) ? $patronymic : 'Patronymic'; ?>
      </label>
      <input type="text" name="patronymic" class="form-control" id="patronymic" placeholder="Patronymic">
    </div>
    <div class="form-group<?php echo isset($surname) ? ' has-error' : ''; ?>">
      <label class="control-label" for="surname">
        <?php echo isset($surname) ? $surname : 'Surname'; ?>
      </label>
      <input type="surname" name="surname" class="form-control" id="surname" placeholder="Surname">
    </div>
    <div class="form-group<?php echo isset($birth) ? ' has-error' : ''; ?>">
      <label class="control-label" for="birth">
        <?php echo isset($birth) ? $birth : 'Birth date'; ?>
      </label>
      <input type="text" name="birth" class="form-control" id="birth" placeholder="Birth date">
    </div>
    <div class="form-group<?php echo isset($about) ? ' has-error' : ''; ?>">
      <label class="control-label" for="about">
        <?php echo isset($about) ? $about : 'About'; ?>
      </label>
      <input type="text" name="about" class="form-control" id="about" placeholder="About">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>