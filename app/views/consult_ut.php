<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/consult.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="container">
            <div class="profile-card">
                <h2 id="user-name">Nom de l'utilisateur</h2>
                <p><strong>Email :</strong> <span id="user-email">email@example.com</span></p>
                <p><strong>Téléphone :</strong> <span id="user-phone">+33 6 12 34 56 78</span></p>
                <p><strong>Rôle :</strong> <span id="user-role">Étudiant</span></p>
                <p><strong>Entreprise :</strong> <span id="user-company">Aucune</span></p>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
