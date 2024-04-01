<?php
echo "I'm an index handler";
     echo "<pre>" . print_r($_POST,1) . "</pre>";
     header('Location: index.php');
     exit;