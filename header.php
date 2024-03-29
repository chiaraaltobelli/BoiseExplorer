<!-- Icon credits: Signpost icons created by surang - Flaticon, Login icons created by Sebastian Belalcazar - Flaticon -->
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Boise Explorer</title>
    <link rel="stylesheet" href="style.css">
</head>
  <body>
    <?php session_start(); ?>
    <header class="site-header">
        <div>
         <a href="index.php" class="header-link">
            <h1>Boise Explorer</h1>
            <img src="images/adventures.png" alt="Boise Explorer Logo" class="branding-icon">
         </a>
         </div>
        <nav class="navbar">
            <ul class="nav-links">
                <?php
                $currentPage = basename($_SERVER['SCRIPT_NAME']);
                ?>
               <li><a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Home</a></li>
               <li><a href="about.php" class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">About</a></li>
               <li><a href="activities.php" class="<?= ($currentPage == 'activities.php') ? 'active' : '' ?>">Activities</a></li>
               <li><a href="generate.php" class="<?= ($currentPage == 'generate.php') ? 'active' : '' ?>">Generate</a></li>
            </ul>
         </nav>
         <div>
            <a 
               href="sign-in.html" class="sign-in-btn"><h3>Sign In</h3>
               <img src="images/user.png" alt="Sign In" class="signin-icon"> 
            </a>
         </div>
    </header>