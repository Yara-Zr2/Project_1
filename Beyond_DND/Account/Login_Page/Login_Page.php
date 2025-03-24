<?php
session_start(); // Start the session

require '../../XDatabase/db_connection.php';

$db = new DB();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure to trim any extra spaces and escape the inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Escape special characters to prevent XSS attacks
    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // Prepared statement for user authentication
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->execute($sql, [$username]);

    if ($user = $stmt->fetch()) {
        // Verify the password using password_verify() for hashed passwords
        if (password_verify($password, $user['password_hash'])) {
            // Correct login credentials
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];

            // Redirect user to the homepage
            header("Location: ../../Main_Page/Homepage.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Beyond D&D</title>
    <link rel="stylesheet" href="../../XXIncludes/CSS/Login_Register.css">
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">
                <img src="../../XXIncludes/Images/DND.png" alt="Logo" height="70">
            </h1>
        </div>
    </header>

    <main class="auth-container">
        <section class="auth-box">
            <h2>Login to Beyond D&D</h2>

            <?php 
            if (isset($error_message)) {
                echo "<p style='color: red; font-weight: bold;'>$error_message</p>"; 
            }
            ?>

            <form action="Login_Page.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit" class="btn">Login</button>
            </form>
            
            <p class="register-link">Don't have an account? 
            <br>    
            <a href="../Register_Page/Register_Page.php">Register now</a></p>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Beyond D&D. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
