<?php
$host = 'localhost';
$user = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password
$database = 'billing_system';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
