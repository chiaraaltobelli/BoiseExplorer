<?php
session_start();
require_once 'Dao.php';

//Function to sanitize input
//https://www.php.net/manual/en/function.filter-var.php - documentation on filter_var
function sanitizeInput($data, $type = 'string') {
    $data = trim($data);
    $data = stripslashes($data);
    switch ($type) {
        case 'email':
            $data = filter_var($data, FILTER_SANITIZE_EMAIL);
            break;
        case 'integer':
            $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
            break;
        default:
            $data = filter_var($data, FILTER_SANITIZE_STRING);
            break;
    }
    return $data;
}

//Retrieve and sanitize form data
$activityName = sanitizeInput($_POST['activityName']);
$activityType = sanitizeInput($_POST['activityType']);
$season = sanitizeInput($_POST['season']);
$address = sanitizeInput($_POST['address']);
$city = sanitizeInput($_POST['city']);
$state = sanitizeInput($_POST['state']);
$zip = sanitizeInput($_POST['zip'], 'integer'); //Assume zip is an integer

//Default to false if not checked
$morning = isset($_POST['morning']) ? 1 : 0;
$afternoon = isset($_POST['afternoon']) ? 1 : 0;
$evening = isset($_POST['evening']) ? 1 : 0;

//Array to store error messages
$messages = array();

//Validate inputs
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
} elseif (!preg_match("/^\d+\s+[A-Za-z0-9]+\s+[A-Za-z0-9]+(?:\s[A-Za-z\.]+)*$/", $address)) { //digits-space-letters/digits-space-letters/ioptional St./Rd./Ave. etc.
        $messages[] = "Please enter a valid address format.";
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
    //    $_SESSION['messages'] = ["Your activity '" . htmlspecialchars($activityName) . "' has been added."];
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
