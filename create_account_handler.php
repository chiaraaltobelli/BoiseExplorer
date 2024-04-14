<?php
session_start();
require_once 'Dao.php';

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    // Array to store validation errors
    $errors = [];

    // Validate email format
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate password complexity
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Password must contain at least one number.";
    }

    // Check if passwords match
    if ($confirmPassword !== $password) {
        $errors['confirmPassword'] = "Passwords must match.";
    }

    // Check for existing user with the same email
    $dao = new Dao();
    if ($dao->getUserByEmail($email)) {
        $errors['emailExists'] = "An account with this email already exists.";
    }

    if (empty($errors)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $conn = $dao->getConnection();
            // Prepare and execute the SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO UserAccount (UserEmail, UserPassword) VALUES (?, ?)");
            $stmt->execute([$email, $hashedPassword]);

            // Redirect to a confirmation page or login page
            header("Location: index.php?registration=success");
            exit();
        } catch (PDOException $e) {
            $errors['database'] = "Error: " . $e->getMessage();
            $_SESSION['errors'] = $errors;
            header("Location: registration.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: registration.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
