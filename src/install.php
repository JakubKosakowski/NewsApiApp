<?php
require "../src/lib/install.php";
require "../src/lib/common.php";

session_start();

if($_POST) {
    $success = installApp();

    $pdo = getPDO();
    $password='';
    if (!$error) {
        $username = 'admin';
        list($password, $error) = createUser($pdo, $username);
    }

    $_SESSION['error'] = $error;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['try-install'] = true;

    redirectAndExit('/install.php');
}

$attempted = false;
if (isset($_SESSION['try-install']))
{
    $attempted = true;
    $error = $_SESSION['error'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    unset($_SESSION['error']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['try-install']);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Install test data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php require "../src/templates/navbar.php"; ?>
        <?php if($attempted): ?>
            <h2>Application installed successfully! Generated password for test user '<?=$username?>' is <?=$password?></h2>
            <p><a href="/">Go to home page</a> or <a href="/install.php">install application again</a></p>
        <?php else: ?>
            <form method="POST">
                <h2 class="form-text">Click the button to install NewsApiApp with test data.</h2>
                <input
                    name="install"
                    type="submit"
                    value="Install"
                />
            </form>
        <?php endif ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>