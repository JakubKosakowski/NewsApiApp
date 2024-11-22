<?php

function installApp() {
    $pdo = new PDO("mysql:host=localhost;charset=utf8", "root", "");
    createDatabaseIfNotExists($pdo);
    createUsersTableIfNotExists($pdo);
    
    return true;
}

function createDatabaseIfNotExists(PDO $pdo) {
    try{
        $sql = "CREATE DATABASE IF NOT EXISTS newsapi_db";
        $pdo->exec($sql);
        $pdo->exec("USE newsapi_db");
    } catch(PDOException $e) {
        die("Error during creating database: ".$e->getMessage());
    }
}

function createUsersTableIfNotExists(PDO $pdo) {
    try {
        $pdo->exec("DROP TABLE IF EXISTS users");
        $sql = "CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(100) NOT NULL,
            created_at DATETIME DEFAULT (NOW()),
            is_enabled BOOLEAN NOT NULL DEFAULT true
        );";
        $pdo->exec($sql);
        $pdo->exec("INSERT INTO users(username, email, password) VALUES('admin', 'admin@test.com', 'unhashed-password')");
    } catch (PDOException $e) {
        die("Error during creating user table: ".$e->getMessage());
    }
}

function createUser(PDO $pdo, $username, $length = 10) {
    $alphabet = range(ord('A'), ord('z'));
    $alphabetLength = count($alphabet);

    $password = '';

    for($i = 0; $i < $length; $i++){
        $letterCode = $alphabet[rand(0, $alphabetLength - 1)];
        $password .= chr($letterCode);
    }
    $error = '';
    $sql = "UPDATE users SET password = :password WHERE username = :username;";
    $stmt = $pdo->prepare($sql);
    if($stmt === false) {
        $error = 'Could not prepare user creation';
    }
    if(!$error) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if($hash === false) {
            $error = "Password hashing failed";
        }
    }
    $result = $stmt->execute([':password' => $hash, ':username' => $username]);
    if($result === false) {
        $error = "Could not execute user creation";
    }
    if($error) {
        $password='';
    }
    return [$password, $error];
}
?>
