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

} else {
    $villeModel = new Ville($pdo);
    $secteurModel = new SecteurActivite($pdo);

    $villes = $villeModel->getAllVilles();
    $secteurs = $secteurModel->getAllSecteurAs();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une entreprise</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
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
            <option value="<?php echo $ville['NomV']; ?>"><?php echo htmlspecialchars($ville['NomV']); ?></option>
        <?php endforeach; ?>
        </select>
        <label for="secteur">Secteur d'activité:</label><br>
        <select name="secteur" id="secteur">
        <option value="">Sélectionner un secteur d'activité</option>
        <?php foreach ($secteurs as $secteur): ?>
            <option value="<?php echo $secteur['NomS']; ?>"><?php echo htmlspecialchars($secteur['NomS']); ?></option>
        <?php endforeach; ?>
        </select>
        <input type="submit" value="Ajouter l'entreprise">
    </form>
</body>
</html>