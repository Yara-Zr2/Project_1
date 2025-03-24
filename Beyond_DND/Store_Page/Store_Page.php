<?php
require_once './../XDatabase/session_start.php';  // Include session start logic
require './../XDatabase/db_connection.php';

$db = new DB();  // Connect to the database

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding products to the cart when the button is clicked
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    
    // Check if the product is already in the cart
    if (!in_array($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $productId;  // Add the product ID to the cart
    }

    // Redirect to the Shopping Cart page after adding the item
    header("Location: ./Shopping_Cart.php");
    exit();
}

$query = "SELECT * FROM products";
$products = $db->execute($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Beyond D&D</title>
    <link rel="stylesheet" href="../XXIncludes/CSS/Store_Page.css">
    <?php require "../Main_Page_H&F/Navbar/Navbar.php"; ?>
</head>
<body>

<main class="main-content">
    <br><br><br><br>
    <h1>Welcome to the Beyond D&D Store</h1>

    <div class="cart-button-container">
        <a href="./Shopping_Cart.php" class="go-to-cart-link">Go to Cart</a>
    </div>


    <div class="products">
        <?php
        if ($products && count($products) > 0) {
            foreach ($products as $row) {
                echo "
                    <div class='product-box'>
                        <div class='product-info'>
                            <h3 class='product-name'>{$row['name']}</h3>
                            <p class='product-description'>{$row['description']}</p>
                            <p class='product-status'>Status: {$row['status']}</p>
                            <p class='product-price'>" . (empty($row['price']) ? 'Coming Soon' : '$' . $row['price']) . "</p>
                            <form method='POST'>
                                <input type='hidden' name='product_id' value='{$row['id']}'>
                                <button type='submit' name='add_to_cart' class='btn-add-to-cart'>Buy Now</button>
                            </form>
                        </div>
                    </div>";
            }
        } else {
            echo "
                <div class='no-products'>
                    <p id='Error'>Ah, we may have spent all our gold on a magnificent silver dragon statue... and now we have nothing left to sell because we sold everything else!</p>
                    <img id='Dragon' src='../XXIncludes/Images/error.avif' alt='Error'>
                    <p class='disclaimer' id='Disclaimer'>Disclaimer: Something went wrong, the store page might be down.</p>
                </div>
            ";
        }
        ?>
    </div>
</main>

<?php require "../Main_Page_H&F/Footer/footer.php"; ?>

</body>
</html>
