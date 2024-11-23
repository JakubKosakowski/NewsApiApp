<?php
    function getPDO() {
        $pdo = new PDO("mysql:host=localhost;dbname=newsapi_db", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    function getApiKey() {
        $dotevn = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotevn->load();

        return $_ENV['API_KEY'];
    }

    function redirectAndExit($script) {
        $relativeUrl = $_SERVER['PHP_SELF'];
        $urlFolder = substr($relativeUrl, 0, strrpos($relativeUrl, '/'));

        $host = $_SERVER['HTTP_HOST'];
        header('Location: http://'.$host.$urlFolder.$script);
        exit();
    }

    function tryRegister(PDO $pdo, $username, $email, $password) {
        $errors = [];
        $sql = "SELECT id FROM users WHERE username = :username OR email = :email;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username, ':email' => $email]);
        $existUser = $stmt->fetchColumn();

        if($existUser !== false) {
            $errors[] = "There is a user with that username or email.";
        }
        if(strlen($password) < 8) {
            $errors[] = "The password must contain more than 8 letters and characters.";
        }

        if(!$errors) {
            $sql = "INSERT INTO users(username, email, password) VALUES(:username, :email, :password);";
            $stmt = $pdo->prepare($sql);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([':username' => $username, ':email' => $email, ':password' => $hash]);
            return [true, $errors];
        }
        return [false, $errors];
    }

    function tryLogin(PDO $pdo, $username, $password) {
        $sql = "
            SELECT
                password
            FROM
                users
            WHERE
                username = :username
                AND is_enabled = 1;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            array(':username' => $username, )
        );

        $hash = $stmt->fetchColumn();
        $success = password_verify($password, $hash);
        return $success;
    }

    function login($username) {
        session_regenerate_id();
        $_SESSION['logged-in-username'] = $username;
    }

    function logout() {
        unset($_SESSION['logged-in-username']);
    }

    function isLoggedIn() {
        return isset($_SESSION['logged-in-username']);
    }
?>
