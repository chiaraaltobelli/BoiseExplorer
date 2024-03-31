<?php
// Parse ClearDB database URL
$db_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$db_host = $db_url["host"];
$db_username = $db_url["user"];
$db_password = $db_url["pass"];
$db_name = substr($db_url["path"], 1);

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test the connection
    $stmt = $pdo->query("SELECT 'Connected successfully' AS message");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['message'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
