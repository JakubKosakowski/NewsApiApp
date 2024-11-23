<div class="container">
    <?php if($error): ?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif ?>
    <?php if(isset($_SESSION['new-account-created'])): ?>
      <div class="alert alert-success" role="alert">
        New account created! Try to sign in.
      </div>
      <?php unset($_SESSION['new-account-created']); ?>
    <?php endif ?>
    <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" value="<?=$username?>" aria-describedby="usernameHelp">
          <div id="usernameHelp" class="form-text">We'll never share your username and password with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <input name="login" type="submit" value="Login"/>
    </form>
</div>