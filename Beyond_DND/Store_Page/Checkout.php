<?php
require_once './../XDatabase/session_start.php';  // Include session start logic
require './../XDatabase/db_connection.php';

$db = new DB();  // Connect to the database

$cartProducts = [];
if (!empty($_SESSION['cart'])) {
    $cartProductIds = implode(',', array_map('intval', $_SESSION['cart']));
    $query = "SELECT * FROM products WHERE id IN ($cartProductIds)";
    $cartProducts = $db->execute($query)->fetchAll(PDO::FETCH_ASSOC);
}

// Simple form to submit the order (you can extend this with payment logic later)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Save order to database or process payment logic here
    $_SESSION['cart'] = []; // Clear the cart after the order
    header("Location: ./Thank_You.php"); // Redirect to a thank-you page after order submission
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Beyond D&D</title>
    <link rel="stylesheet" href="../XXIncludes/CSS/Checkout_Cart.css">
    <?php require "../Main_Page_H&F/Navbar/Navbar.php"; ?>
</head>
<body>
<main class="main-content">
    <div class="checkout-container">
        <h1>Checkout</h1>

        <?php
        if (count($cartProducts) > 0) {
            echo '<form method="POST">';
            echo "<div class='cart-items-list'>";
            foreach ($cartProducts as $product) {
                echo "<div class='cart-item'>
                        <div class='item-info'>
                            <p><strong>{$product['name']}</strong></p>
                            <p>Price: $" . (empty($product['price']) ? 'Coming Soon' : $product['price']) . "</p>
                            <label for='quantity[{$product['id']}]'>Quantity:</label>
                            <input type='number' name='quantity[{$product['id']}]' value='1' min='1' max='1' class='quantity' readonly>
                        </div>
                    </div>";
            }
            echo "</div>";

            // Customer info form
            echo "
                <h2>Billing Information</h2>
                <div class='checkout-form'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name' required>

                    <label for='address'>Address:</label>
                    <input type='text' name='address' required>

                    <label for='email'>Email:</label>
                    <input type='email' name='email' required>

                    <div class='form-actions'>
                        <button type='submit' class='btn-submit-order'>Submit Order</button>
                    </div>
                </div>
            </form>";
        } else {
            echo "<p>Your cart is empty. Please add items to your cart before proceeding to checkout.</p>";
        }
        ?>
    </div>
</main>

<?php require "../Main_Page_H&F/Footer/footer.php"; ?>

</body>
</html>
