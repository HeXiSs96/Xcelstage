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
    <link rel="stylesheet" href="style_offre.css">
</head>
<body>


    <div class="form">
        <a href="index_offre.php" class="back_btn"><img src="images/arrow.png"> Retour</a>
        <h2>Modifier l'Utilisateur : <?=$utilisateur['NomU']?> </h2>
        <p class="erreur_message">
           <?php 
              if(isset($message)){
                  echo $message ;
              }
           ?>
        </p>
        <form action="../controllers/editEntreprise.php?id=<?=$utilisateur['ID_Utilisateur']?>" method="POST">
        <label for="nom">Nom</label><br>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['NomU']) ?>" required><br><br>
        <label for="prenom">Prenom</label><br>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['PrenomU']) ?>" required><br><br>
        <label for="date_naissance">Date de naissance</label><br>
        <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($utilisateur['DateNaissance']) ?>" required><br><br>
        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password" value="<?= htmlspecialchars($utilisateur['MdpU']) ?>" required><br><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($utilisateur['EmailU']) ?>" required><br><br>
        <label for="role">Role:</label><br>
        <select name="role" id="role">
            <?php foreach ($roles as $role): ?>
                <option value="<?= htmlspecialchars($role['NomRole']) ?>"
                <?= (htmlspecialchars($role['NomRole']) == $roleU) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($role['NomRole']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Modifier l'entreprise">
        </form>
    </div>
</body>
</html>