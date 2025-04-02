<?php include  "/header.php"; ?>

<<<<<<< HEAD
if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /Xcelstage/public/");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de XcelStage</title>
=======
<main>
    <h1>Bienvenue dans la gestion de XcelStage</h1>
    <div class="buttons">
        <a href="index_offre.php" class="btn">Offres</a>
        <a href="index_entreprise.php" class="btn">Entreprises</a>
        <a href="index_ut.php" class="btn">Utilisateurs</a>
    </div>
    <!-- Lien vers le fichier CSS spécifique pour le main -->
>>>>>>> 8bdd5e1 (admin dashboard)
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style.css">
</main>

<?php include "/footer.php"; ?>
