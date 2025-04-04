<?php
// Connexion à la base de données
include_once "connexion.php";

// Vérification que l'ID est bien passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID invalide");
}

$id = intval($_GET['id']);

// Préparation de la requête pour éviter les injections SQL
$stmt = mysqli_prepare($con, "SELECT * FROM Employe WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Employé introuvable");
}

// Vérifier que le bouton modifier a bien été cliqué
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    // Vérifier que tous les champs sont remplis
    if (!empty($nom) && !empty($prenom) && $age !== '') {
        // Requête préparée pour éviter les injections SQL
        $stmt = mysqli_prepare($con, "UPDATE Employe SET nom = ?, prenom = ?, age = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssii", $nom, $prenom, $age, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index_offre.php");
            exit();
        } else {
            $message = "Erreur lors de la mise à jour de l'employé.";
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'employé - <?= htmlspecialchars($row['nom']) ?></title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="form">
            <a href="../views/index_offre.php" class="back_btn">
                <img src="/Xcelstage/public/image/arrow.png" alt="Retour"> 
            </a>

            <h2>Modifier l'employé : <?= htmlspecialchars($row['nom']) ?></h2>

            <p class="erreur_message">
                <?php if (isset($message)) echo htmlspecialchars($message); ?>
            </p>

            <form action="" method="POST">
                <label>Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($row['nom']) ?>" required>

                <label>Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($row['prenom']) ?>" required>

                <label>Âge</label>
                <input type="number" name="age" value="<?= htmlspecialchars($row['age']) ?>" required min="18">

                <input type="submit" value="Modifier" name="button">
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
