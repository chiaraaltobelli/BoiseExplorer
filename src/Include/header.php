<?php session_start(); ?>
<!-- Icon credits: Signpost icons created by surang - Flaticon, Login icons created by Sebastian Belalcazar - Flaticon -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Boise Explorer</title>
    <!-- Site styling -->
    <link rel="stylesheet" href="../style.css">
    <!-- Popup stying -->
    <link rel="stylesheet" href="../popup.css">
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div>
            <!-- Branding -->
            <a href="../../index.php" class="header-link">
                <h1>Boise Explorer</h1>
                <img src="/test/images/adventures.png" alt="Boise Explorer Logo" class="branding-icon">
            </a>
        </div>
        
        <!-- Navigation -->
        <nav class="navbar">
            <ul class="nav-links">
                <?php
                $currentPage = basename($_SERVER['SCRIPT_NAME']);
                ?>
                <li><a href="../../index.php" class="<?= ($currentPage == '../../index.php') ? 'active' : '' ?>">Home</a></li>
                <li><a href="/test/src/Public/about.php" class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">About</a></li>
                <li><a href="/test/src/Public/activities.php" class="<?= ($currentPage == 'activities.php') ? 'active' : '' ?>">Activities</a></li>
                <li><a href="/test/src/Public/generate.php" class="<?= ($currentPage == 'generate.php') ? 'active' : '' ?>">Generate</a></li>
            </ul>
        </nav>

         <!-- Include the login status checker -->
         <?php require_once __DIR__ . '/login_logout_buttons.php'; ?>

         <!-- Include the login popup -->
         <?php require_once __DIR__ . '../../Public/login.php'; ?>
         
   </header>
</body>
</html>