<?php
session_start();
require_once 'Dao.php';

$messages = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subscriberEmail = $_POST['subscriberEmail'] ?? ''; //Update to sanitize first

    if (empty($subscriberEmail) || !filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL)) {
        $messages[] = "Invalid email format.";
    }

    if (empty($messages)) {
        $dao = new Dao();
        $conn = $dao->getConnection();
        //Check if user is already subscribed
        $stmt = $conn->prepare("SELECT SubscriberEmail FROM Subscriber WHERE SubscriberEmail = ?");
        $stmt->execute([$subscriberEmail]);
        $existingSubscriber = $stmt->fetch(PDO::FETCH_ASSOC);

        if($existingSubscriber) {
            $messages[] = "This email is already subscibed.";
            $_SESSION['messages'] = $messages;
            header("Location: index.php");
            exit();
        }
        
        try{ //move to Dao.php
            $stmt = $conn->prepare("INSERT into Subscriber (SubscriberEmail) VALUES (?)");
            $stmt->execute([$subscriberEmail]);
            header("Location: index.php?subscribe=success");
            exit();
        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            $messages[] = "Unable to subscribe at the moment. Please try again later.";
            $_SESSION['messages'] = $messages;
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['messages'] = $messages;
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
