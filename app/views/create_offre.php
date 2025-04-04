<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    //header("Location: /Xcelstage/public/");
    echo $_SESSION['Role'];
    exit();

} else {
    $entrepriseModel = new Entreprise($pdo);
    

    $entreprises = $entrepriseModel->getAllEntreprises();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une offre</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="form">
            <a href="index_offre.php" class="back_btn">
                <img src="/Xcelstage/public/image/arrow.png" alt="Retour"> 
            </a>

            <h2>Ajouter une offre</h2>

            <p class="erreur_message">
                <?php if (isset($message)) echo $message; ?>
            </p>

            <form action="../controllers/createOffre.php" method="POST">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" required>

                <label for="date_debut">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" required>

                <label for="date_fin">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" required>

                <label for="etat">État</label>
                <select name="etat" id="etat" required>
                    <option value="Ouvert">Ouvert</option>
                    <option value="Fermé">Fermé</option>
                </select>

                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>

                <label for="remuneration">Rémunération</label>
                <input type="number" name="remuneration" id="remuneration" step="0.01" required>

                <label for="nom_entreprise">Entreprise</label>
                <select name="nom_entreprise" id="nom_entreprise" required>
                    <option value="">Sélectionner une Entreprise</option>
                    <?php foreach ($entreprises as $entreprise): ?>
                        <option value="<?php echo $entreprise['ID_Entreprise']; ?>">
                            <?php echo htmlspecialchars($entreprise['NomE']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Ajouter" name="button">
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>

