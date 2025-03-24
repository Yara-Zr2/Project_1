<?php
require_once './../XDatabase/session_start.php';  // Include session start logic
require './../XDatabase/db_connection.php';

$db = new DB();  // Connect to the database

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartProducts = [];
if (!empty($_SESSION['cart'])) {
    $cartProductIds = implode(',', array_map('intval', $_SESSION['cart']));
    $query = "SELECT * FROM products WHERE id IN ($cartProductIds)";
    $cartProducts = $db->execute($query)->fetchAll(PDO::FETCH_ASSOC);
}

// Remove item from the cart if 'remove_item' button is clicked
if (isset($_POST['remove_item'])) {
    $productIdToRemove = $_POST['product_id'];
    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$productIdToRemove]); // Remove item from cart array
    header("Location: ./Shopping_Cart.php"); // Redirect to refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="../XXIncludes/CSS/Store_Page.css">
    <?php require "../Main_Page_H&F/Navbar/Navbar.php"; ?>
</head>
<body>

<main class="main-content">
    <br>
    <br>
    <br>
    <br>
    <h1>Your Shopping Cart</h1>

    <?php
    if (count($cartProducts) > 0) {
        echo "<div class='cart-container'>";
        foreach ($cartProducts as $product) {
            echo "<div class='cart-item'>
                    <div class='item-info'>
                        <p><strong>{$product['name']}</strong></p>
                        <p>Price: $" . (empty($product['price']) ? 'Coming Soon' : $product['price']) . "</p>
                        
                        <!-- Remove button -->
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='product_id' value='{$product['id']}'>
                            <button type='submit' name='remove_item' class='btn-remove-item'>Remove</button>
                        </form>
                    </div>
                </div>";
        }
        echo "</div>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

    <!-- Continue Shopping or Proceed to Checkout -->
    <div class="cart-actions">
        <a href="./Store_Page.php">Continue Shopping</a>
        <a href="./Checkout.php">Proceed to Checkout</a>
    </div>

</main>

<?php require "../Main_Page_H&F/Footer/footer.php"; ?>

</body>
</html>
