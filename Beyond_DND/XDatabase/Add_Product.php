<?php
// Include the DB connection file
require_once './../XDatabase/db_connection.php'; 

// Create a new DB instance
$db = new DB();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $product_price = htmlspecialchars(trim($_POST['product_price']));
    $product_description = htmlspecialchars(trim($_POST['product_description']));
    $product_status = htmlspecialchars(trim($_POST['product_status']));

    // Validate the status input
    $valid_statuses = ['WIP', 'Coming Soon', 'Available'];
    if (!in_array($product_status, $valid_statuses)) {
        $errorMessage = "Ongeldige status. Kies een van de volgende: 'WIP', 'Coming Soon', 'Available'.";
    }

    // If no errors, insert the product into the database
    if (!isset($errorMessage)) {
        $sql = "INSERT INTO products (name, price, status, description) 
                VALUES (:name, :price, :status, :description)";
        
        try {
            // Execute the SQL query
            $db->execute($sql, [
                ':name' => $product_name,
                ':price' => $product_price,
                ':status' => $product_status,
                ':description' => $product_description
            ]);

            // Success message if the product is added
            $successMessage = "Product succesvol toegevoegd!";
        } catch (PDOException $e) {
            // Error message if something goes wrong
            $errorMessage = "Fout bij het toevoegen van het product: " . $e->getMessage();
        }
    }
}
?>

