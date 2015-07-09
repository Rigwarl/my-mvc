<div class="container">
    <h1>Registration</h1>

    <?php if ($invalid): ?>
      <p class="alert alert-danger">Sorry, something went wrong...</p>
    <?php endif; ?>

    <form method="post" action="/auth/register" <?php echo $invalid ? 'class="has-error"' : ''?>>
      <div class="form-group<?php echo $login ? ' has-error' : ''; ?>">
        <label class="control-label" for="login">
          <?php echo $login ?: 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Login">
      </div>
      <div class="form-group<?php echo $email ? ' has-error' : ''; ?>">
        <label class="control-label" for="email">
          <?php echo $email ?: 'Email'; ?>
        </label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group<?php echo $password ? ' has-error' : ''; ?>">
        <label class="control-label" for="password">
          <?php echo $password ?: 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <div class="form-group<?php echo $password2 ? ' has-error' : ''; ?>">
        <label class="control-label" for="password2">
          <?php echo $password2 ?: 'Password again'; ?>
        </label>
        <input type="password" name="password2" class="form-control" id="password2" placeholder="Password again">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>