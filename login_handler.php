<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$_SESSION['email'] = $email;

require_once 'Dao.php';
$dao = new Dao();
$user = $dao->getUserByEmail($email);

echo "<script>console.log('Entered email: " . $email . "');</script>";
echo "<script>console.log('Entered password: " . $password . "');</script>";
echo "<script>console.log('saved password: " . $user['UserPassword'] . "');</script>";


if ($user && $password === $user['UserPassword']) {
    // Set login popup visibility to false
    $_SESSION['login_popup_visible'] = false;
    $_SESSION['authenticated'] = true;
    echo "<script>console.log('authenticated: " . $_SESSION['authenticated'] . "');</script>";
    // Stay on the same page after login if authenticated
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Get the referring URL
    $_SESSION['loginerror'] = true;
    $_SESSION['authenticated'] = false;
    $redirectUrl = $_SERVER['HTTP_REFERER'];
    // Check if query string already contains login_error=incorrect_credentials
    echo "<script>console.log('authenticated: " . $_SESSION['authenticated'] . "');</script>";
    if (strpos($redirectUrl, '?login_error=incorrect_credentials') === false) {
        // Append the error parameter
        $redirectUrl .= (parse_url($redirectUrl, PHP_URL_QUERY) ? '&' : '?') . 'login_error=incorrect_credentials';
    }

    $_SESSION['login_popup_visible'] = true;
    // Redirect back to the referring page
    if(isset($_SERVER['HTTP_REFERER'])){
        header("Location: " . $redirectUrl);
    } else {
        header("Location: index.php");
    }

    exit();
}
?>
