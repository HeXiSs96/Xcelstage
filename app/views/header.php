<?php
// header.php - En-tête commun à toutes les pages
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/CSS/header.css"> <!-- Le fichier CSS spécifique au header -->
    <title>XcelStage</title>
    <link rel="icon" type="image/png" href="image/logo-png.png">
</head>
<body>
<header>
    <!-- Logo -->
    <div class="logo">
        <img src="image/logo-png.png" alt="Logo XcelStage">
    </div>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="../public/index.php">Accueil</a></li>
            <li><a href="entreprises.php">Entreprises</a></li>
            <li><a href="offres.php">Offres</a></li>
            <li><a href="../app/views/login.php">Connexion</a></li>
        </ul>
    </nav>

    <!-- Menu Burger -->
    <div class="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<script src="JS/header.js"></script>
</body>
</html>
