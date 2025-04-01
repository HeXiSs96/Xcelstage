<?php $title = "Tableau de bord"; ?>
<?php require 'layouts/header.php'; ?>

<h1>Bienvenue sur le tableau de bord</h1>


<?php 

session_start(); 

if ($_SESSION['Role'] == 'Administrateur'): ?>
    <a href="gestion_utilisateurs.php">Gérer les utilisateurs</a>
<?php endif; ?>

<?php require 'layouts/footer.php'; ?>
