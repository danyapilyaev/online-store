<?php
require_once '../connection.php'; 
session_start();

function checkCredentials($email, $password){
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function setLoginSession($user){
    $_SESSION['userLoggedIn'] = 1;
    $_SESSION['email'] = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = checkCredentials($email, $password);
    if ($user) {
        setLoginSession($user);
        header('Location: ../../../index.html');
        exit;
    } else {
        $message = "Неправильный email или пароль.";
        header('Location: ../login/login.html?error=' . urlencode($message));
        exit;
    }
} else {
    // Not a POST request
    echo 'Use the form to submit credentials.';
}

?>
