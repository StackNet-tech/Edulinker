<?php
// db_config.php

$servername = "localhost";
$username = "root"; // Your database username
$password = '$enujaImeth123'; // Your database password
$dbname = "edulinker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
