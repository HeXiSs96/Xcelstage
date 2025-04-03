<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
</head>
<body>


    <div class="form">
        <a href="index_offre.php" class="back_btn"><img src="images/arrow.png"> Retour</a>
        <h2>Modifier l'Entreprise : <?=$entreprise['NomE']?> </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>
        <form action="../controllers/editEntreprise.php?id=<?=$entreprise['ID_Entreprise']?>" method="POST">
        <label for="nom_entreprise">Nom de l'entreprise:</label><br>
        <input type="text" id="nom_entreprise" name="nom_entreprise" value="<?= htmlspecialchars($entreprise['NomE']) ?>" required><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($entreprise['EmailE']) ?>" required><br><br>
        <label for="tel">Telephone:</label><br>
        <input type="text" id="tel" name="tel" value="<?= htmlspecialchars($entreprise['TelephoneE']) ?>" required><br><br>
        <label for="site">Site web:</label><br>
        <input type="text" id="site" name="site" value="<?= htmlspecialchars($entreprise['SiteWebE']) ?>" required><br><br>
        <label for="ville">Ville:</label><br>
        <select name="ville" id="ville">
            <?php foreach ($villes as $ville): ?>
                <option value="<?= htmlspecialchars($ville['NomV']); ?>" 
                    <?= (htmlspecialchars($ville['NomV']) == $villeE) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($ville['NomV']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="secteur">Secteur d'activité:</label><br>
        <select name="secteur" id="secteur">
            <?php foreach ($secteurs as $secteur): ?>
                <option value="<?= htmlspecialchars($secteur['NomS']) ?>"
                    <?= (htmlspecialchars($secteur['NomS']) == $secteurE) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($secteur['NomS']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Modifier l'entreprise">
        </form>
    </div>
</body>
</html>