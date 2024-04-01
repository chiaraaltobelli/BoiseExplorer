<?php require_once __DIR__ . '/header.php'; ?>

<body class="page-container">
    <div class="content">
        <h1>Activities</h1>
        
        <!-- Check if the user is logged in -->
        <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <button id="addActivityBtn">Add Activity</button>
        <?php endif; ?>

        <!-- Include the addactivity popup -->
        <?php require_once "add_activity.php"; ?>

        <!-- Categories -->
        <div class="content-activity">
        <?php
        require_once __DIR__ . '/Dao.php';
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

    <?php require_once __DIR__ . '/footer.php'; ?>
</body>
