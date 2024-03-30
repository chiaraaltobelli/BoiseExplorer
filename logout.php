<?php
    session_start();
    session_destroy();
    header("Location: http://localhost/boiseexplorer/index.php");
    exit();