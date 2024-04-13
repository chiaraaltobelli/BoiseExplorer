<?php 
require_once __DIR__ . '/../../config.php';
require_once(BASE_PATH . '/src/include/header.php');
// if (file_exists($path)) {
//     require_once $path;
    
//     // Check if BASE_PATH is defined
//     if (defined('BASE_PATH')) {
//         require_once(BASE_PATH . '/src/include/header.php');
//     } else {
//         die('BASE_PATH is not defined');
//     }
// } else {
//     die("Could not find config.php at path: $path");
// }
?>

<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Boise Explorer</title>
    <!-- Site styling -->
    <link rel="stylesheet" href="../style.css">
    <!-- Popup stying -->
    <link rel="stylesheet" href="../popup.css">
</head>
<body class="page-container">
    <div class="content">
        <h1>Activities</h1>
        
        <!-- Check if the user is logged in -->
        <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <button id="addActivityBtn">Add Activity</button>
        <?php endif; ?>
        <p>When logged in, this page allows the user to add their own activities. Right now it shows all activities, eventually it will show only the default activities and the logged in user's custom activities.</p>
        <!-- Include the addactivity popup -->
        <?php require_once(BASE_PATH . '/src/include/Dao.php'); ?>

        <!-- Categories -->
        <div class="content-activity">
        <?php
        require_once __DIR__ . '../../Include/Dao.php';
        $dao = new Dao();
        $activityTypesWithActivities = $dao->getActivityTypesWithActivities();
        foreach ($activityTypesWithActivities as $activityType => $activities) {
            echo "<div class='activity-type'>";
            echo "<h3>{$activityType}</h3>";
            echo "<ul class='activity-list'>"; // Use a <ul> for activity list
            foreach ($activities as $activity) {
                echo "<li>{$activity}</li>"; // Wrap each activity in <li> tags
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
        </div>

        <!-- Categories without db for testing-->
        <!-- <div class="content-center">
            <h3>Restaurants</h3>
            <h3>Museums</h3>
            <h3>Parks</h3>
            <h3>Hiking Trails</h3>
            <h3>Shops</h3>
        </div> -->
    </div>

    <!-- JavaScript -->
    <script src="activities.js"></script>

    <?php require_once __DIR__ . '../../Include/footer.php'; ?>
</body>
