<?php
require '../XDatabase/db_connection.php';

$successMessage = "";
$errorMessage = "";

$db = new DB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $db->getPDO()->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $message]);

            $successMessage = "Your message has been successfully sent!";
        } catch (PDOException $e) {
            $errorMessage = "Something went wrong: " . $e->getMessage();
        }
    } else {
        $errorMessage = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Beyond D&D</title>
    <link rel="stylesheet" href="../XXIncludes/CSS/Contact_About.css">
</head>
<body>
    <?php
        require "../Main_Page_H&F/Navbar/Navbar.php";
    ?>

    <main>
        <section class="contact">
            <div class="container">
                <h2>Contact Us</h2>
                <p>Have questions or feedback? Let us know!</p>

                <?php if ($successMessage) echo "<p style='color: red; font-weight: bold;'>$successMessage</p>"; ?>
                <?php if ($errorMessage) echo "<p style='color: red; font-weight: bold;'>$errorMessage</p>"; ?>

                <form action="contact.php" method="post">
                    <label>Name:</label>
                    <input type="text" name="name" required>

                    <label>Email:</label>
                    <input type="email" name="email" required>

                    <label>Message:</label>
                    <textarea name="message" required></textarea>

                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>

    <?php
        require "../Main_Page_H&F/Footer/footer.php";
    ?>
</body>
</html>