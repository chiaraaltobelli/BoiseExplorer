<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$_SESSION['email'] = $email;

if ($email === 'chiara.j.altobelli@gmail.com' && $password === 'Coffee465$') {
    $_SESSION['authenticated'] = true;
    // Stay on the same page after login if authenticated
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo 'error';
}
?>
