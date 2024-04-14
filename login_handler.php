<?php
session_start();
require_once 'Dao.php';

// Initialize error flags and other session information
$_SESSION['login_popup_visible'] = false;
$_SESSION['authenticated'] = false;
$_SESSION['loginerror'] = false;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Ensure the email is stored securely by not retaining it in session if not necessary
    // Consider security implications and possibly remove storing email in session unless absolutely necessary

    $dao = new Dao();
    $user = $dao->getUserByEmail($email);

    if ($user && password_verify($password, $user['UserPassword'])) {
        // Successful login
        $_SESSION['userID'] = $user['UserID']; // Make sure 'UserID' matches your database column
        $_SESSION['authenticated'] = true;

        // Redirect to the page from where the user came or to the homepage
        $redirectUrl = $_SESSION['redirectURL'] ?? 'index.php'; // Ensure this session variable is set where needed
        header("Location: $redirectUrl");
        exit();
    } else {
        // Failed login
        $_SESSION['loginerror'] = true;
        $_SESSION['login_popup_visible'] = true;

        // Redirect back to the login page or origin page with error message
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        $queryString = parse_url($redirectUrl, PHP_URL_QUERY);
        $separator = ($queryString) ? '&' : '?';
        $redirectUrl .= $separator . 'login_error=incorrect_credentials';
        
        header("Location: $redirectUrl");
        exit();
    }
} else {
    // Redirect to home page if accessed without submitting the form
    header("Location: index.php");
    exit();
}
?>
