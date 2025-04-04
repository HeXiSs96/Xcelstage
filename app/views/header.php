<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Xcelstage/public/CSS/header.css"> 
    <title>XcelStage</title>
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
<header>
    <!-- Logo -->
    <div class="logo">
        <img src="/Xcelstage/public/image/logo-png.png" alt="Logo XcelStage">
    </div>

    <!-- Navigation -->
    <nav>
        <ul>
        <?php
            if (isset($_SESSION['Role']) && ($_SESSION['Role'] == "Administrateur" || $_SESSION['Role'] == "Pilote")) : ?>
                <li><a href="/Xcelstage/app/views/admin_dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <li><a href="/Xcelstage/public/index.php">Accueil</a></li>
            <li><a href="/Xcelstage/app/views/EntrepriseView.php">Entreprises</a></li>
            <li><a href="/Xcelstage/app/views/recherche.php">Offres</a></li>
            <?php
            if (isset($_SESSION['Role'])) : ?>
                <li><a href="/Xcelstage/app/controllers/deconnection.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="/Xcelstage/app/views/login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Menu Burger -->
    <div class="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<script src="/Xcelstage/public/JS/header.js"></script>
</body>
</html>