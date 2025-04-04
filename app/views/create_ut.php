<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="form">
            <a href="index_ut.php" class="back_btn">
                <img src="/Xcelstage/public/image/arrow.png" alt="Retour"> 
            </a>

            <h2>Ajouter un utilisateur</h2>

            <p class="erreur_message">
                <?php if (isset($message)) echo htmlspecialchars($message); ?>
            </p>

            <form action="../controllers/createUtilisateur.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>

                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>

                <label for="date_naissance">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" required>

                <label for="role">Rôle</label>
                <select name="role" id="role" required>
                    <option value="Pilote">Pilote</option>
                    <option value="Étudiant">Étudiant</option>
                </select>

                <input type="submit" value="Ajouter" name="button">
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
