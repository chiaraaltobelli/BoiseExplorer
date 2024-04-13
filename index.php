<?php require_once __DIR__ . '/header.php'; ?>
<body class="page-container">
    <div class="content">
      <h1>Welcome to the Boise Explorer!</h1>
      <p>Stay updated with the latest adventures and stories from Boise. Sign up for our newsletter!</p>
      <p>This doesn't do anything yet. It will eventually add the user email to the subscriber table.</p>
      <form action="../handlers/index_handler.php" method="POST">
          <input type="email" name="email" placeholder="Enter your email address" required>
          <button type="submit">Subscribe</button>
      </form>
  </div>
  <?php require_once __DIR__ . '/footer.php'; ?>