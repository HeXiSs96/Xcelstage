<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Inclusion du header -->
    <?php include 'header.php'; ?>

    <main>
        
        
        <!-- Formulaire de recherche -->
            <div class="page content">
                <form action="../controllers/EntrepriseController.php" method="get">
                    <div class="searchbar">
                        <div class="search-input">
                            <i class="fas fa-bars"></i>
                            <input type="text" name="name" placeholder="Mots clés ou entreprise">
                            <i class="fas fa-search"></i>
                        </div>

                        <div class="search-input">
                            <i class="fas fa-bars"></i>
                            <input type="text" name="location" placeholder="Ou ?">
                            <i class="fas fa-search"></i>
                        </div>
                        <button type="submit">Rechercher</button>
                    </div>
                </form>
            </div>

        <?php
        if (!empty($results)): ?>
            <div class="grid">
                <?php foreach ($results as $entreprise): ?>
                    <a href="../controllers/EntrepriseDetail_Controller.php?id=<?= htmlspecialchars($entreprise['ID_Entreprise']) ?>" class="company-card">
                        <div class="logo-circle">
                            <img src="/Xcelstage/public/image/entreprise.png"?>>
                        </div>
                        <p class="company-name"><?= htmlspecialchars($entreprise['NomE']) ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucune entreprise trouvée.</p>
        <?php endif; ?>
    </main>

    

    <!-- Inclusion du footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
