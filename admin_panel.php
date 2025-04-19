<?php
session_start();
require_once 'includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="user_management.php">User Management</a>
        <a href="customer_service.php">Customer Service</a>
        <a href="system_maintenance.php">System Maintenance</a>
        <a href="reports_analytics.php">Reports & Analytics</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main-content">
        <h1>Welcome to the Admin Panel</h1>
        <p>Select an option from the sidebar to get started.</p>
    </div>
</body>
</html>
