<?php 
require_once __DIR__ . '/header.php';
?>
<body class="page-container">
    <div class="content">
        <div class="generate-container">
            <h1>Generate Itinerary</h1>
            <div class="dropdown-container">
                <label for="activity">Select:</label>
                <select name="activity" id="activity">
                    <option value="single">Single Activity</option>
                    <option value="fullday">Full Day Itinerary</option>
                </select>
            </div>
        </div>
        <div class="content-center">     
            <button id="generate-button"  type="button">Generate</button>
            <h2>Explore Boise</h2>
            <div id="activities-container">
            </div>
        </div>
    </div>
        <!-- Link to the JavaScript file -->
        <script src="generate.js"></script>
<?php require_once __DIR__ . '/footer.php';?>
