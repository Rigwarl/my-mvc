<div class="container">
    <h1>Registration</h1>

    <?php if ($invalid): ?>
      <p class="alert alert-danger">Sorry, something went wrong...</p>
    <?php endif; ?>

    <form method="post" action="/auth/register" <?php echo $invalid ? 'class="has-error"' : ''?>>
      <div class="form-group">
        <label for="login">
          <?php echo $login ? "<span class='text-danger '>$login</span>" : 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="Login">
      </div>
      <div class="form-group">
        <label for="email">
          <?php echo $email ? "<span class='text-danger '>$email</span>" : 'Email'; ?>
        </label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="password">
          <?php echo $password ? "<span class='text-danger '>$password</span>" : 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="password2">
          <?php echo $password2 ? "<span class='text-danger '>$password2</span>" : 'Password again'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password2" placeholder="Password again">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>