<?php require_once __DIR__ . '/header.php'; ?>
<body class="page-container">
    <div class="content">
        <h1>Invalid Account Registration</h1>
    <?php
        //Display any error messages
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="error-messages" role="alert">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <p><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php
        unset($_SESSION['errors']); // Clear errors after displaying
    endif;
?>
    </div>
<?php require_once __DIR__ . '/footer.php'; ?>
