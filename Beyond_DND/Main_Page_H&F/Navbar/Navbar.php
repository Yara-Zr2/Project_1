<?php
require_once './../XDatabase/session_start.php';
echo '<link rel="stylesheet" href="../XXIncludes/CSS/Footer_Header.css">';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="headerContainer">
            <h1 class="logo" id="logo">
                <img src="../XXIncludes/Images/DND.png" alt="Logo" height="70">
            </h1>
            <nav>
                <ul>
                    <li><a href="./../Main_Page/Homepage.php">Home</a></li>
                    <li><a href="#">Character Management</a></li>
                    <li><a href="./../Campaigns/Campaigns.php">Campaigns</a></li>
                    <li><a href="./../Homebrew/Homebrew.php">Homebrew</a></li>
                    <li><a href="./../Store_Page/Store_Page.php">Marketplace</a></li>

                    <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['user_id'])) {
                        // Check if the user is an admin
                        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                            // Display the Admin Dashboard link if the user is an admin
                            echo '<li><a href="./../Admin_Page/AdminDashboard.php">Admin Dashboard</a></li>';
                        }
                        // Show the logout option for logged-in users
                        echo '<li><a href="./../Account/Logout.php" style="color: red; font-weight: bold;">Logout</a></li>';
                    } else {
                        // Show login and register options for guests (not logged in)
                        echo '<li><a href="./../Account/Login_Page/Login_Page.php">Login</a></li>';
                        echo '<li><a href="./../Account/Register_Page/Register_Page.php">Register</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
