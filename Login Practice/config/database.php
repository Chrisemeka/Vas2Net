<?php 
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'login_practice');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_PORT', '3307');


    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if($conn -> connect_error){
        die('Connection failed'. $conn -> connect_error);
    };
?>

