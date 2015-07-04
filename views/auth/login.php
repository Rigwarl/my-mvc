<div class="container">
    <h1>Log in</h1>

    <?php if ($invalid): ?>
      <p class="alert alert-danger">Login or password is incorrect</p>
    <?php endif; ?>

    <form method="post" action="/login" <?php echo $invalid ? 'class="has-error"' : ''?>>
      <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" class="form-control" id="login" placeholder="login">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
    </form>
</div>