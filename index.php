<?php require_once __DIR__ . '/src/Include/header.php'; ?>
<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Boise Explorer</title>
    <!-- Site styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Popup stying -->
    <link rel="stylesheet" href="popup.css">
</head>
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
  <?php require_once __DIR__ . '/src/Include/footer.php'; ?>