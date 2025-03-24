<?php
require '../../XDatabase/db_connection.php';
$db = new DB();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $sql_check = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $db->execute($sql_check, [$username, $email]);

        if ($stmt->rowCount() > 0) {
            $error_message = "Username or email is already in use.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
            $stmt = $db->execute($sql_insert, [$username, $email, $password_hash]);

            if ($stmt) {
                header("Location: ../Login_Page/Login_Page.php");
                exit();
            } else {
                $error_message = "Error: Could not execute the query.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Beyond D&D</title>
    <link rel="stylesheet" href="../../XXIncludes/CSS/Login_Register.css">
</head>
<body>
    <header>
        <div class="header">
            <h1 class="logo">
                <img src="../../XXIncludes/Images/DND.png" alt="Logo">
            </h1>
        </div>
    </header>

    <main class="auth-container">
        <section class="auth-box">
            <h2>Register for Beyond D&D</h2>
            <?php if (!empty($error_message)): ?>
                <p style='color: red; font-weight: bold;'><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="Register_Page.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Choose a username" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Choose a password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

                <button type="submit" class="btn">Register</button>
            </form>

            <p class="login-link">Already have an account?
            <br>
            <a href="../Login_Page/Login_Page.php">Login now</a></p>
        </section>
    </main>
</body>
</html>
