<?php
require_once '../connection.php';  

session_start();

function register($document){
    global $pdo;
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$document['email'], $document['password']]);
}

function chkemail($email){
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $temp = $stmt->fetch();
    return empty($temp);
}

function setsession($email){
    global $pdo;
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $temp = $stmt->fetch();

    if ($temp) {
        $_SESSION["userLoggedIn"] = 1;
        $_SESSION["email"] = $email;
        return true;
    }
    return false;
}

// Process the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];  

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (chkemail($email)) {
        $document = [
            'email' => $email,
            'password' => $passwordHash
        ];

        if (register($document)) {
            setsession($email);  
            echo '<p>Регистрация успешна. <a href="../login/login.html">Войти</a></p>';
            exit;
        } else {
            echo '<p>Ошибка при регистрации. Попробуйте снова.</p>';
        }
    } else {
        echo '<p>Этот email уже зарегистрирован. <a href="../login/login.html">Войти</a></p>';
    }
} else {
    echo '<p>Используйте форму для регистрации.</p>';
}

?>
