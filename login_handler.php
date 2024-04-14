<?php
session_start();

// Safety check for POST data
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$_SESSION['email'] = $email;  // Consider security implications of storing email in session.

require_once 'Dao.php';
$dao = new Dao();
$user = $dao->getUserByEmail($email);

// Initialize session flags
$_SESSION['login_popup_visible'] = false;
$_SESSION['authenticated'] = false;
$_SESSION['loginerror'] = false;

if ($user && $password === $user['UserPassword']) {
    // Set user ID and authentication flag in session
    $_SESSION['userID'] = $user['UserID']; // Make sure 'UserID' matches your database column
    $_SESSION['authenticated'] = true;

    // Redirect to a cleaned up referer URL, or to a fallback if not available
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    $urlComponents = parse_url($referer);
    $cleanUrl = $urlComponents['scheme'] . '://' . $urlComponents['host'];
    if (isset($urlComponents['port'])) {
        $cleanUrl .= ':' . $urlComponents['port'];
    }
    if (isset($urlComponents['path'])) {
        $cleanUrl .= $urlComponents['path'];
    }
    header("Location: $cleanUrl");
    exit();
} else {
    $_SESSION['loginerror'] = true;
    $_SESSION['login_popup_visible'] = true;
    
    // Redirect back with error message, handle missing referer
    $redirectUrl = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    $hasErrorParam = strpos($redirectUrl, '?login_error=incorrect_credentials') !== false;
    $separator = strpos($redirectUrl, '?') !== false ? '&' : '?';

    $redirectUrl = $hasErrorParam ? $redirectUrl : $redirectUrl . $separator . 'login_error=incorrect_credentials';
    header("Location: $redirectUrl");
    exit();
}
?>
