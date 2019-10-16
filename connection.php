<?php
$servername = "127.0.0.1:3307";
$username_mysql = "root";
$password_mysql = "";
$db='register_db';

// Create connection
$conn = new mysqli($servername, $username_mysql, $password_mysql, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>