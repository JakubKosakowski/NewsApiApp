<?php
require "../src/lib/common.php";

session_start();

if(isLoggedIn()) {
    redirectAndExit("/");
}

$username = '';
$error = '';
if($_POST) {
    $pdo = getPDO();
    $username = $_POST['username'];
    $ok = tryLogin($pdo, $username, $_POST['password']);
    if($ok) {
        login($username);
        redirectAndExit('/');
    }
    else {
        $error = 'Wrong username or password! Try again!';
    }
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
    <?php require "../src/templates/login-form.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>