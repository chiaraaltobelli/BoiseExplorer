<?php
echo "I'm an activity handler";
     echo "<pre>" . print_r($_POST,1) . "</pre>";
     header('Location: activities.php');
     exit;