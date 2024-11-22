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
