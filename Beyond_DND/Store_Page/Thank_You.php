<?php
// Start session to use session variables (if needed)
require_once './../XDatabase/session_start.php';  

// Destroy cart after checkout (or upon thanking)
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Purchase!</title>
    <link rel="stylesheet" href="../XXIncludes/CSS/Thank_You.css">
</head>
<body>
<main class="thank-you-main">
    <div class="thank-you-container">
        <h1>Thank You for Your Purchase!</h1>
        <p>Your order has been successfully completed.</p>
        <form action="./../Main_Page/Homepage.php" method="get">
            <button type="submit" class="back-button">Go Back to Main Page</button>
        </form>
    </div>
</main>
</body>
</html>
