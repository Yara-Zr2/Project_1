<?php
require './../XDatabase/db_connection.php'; // Ensure the correct DB path

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    try {
        // Fetch detailed product info
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo "
                <div class='product-detail'>
                    <h2>{$product['name']}</h2>
                    <img src='../XXIncludes/Images/{$product['image']}' alt='{$product['name']}'>
                    <p><strong>Description:</strong> {$product['description']}</p>
                    <p><strong>Price:</strong> $" . ($product['price'] ? $product['price'] : 'Coming Soon') . "</p>
                    <p><strong>Details:</strong> {$product['details']}</p>
                    <button class='btn' onclick='addToCart({$product['id']})'>Add to Cart</button>
                    <button class='btn' onclick='giftToFriend()'>Gift to Friend</button>
                </div>
            ";
        } else {
            echo "<p>Product not found.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<script>
    function giftToFriend() {
        alert("Coming soon!");
    }

    function addToCart(productId) {
        // Here you can add AJAX logic to add product to cart
        alert("Added to cart!");
    }
</script>
