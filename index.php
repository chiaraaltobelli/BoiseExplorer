<?php require_once "header.php"; ?>
<body class="page-container">
    <div class="content">
      <h1>Welcome to the Boise Explorer!</h1>
      <p>Stay updated with the latest adventures and stories from Boise. Sign up for our newsletter!</p>
      <form action="index_handler.php" method="POST">
          <input type="email" name="email" placeholder="Enter your email address" required>
          <button type="submit">Subscribe</button>
      </form>
      <p>Additional content for this page TBD.</p>
  </div>
  <?php require_once "footer.php"; ?>

