
<?php 
require_once __DIR__ . '/header.php'; 
require_once __DIR__ . '/Dao.php'; 
?>

<body class="page-container">
    <div class="content">
        <h1>Activities</h1>

        <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <!-- <p>Logged in as UserID: <?= htmlspecialchars($_SESSION['userID'] ?? 'Not set'); ?></p> -->
            <button id="addActivityBtn">Add Activity</button>
        <?php else: ?>
            <!-- <p>User not logged in or UserID not set.</p> -->
        <?php endif; ?>
        <!-- Include the addactivity popup -->
        <?php require_once "add_activity.php"; ?>

        <!-- Categories -->
        <div class="content-activity">
        <?php
        $dao = new Dao();
        $userID = $_SESSION['userID'] ?? null;//Use null if the user is not logged in ?> 
        <!-- <p>Logged in as UserID: <?= htmlspecialchars($_SESSION['userID'] ?? 'Not set'); ?></p> -->
        <?php
        $activityTypesWithActivities = $dao->getActivityTypesWithActivities();
        foreach ($activityTypesWithActivities as $activityType => $activities) {
            echo "<div class='activity-type'>";
            echo "<h3>{$activityType}</h3>";
            echo "<ul class='activity-list'>";
            foreach ($activities as $activity) {
                echo "<li>{$activity}</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
        </div>
    </div>

    <?php require_once __DIR__ . '/footer.php'; ?>
</body>
