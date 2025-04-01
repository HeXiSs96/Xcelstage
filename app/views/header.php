<?php
// header.php - En-tête commun à toutes les pages
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/header.css">
    <title>XcelStage</title>
    <link rel="icon" type="image/png" href="image/logo-png.png">
</head>
<body>
<header>
    <div class="logo">
        <img src="image/logo-png.png" alt="Logo XcelStage">
    </div>
    <nav>
        <ul>
            <li><a href="../app/views/index.php">Accueil</a></li>
            <li><a href="../app/views/entreprises.php">Entreprises</a></li>
            <li><a href="../app/views/offres.php">Offres</a></li>
            <li><a href="../app/views/contact.php">Contactez-nous</a></li>
            <li><a href="../app/views/login.php">Connexion</a></li>
        </ul>
    </nav>
</header>

<?php
