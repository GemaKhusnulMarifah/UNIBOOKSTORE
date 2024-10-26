<?php
// Database connection settings
$servername = "localhost"; // server name
$username = "root"; // database username
$password = ""; // database password (empty for XAMPP default)
$dbname = "data"; // the name of database

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>