<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/consult.css">
</head>
<body>
    <?php include '/Xcelstage/app/views/header.php'; ?>
    
    <main class="container">
        <div class="profile-card">
            <h2 id="user-name">Nom de l'entreprise</h2>
            <p><strong>Email :</strong> <span id="user-email">email@example.com</span></p>
            <p><strong>Téléphone :</strong> <span id="user-phone">+33 6 12 34 56 78</span></p>
            
            <!-- Informations supplémentaires sur l'entreprise -->
            <div class="company-info">
                <p><strong>Nom de l'entreprise :</strong> <span id="company-name">Nom de l'entreprise</span></p>
                <p><strong>Ville :</strong> <span id="company-city">Ville de l'entreprise</span></p>
                <p><strong>Secteur d'activité :</strong> <span id="company-sector">Secteur de l'entreprise</span></p>
                <p><strong>Adresse :</strong> <span id="company-address">Adresse de l'entreprise</span></p>
                <p><strong>Téléphone :</strong> <span id="company-phone">+33 1 23 45 67 89</span></p>
                <p><strong>Email :</strong> <span id="company-email">contact@entreprise.com</span></p>
                <p><strong>Site Web :</strong> <span id="company-website"><a href="http://www.entreprise.com" target="_blank">www.entreprise.com</a></span></p>
            </div>
        </div>
    </main>
    
    <?php include '/Xcelstage/app/views/footer.php'; ?>
</body>
</html>
