<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
    <link rel="stylesheet" href="./../../XXIncludes/CSS/Add_Product.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Product Toevoegen</h1>
        </header>

        <!-- Success or error message -->
        <?php if (isset($successMessage)): ?>
            <div class="success-message"><?= $successMessage; ?></div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage; ?></div>
        <?php endif; ?>

        <!-- Product addition form -->
        <form action="./../../../XDatabase/Add_Product.php" method="POST">
            <div class="form-group">
                <label for="product_name">Product Naam</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="product_price">Prijs (€)</label>
                <input type="number" id="product_price" name="product_price" required step="0.01">
            </div>

            <div class="form-group">
                <label for="product_status">Status</label>
                <select id="product_status" name="product_status" required>
                    <option value="WIP">WIP (Work in Progress)</option>
                    <option value="Coming Soon">Coming Soon</option>
                    <option value="Available">Available</option>
                </select>
            </div>

            <div class="form-group">
                <label for="product_description">Beschrijving</label>
                <textarea id="product_description" name="product_description" rows="4" required></textarea>
            </div>

            <button type="submit">Voeg Product Toe</button>
        </form>
    </div>
</body>
</html>