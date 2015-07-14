<div class="container">
    <h1>Log in</h1>
  
    <?php echo $incorrect ? "<p class='alert alert-danger'>$incorrect</p>" : ''; ?>

    <form method="post" action="/auth/login">
      <div class="form-group<?php echo $login ? ' has-error' : ''?>">
        <label class="control-label" for="login">
          <?php echo $login ?: 'Login'; ?>
        </label>
        <input type="text" name="login" class="form-control" id="login" placeholder="login">
      </div>
      <div class="form-group<?php echo $password ? ' has-error' : ''?>">  
        <label class="control-label" for="password">
          <?php echo $password ?: 'Password'; ?>
        </label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
</div>