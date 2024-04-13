<?php
session_start();
require_once __DIR__ . '../../Include/Dao.php';

//Validation
function sanitizeInput($data) {
    //Remove whitespace
    $data = trim($data);
    //Remove (\) to get rid of escaped characters
    $data = stripslashes($data);
    //Convert special characters to prevent attacks
    $data = htmlspecialchars($data);
    return $data; 
}

//Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve and sanitize data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    //Array for validation errors
    $errors = array();

    //Validate email format -- if not in expected format, add to errors array
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    //Validate password format -- if not in expected format, add to errors array
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Password must contain at least one number";
    }

    //Confirm passwords match
    if ($confirmPassword != $password) {
        $errors['confirmPassword'] = "Passwords must match.";
    } 

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if there are any validation errors
    if (empty($errors)) {

        // Hash the password
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $dao = new Dao();
            $dao->getConnection();
            // Prepare and execute the SQL statement for insertion
            // Prepare and execute the SQL statement for insertion
            $stmt = $dao->getConnection()->prepare("INSERT INTO UserAccount (UserEmail, UserPassword) VALUES (?, ?)");
            $stmt->execute([$email, $password]);
            // $stmt->execute([$email, $hashedPassword]);

            // Redirect the user to the login page after successful registration
            header("Location: ../../index.php");
            exit();
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            exit(); // Stop further execution
        }
    } else {
        // Validation errors occurred, redirect back to the registration page with error messages
        $_SESSION['errors'] = $errors;
        header("Location: ../Public/registration.php");
        exit();
    }
} else {
    // Redirect to an error page or home page if accessed directly without submitting the form
    header("Location: ../../index.php");
    exit();
}

}
?>
