<?php
// Inclure l'en-tête pour éviter la répétition sur plusieurs pages
include("../app/views/header.php");
?>

<!-- Lien vers le fichier CSS -->
<link rel="stylesheet" href="/Xcelstage/public/CSS/style.css">

<main>
    <!-- Contenu spécifique à la page d'accueil -->
    <div class="principale">
        <div class="titre">
            <h1>XcelStage</h1>
        </div>
        <div class="bouton">
            <a href="chercher_une_offre.php" class="btn">RECHERCHER UNE OFFRE</a>
            <a href="../app/views/index_ut.php" class="btn">RECHERCHER UNE ENTREPRISE</a>
        </div>
    </div>
</main>

<?php
// Inclure le pied de page pour éviter la répétition sur plusieurs pages
include("../app/views/footer.php");
?>

<script src="/public/JS/script.js"></script>
