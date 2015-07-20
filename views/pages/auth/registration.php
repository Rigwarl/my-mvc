<div class="container">
    <h1>Registration</h1>

    <?php if($this->is_error('save')): ?>
      <p class='alert alert-danger'>Sorry, something went wrong. Please try later...</p>
    <?php endif; ?>

    <form method="post" action="/auth/register">
      <div class="form-group<?php echo $this->is_error('login') ? ' has-error' : ''; ?>">
        <label class="control-label" for="login">
          <?php if($this->is_error('login', 'required')): ?>
            Login must not be blank
          <?php elseif($this->is_error('login', 'min_len')): ?>
            Login must be at least 4 characters
          <?php elseif($this->is_error('login', 'exists')): ?>
            This login is already taken
          <?php else: ?>
            Login
          <?php endif; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Login" value="<?php echo $login ?>">
      </div>

      <div class="form-group<?php echo $this->is_error('email') ? ' has-error' : ''; ?>">
        <label class="control-label" for="email">
          <?php if($this->is_error('email', 'required')): ?>
            Email must not be blank
          <?php elseif($this->is_error('email', 'email')): ?>
            Email is incorrect
          <?php elseif($this->is_error('email', 'exists')): ?>
            This email is already taken
          <?php else: ?>
            Email
          <?php endif; ?>
        </label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $email ?>">
      </div>

      <div class="form-group<?php echo $this->is_error('password') ? ' has-error' : ''; ?>">
        <label class="control-label" for="password">
          <?php if($this->is_error('password', 'required')): ?>
            Password must not be blank
          <?php elseif($this->is_error('password', 'min_len')): ?>
            Password must be at least 6 characters
          <?php else: ?>
            Password
          <?php endif; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo $password; ?>">
      </div>

      <div class="form-group<?php echo $this->is_error('password2') ? ' has-error' : ''; ?>">
        <label class="control-label" for="password2">
          <?php if($this->is_error('password2', 'required')): ?>
            Password must not be blank
          <?php elseif($this->is_error('password2', 'equal')): ?>
            Passwords does not match
          <?php else: ?>
            Password
          <?php endif; ?>
        </label>
        <input type="password" name="password2" class="form-control" id="password2" placeholder="Password again" value="<?php echo $password2; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>