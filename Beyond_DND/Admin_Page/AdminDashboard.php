<?php
require_once './../XDatabase/db_connection.php'; 

$db = new DB();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./../XXIncludes/CSS/Admin_Page.css">
    <?php
        require "./../Main_Page_H&F/Navbar/Navbar.php";
    ?>
</head>
<body>
<div class="admin-container">
    <div class="admin-content">
        <section id="store-management">
            <h2>Store Beheer</h2>
            <a href="./../Store_Page/Add_Remove_Page/Admin_Add_Page.php" class="button">Product Toevoegen</a>
            <a href="./../Store_Page/Add_Remove_Page/Admin_Remove_Page.php" class="button">Product Bewerken</a>
            <a href="./../Store_Page/Add_Remove_Page/Admin_Remove_Page.php" class="button">Product Verwijderen</a>
        </section>

        <section id="user-management">
            <h2>Gebruikersbeheer</h2>
            <a href="view_users.php" class="button">Bekijk Gebruikers</a>
        </section>

        <section id="campaigns-management">
            <h2>Campagnes Beheer W.I.P</h2>
            <a href="#s" class="button">Campagne Maken</a>
            <a href="#" class="button">Bekijk Campagnes</a>
        </section>
    </div>
</div>
<?php
    require "../Main_Page_H&F/Footer/footer.php";
?>
</body>
</html>
