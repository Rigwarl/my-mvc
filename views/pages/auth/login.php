<div class="container">
    <h1>Log in</h1>
    
    <?php if ($this->sms('require_login')): ?>
       <p class='alert alert-danger'>You must login first</p>
    <?php elseif ($this->is_error('incorrect')): ?>
       <p class='alert alert-danger'>Login or password is incorrect</p>
    <?php endif; ?>

    <form method="post" action="/auth/login">
      <div class="form-group<?php echo $this->is_error('login') ? ' has-error' : ''?>">
        <label class="control-label" for="login">
          <?php echo $this->is_error('login', 'required') ? 'Login must not be blank' : 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Login" value="<?php echo $login; ?>">
      </div>
      <div class="form-group<?php echo $this->is_error('password') ? ' has-error' : ''?>">  
        <label class="control-label" for="password">
          <?php echo $this->is_error('password', 'required') ? 'Password must not be blank' : 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo $password; ?>">
      </div>
      <button type="submit" class="btn btn-success mr10">Log in</button>
      <a href="/auth/register" class="btn btn-primary">Register</a>
    </form>
</div>