<?php
$servername = "127.0.0.1:3307";
$username_sql = "root";
$password_sql = "";
$db='canteen_db';

// Create connection
$conn = new mysqli($servername, $username_sql, $password_sql, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>