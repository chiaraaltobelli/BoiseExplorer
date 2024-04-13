<?php require_once __DIR__ . '../../Include/header.php';?>
<body class="page-container">
    <div class="content">
        <div class="generate-container">
            <h1>Generate Itinerary</h1>
            <!-- <div class="dropdown-container">
                <label for="activity">Select:</label>
                <select name="activity" id="activity">
                    <option value="single">Single Activity</option>
                    <option value="fullday">Full Day Itinerary</option>
                </select>
            </div> -->
        </div>
        <div class="content-center">     
        <p>This will eventually pick one activity or create a full day itinerary at random. The button doesn't do anything yet, but the categories and activities are generated programatically from the database.</p>
            <button>Generate</button>
            <h2>Explore Boise</h2>
            <?php
            // Include the DAO class
            require_once __DIR__ . '../../Include/Dao.php';

            // Create a DAO instance
            $dao = new Dao();

            // Fetch activities by time of day
            $activitiesByTimeOfDay = $dao->getActivitiesByTimeOfDay();

            // Display activities grouped by time of day
            foreach ($activitiesByTimeOfDay as $timeOfDay => $activities) {
                echo "<h3>{$timeOfDay}</h3>";
                echo "<ul class='activity-list'>";
                foreach ($activities as $activity) {
                    echo "<li>{$activity}</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
    <script>
    document.getElementById('activity').addEventListener('change', function() {
        alert('You selected: ' + this.value); // Update later
    });
    </script>
<?php require_once __DIR__ . '../../Include/footer.php';?>
