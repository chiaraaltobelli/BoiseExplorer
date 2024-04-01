<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$_SESSION['email'] = $email;

if ($email === 'chiara.j.altobelli@gmail.com' && $password === 'Coffee465$') {
    $_SESSION['authenticated'] = true;
    // Set login popup visibility to false
    $_SESSION['login_popup_visible'] = false;
    // Stay on the same page after login if authenticated
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Get the referring URL
    $redirectUrl = $_SERVER['HTTP_REFERER'];
    // Check if query string already contains login_error=incorrect_credentials
    if (strpos($redirectUrl, '?login_error=incorrect_credentials') === false) {
        // Append the error parameter
        $redirectUrl .= (parse_url($redirectUrl, PHP_URL_QUERY) ? '&' : '?') . 'login_error=incorrect_credentials';
    }

    $_SESSION['login_popup_visible'] = true;
    // Redirect back to the referring page
    header("Location: " . $redirectUrl);
    exit();
}
?>
