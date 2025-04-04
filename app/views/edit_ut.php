<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Utilisateur - <?= htmlspecialchars($utilisateur['NomU']) ?></title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="form">
            <a href="../views/index_ut.php" class="back_btn">
                <img src="/Xcelstage/public/image/arrow.png" alt="Retour"> 
            </a>

            <h2>Modifier l'Utilisateur : <?= htmlspecialchars($utilisateur['NomU']) ?></h2>

            <p class="erreur_message">
                <?php if (isset($message)) echo htmlspecialchars($message); ?>
            </p>

            <form action="" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['NomU']) ?>" required>

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['PrenomU']) ?>" required>

                <label for="date_naissance">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($utilisateur['DateNaissance']) ?>" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" value="<?= htmlspecialchars($utilisateur['MdpU']) ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['EmailU']) ?>" required>

                <label for="role">Rôle</label>
                <select name="role" id="role">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role['NomRole']) ?>"
                        <?= (htmlspecialchars($role['NomRole']) == $utilisateur['RoleU']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($role['NomRole']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Modifier l'utilisateur">
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>