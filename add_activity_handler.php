<?php
session_start();
require_once 'Dao.php';

// Retrieve form data
$activityName = $_POST['activityName'];
$activityType = $_POST['activityType'];
$season = $_POST['season'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

// These values may or may not be checked, default to false if not checked
$morning = isset($_POST['morning']) ? 1 : 0;
$afternoon = isset($_POST['afternoon']) ? 1 : 0;
$evening = isset($_POST['evening']) ? 1 : 0;

// Array to store error messages
$messages = array();

// Perform validation
if (empty($activityName)) {
    $messages[] = "Please enter an activity name.";
}

if (empty($activityType)) {
    $messages[] = "Please select an activity type.";
}

if (empty($season)) {
    $messages[] = "Please select a season.";
}

if (empty($address)) {
    $messages[] = "Please enter an address.";
}

if (empty($city)) {
    $messages[] = "Please enter a city.";
}

if (empty($state)) {
    $messages[] = "Please enter a state.";
}

if (empty($zip)) {
    $messages[] = "Please enter a zip code.";
}

// If there are validation errors, redirect back to the form with error messages
if (!empty($messages)) {
    $_SESSION['messages'] = $messages;
    $_SESSION['inputs'] = $_POST;
    header("Location: http://localhost/boiseexplorer/activities.php");
    exit();
}

// If validation passes, proceed with saving the activity
$dao = new Dao();
$success = $dao->saveActivity($activityName, $activityType, $morning, $afternoon, $evening, $season, $address, $city, $state, $zip);

// Set success or error message
if ($success) {
    $_SESSION['messages'] = array("Your activity has been added.");
} else {
    $_SESSION['messages'] = array("Failed to save the activity.");
}

// Redirect back to the activities page
header("Location: http://localhost/boiseexplorer/activities.php");
exit();
?>
