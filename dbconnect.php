<?php
    echo "PHP is running!";
    
    define('DB_SERVER', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'tuitionanjung');

    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if (!$db) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        echo "Connection successful!";
    }
?>
