<?php
// Include the DB connection file
require_once './../../XDatabase/db_connection.php'; 

// Create a new DB instance
$db = new DB();

// Check if the form has been submitted for deletion
if (isset($_POST['delete_product_id'])) {
    // Get the product id from the form
    $product_id = intval($_POST['delete_product_id']);  // Ensure to sanitize and cast the product id

    // Prepare SQL query to delete the product from the database
    $sql = "DELETE FROM products WHERE id = :id";
    
    try {
        // Execute the SQL query
        $db->execute($sql, [':id' => $product_id]);

        // Success message
        $successMessage = "Product succesvol verwijderd!";
    } catch (PDOException $e) {
        // Error message if something goes wrong
        $errorMessage = "Fout bij het verwijderen van het product: " . $e->getMessage();
    }
}

// Fetch all products to display
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$products = $db->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheer Producten</title>
    <link rel="stylesheet" href="./../../XXIncludes/CSS/Add_Product.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Beheer Producten</h1>
        </header>

        <!-- Success or error message -->
        <?php if (isset($successMessage)): ?>
            <div class="success-message"><?= $successMessage; ?></div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Table to display the products -->
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Prijs (€)</th>
                    <th>Status</th>
                    <th>Beschrijving</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td><?= htmlspecialchars($product['price']); ?></td>
                        <td><?= htmlspecialchars($product['status']); ?></td>
                        <td><?= htmlspecialchars($product['description']); ?></td>
                        <td>
                            <!-- Delete form with a confirmation dialog -->
                            <form action"" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                                <input type="hidden" name="delete_product_id" value="<?= $product['id']; ?>">
                                <button type="submit" class="delete-button">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
