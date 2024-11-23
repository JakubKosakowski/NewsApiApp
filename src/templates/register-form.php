<div class="container">
    <?php if($errors): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?=$error?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
    <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" value="<?=$username?>" aria-describedby="usernameHelp">
          <div id="usernameHelp" class="form-text">We'll never share your username and password with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email">
          </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
          <div id="usernameHelp" class="form-text">The password must contains more than 8 letters and signs.</div>
        </div>
        <input
                    name="register"
                    type="submit"
                    value="Sign up"
                />
    </form>
</div>