<?php
session_start();
require_once 'Dao.php';

//Retrieve form data
$activityName = $_POST['activityName'];
$activityType = $_POST['activityType'];
$season = $_POST['season'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

//Default to false if not checked
$morning = isset($_POST['morning']) ? 1 : 0;
$afternoon = isset($_POST['afternoon']) ? 1 : 0;
$evening = isset($_POST['evening']) ? 1 : 0;

//Array to store error messages
$messages = array();

//Perform validation
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

if (!empty($address)) {
    // Updated regex to include numbers, letters, and common abbreviations for street types
    if (!preg_match("/^\d+\s+[A-Za-z0-9]+\s+[A-Za-z0-9]+(?:\s[A-Za-z\.]+)*$/", $address)) {
        $messages[] = "Please enter a valid address format.";
    }
}

if (empty($city)) {
    $messages[] = "Please select a city.";
}

if (empty($state)) {
    $messages[] = "Please select a state.";
}

if (empty($zip)) {
    $messages[] = "Please enter a zipcode.";
}

if (!empty($zip)) {
    if (!preg_match("/^\d{5}/", $zip)) { //zipcode has 5 digits
        $messages[] = "Please enter a valid zipcode.";
    }  
}

//If there are validation errors, redirect back to the form with error messages
if (!empty($messages)) {
    $_SESSION['messages'] = $messages;
    $_SESSION['inputs'] = $_POST; //store data from the form
    header("Location: activities.php");
    exit();
}

//If validation passes, proceed with saving the activity
$dao = new Dao();
$result = $dao->saveActivity($activityName, $activityType, $morning, $afternoon, $evening, $season, $address, $city, $state, $zip);

switch ($result) {
    case 'success':
    //     $_SESSION['messages'] = ["Your activity '" . htmlspecialchars($activityName) . "' has been added."];
        break;
    case 'activity_exists':
        $_SESSION['messages'] = ["The activity '" . htmlspecialchars($activityName) . "' already exists."];
        break;
    case 'login_required':
        $_SESSION['messages'] = ["You must be logged in to add an activity."];
        break;
    case 'database_error':
        $_SESSION['messages'] = ["There was a problem saving the activity. Please try again later."];
        break;
    default:
        $_SESSION['messages'] = ["An unexpected error occurred."];
        break;
    }

//Redirect back to the activities page
header("Location: activities.php");
exit();
?>
