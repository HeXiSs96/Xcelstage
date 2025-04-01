<?php
session_start();

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /xcelstage/public/");
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_entreprise = $_POST['nom_entreprise'];
    $adresse = $_POST['adresse'];
    $secteur = $_POST['secteur'];

    $sql = "INSERT INTO entreprises (nom, adresse, secteur) VALUES ('$nom_entreprise', '$adresse', '$secteur')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Entreprise ajoutée avec succès.";
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Entreprise</title>
</head>
<body>
    <h2>Ajouter une entreprise</h2>
    <form method="post" action="../controllers/createEntreprise.php">
        <label for="nom_entreprise">Nom de l'entreprise:</label><br>
        <input type="text" id="nom_entreprise" name="nom_entreprise" required><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required><br><br>
        <label for="tel">Telephone:</label><br>
        <input type="text" id="tel" name="tel" required><br><br>
        <label for="site">Site web:</label><br>
        <input type="text" id="site" name="site" required><br><br>
        <label for="ville">Ville:</label><br>
        <input type="text" id="ville" name="ville" required><br><br>
        <label for="secteur">Secteur d'activité:</label><br>
        <input type="text" id="secteur" name="secteur" required><br><br>
        <input type="submit" value="Ajouter l'entreprise">
    </form>
</body>
</html>
