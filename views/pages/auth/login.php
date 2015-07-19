<div class="container">
    <h1>Log in</h1>
  
    <?php if ($this->is_error('incorrect')): ?>
       <p class='alert alert-danger'>Login or password is incorrect</p>
    <?php endif; ?>

    <form method="post" action="/auth/login">
      <div class="form-group<?php echo $this->is_error('login') ? ' has-error' : ''?>">
        <label class="control-label" for="login">
          <?php echo $this->is_error('login', 'required') ? 'Login must not be blank' : 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="login" value="<?php echo $login; ?>">
      </div>
      <div class="form-group<?php echo $this->is_error('password') ? ' has-error' : ''?>">  
        <label class="control-label" for="password">
          <?php echo $this->is_error('password', 'required') ? 'Password must not be blank' : 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
</div>