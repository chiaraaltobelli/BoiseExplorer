<?php require_once "header.php"; ?>

<body class="page-container">
    <div class="content">
        <h1>Activities</h1>
        
        <!-- Check if the user is logged in -->
        <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <button id="addActivityBtn">Add Activity</button>
        <?php endif; ?>

        <!-- Include the addactivity popup -->
        <?php require_once "add_activity.html"; ?>

        <!-- Categories -->
        <div class="content-center">
            <h3>Restaurants</h3>
            <h3>Museums</h3>
            <h3>Parks</h3>
            <h3>Hiking Trails</h3>
            <h3>Shops</h3>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="activities.js"></script>

    <?php require_once "footer.php"; ?>
</body>
