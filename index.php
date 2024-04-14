<?php require_once __DIR__ . '/header.php'; ?>
<body class="page-container">
    <div class="content">
        <h1>Welcome to the Boise Explorer!</h1>
        <?php
        // Display success message from query string
        if (isset($_GET['subscribe']) && $_GET['subscribe'] == 'success') {
            echo '<p class="success">Thank you for subscribing!</p>';
        }

        // Display any error messages from session
        if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="error-messages" role="alert">
                <?php foreach ($_SESSION['messages'] as $message): ?>
                    <p><?= htmlspecialchars($message); ?></p>
                <?php endforeach; ?>
            </div>
            <?php
            // Clear messages after displaying
            unset($_SESSION['messages']);
        endif;
        ?>
        <p>Stay updated with the latest adventures and stories from Boise. Sign up for our newsletter!</p>
        <form action="index_handler.php" method="POST">
            <input type="email" name="subscriberEmail" placeholder="Enter your email address" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>
    <?php require_once __DIR__ . '/footer.php'; ?>
</body>
