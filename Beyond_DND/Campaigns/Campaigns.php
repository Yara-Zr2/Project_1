<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns - Beyond D&D</title>
    <link rel="stylesheet" href="./../XXIncludes/CSS/campaigns.css">
    <?php
        require "./../Main_Page_H&F/Navbar/Navbar.php";
    ?>
</head>
<body>
<main>
    <section class="campaigns">
        <div class="container">
            <h1>Campaigns - Coming Soon!</h1>
            <p>Adventures await... but not just yet! Our brave developers are hard at work crafting epic campaigns for you to embark on.</p>
            <p>Stay tuned for exciting updates and prepare your party for legendary quests!</p>
            <img src="./../XXIncludes/Images/DND 503 Error.jpg" alt="Coming Soon" class="coming-soon">
            <br>
            <button class="notify-btn" onclick="notifyMe()">Notify Me When Ready</button>
            <p class="disclaimer">*Note: You will be notified through the website when this feature becomes available.</p>
        </div>
    </section>
</main>
<script>
    function notifyMe() {
        alert("Notification feature coming soon!");
    }
</script>

<?php
    require "../Main_Page_H&F/Footer/footer.php";
?>

</body>
</html>
