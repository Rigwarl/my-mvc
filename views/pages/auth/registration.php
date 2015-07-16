<div class="container">
    <h1>Registration</h1>

    <?php echo isset($error) ? "<p class='alert alert-danger'>$error</p>" : ''; ?>

    <form method="post" action="/auth/register" <?php echo isset($invalid) ? 'class="has-error"' : ''?>>
      <div class="form-group<?php echo isset($login) ? ' has-error' : ''; ?>">
        <label class="control-label" for="login">
          <?php echo isset($login) ? $login : 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Login">
      </div>
      <div class="form-group<?php echo isset($email) ? ' has-error' : ''; ?>">
        <label class="control-label" for="email">
          <?php echo isset($email) ? $email : 'Email'; ?>
        </label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group<?php echo isset($password) ? ' has-error' : ''; ?>">
        <label class="control-label" for="password">
          <?php echo isset($password) ? $password : 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <div class="form-group<?php echo isset($password2) ? ' has-error' : ''; ?>">
        <label class="control-label" for="password2">
          <?php echo isset($password2) ? $password2 : 'Password again'; ?>
        </label>
        <input type="password" name="password2" class="form-control" id="password2" placeholder="Password again">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>