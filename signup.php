<?php
session_start();
require_once '../includes/db_connection.php'; // Ensure this file connects to your database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'signup') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
        $role = $_POST['role'];
        $status = $_POST['status'];

        // Insert user into the database
        $query = "INSERT INTO users (id, name, username, password, role, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $id, $name, $username, $password, $role, $status);

        if ($stmt->execute()) {
            $success = "User registered successfully!";
        } else {
            $error = "Error: Could not register user. " . $conn->error;
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: ../admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Ensure correct path -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #003d80;
        }

        .message {
            text-align: center;
            margin-top: 15px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .toggle {
            text-align: center;
            margin-top: 15px;
        }

        .toggle a {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
        }

        .toggle a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo isset($_GET['action']) && $_GET['action'] === 'signup' ? 'Sign Up' : 'Login'; ?></h1>
        <?php if (isset($success)): ?>
            <div class="message success"> <?php echo $success; ?> </div>
        <?php elseif (isset($error)): ?>
            <div class="message error"> <?php echo $error; ?> </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <?php if (isset($_GET['action']) && $_GET['action'] === 'signup'): ?>
                <div class="form-group">
                    <label for="id">User ID</label>
                    <input type="text" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if (isset($_GET['action']) && $_GET['action'] === 'signup'): ?>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="Admin">Admin</option>
                        <option value="Billing Processor">Billing Processor</option>
                        <option value="Manager">Manager</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" name="action" value="signup" class="btn">Sign Up</button>
            <?php else: ?>
                <button type="submit" name="action" value="login" class="btn">Login</button>
            <?php endif; ?>
        </form>
        <div class="toggle">
            <?php if (isset($_GET['action']) && $_GET['action'] === 'signup'): ?>
                Already have an account? <a href="?action=login">Login</a>
            <?php else: ?>
                Don't have an account? <a href="?action=signup">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
