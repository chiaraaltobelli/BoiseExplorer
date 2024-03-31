<?php require_once __DIR__ . '/../includes/header.php';?>
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
    <div class="content">
        <div class="content-center">
            <h2>Explore Boise</h2>
            <h3>Morning</h3>
            <h3>Afternoon</h3>
            <h3>Evening</h3>
        </div>
    </div>
</div>
    <script>
    document.getElementById('activity').addEventListener('change', function() {
        alert('You selected: ' + this.value); // Update later
    });
    </script>
<?php require_once __DIR__ . '/../includes/footer.php';?>
