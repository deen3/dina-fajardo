<?php

function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db_name = "propelrr";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }  
    
}

?>