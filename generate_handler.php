<?php
session_start();
require_once __DIR__ . '/Dao.php'; 

$type = $_POST['type'] ?? 'single';  // Default to single if type is not specified

$dao = new Dao();
$activities = [];

if ($type === 'fullday') {
    $activities = $dao->getRandomActivitiesByTimeOfDay(3);
    // Output formatted activities
    foreach ($activities as $timeOfDay => $activityList) {
        echo "<h3>{$timeOfDay}</h3>";
        echo "<ul class='activity-list'>";
        foreach($activityList as $activity) {
            echo "<li>{$activity}</li>";
        }
        echo "</ul>";
    }
} else {
    // Fetch a single random activity for each time of day
    $activity = $dao->getRandomActivity();
    echo "<ul class='activity-list'>";
    echo "<li>{$activity['ActivityName']}</li>";
    echo "</ul>";
    // $activities = array_fill_keys(['Morning', 'Afternoon', 'Evening'], [$activities['ActivityName']]);
}


exit;
