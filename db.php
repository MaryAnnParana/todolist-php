<?php
$host = 'localhost';
$user = 'root'; // Default for XAMPP
$password = ''; // Leave empty for XAMPP
$dbname = 'todo_db';

// Create a database connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
