<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homebrew - Beyond D&D</title>
    <link rel="stylesheet" href="./../XXIncludes/CSS/Homebrew.css">
    <?php
        require "./../Main_Page_H&F/Navbar/Navbar.php";
    ?>
</head>
<body>
<main>
    <section class="Homebrew">
        <div class="container">
            <h1>Homebrew - Coming Soon!</h1>
            <p>New realms are being forged and epic tales are being written... but not just yet! Our brave developers are crafting legendary campaigns for you to explore.</p>
            <p>Prepare your party and sharpen your blades—great adventures await!</p>
            <img src="./../XXIncludes/Images/DND 503 Error.jpg" alt="Coming Soon" class="coming-soon">
            <br>
            <button class="notify-btn" onclick="notifyMe()">Notify Me When Ready</button>
            <p class="disclaimer">*You will be notified through the website when this feature becomes available.</p>
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
