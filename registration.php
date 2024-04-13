<?php require_once __DIR__ . '/header.php'; ?>
<body class="page-container">
    <div class="content">
        <h1>Invalid Account Registration</h1>
        <p>This will eventually have fancier error display.</p>
        <?php
        // Check if there are any validation errors in the session
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo "<ul>";
            // Iterate through each error and print it
            foreach ($_SESSION['errors'] as $error) {
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
            // Clear the session variable after displaying the errors
            unset($_SESSION['errors']);
        }
        ?>
    </div>
<?php require_once __DIR__ . '/footer.php'; ?>
