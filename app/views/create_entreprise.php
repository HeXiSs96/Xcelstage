<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Ville.php';
require_once '../models/SecteurActivite.php';

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    //header("Location: /Xcelstage/public/");
    echo $_SESSION['Role'];
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
} else {
    $villeModel = new Ville($pdo);
    $secteurModel = new SecteurActivite($pdo);

    $villes = $villeModel->getAllVilles();
    $secteurs = $secteurModel->getAllSecteurAs();
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
        <select name="ville" id="ville">
        <option value="">Sélectionner une Ville</option>
        <?php foreach ($villes as $ville): ?>
            <option value="<?php echo $ville['NomV']; ?>"><?php echo htmlspecialchars($Ville['NomV']); ?></option>
        <?php endforeach; ?>
        </select>
        <label for="secteur">Secteur d'activité:</label><br>
        <input type="text" id="secteur" name="secteur" required><br><br>
        <input type="submit" value="Ajouter l'entreprise">
    </form>
</body>
</html>
