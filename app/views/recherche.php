<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Souhaiter.php';
require_once '../models/Ville.php';
require_once '../models/Implanter.php';
global $pdo;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/recherche.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>Offres de Stage</h1>

    <form method="GET" action="../controllers/pageoffre.php" class="search-form">
        <input type="hidden" name="action" value="recherche">
        <input type="text" name="motcle" placeholder="🔍 Mot-clé ou entreprise" value="">
        <input type="text" name="ville" placeholder="📍 Ville" value="">
        <button type="submit">Rechercher</button>
    </form>

    <a href="pageoffre.php?action=wishlist" class="nav-link">❤️ Voir mes favoris</a>
    <a href="../controllers/pageoffre.php?action=candidatures" class="nav-link">📨 Voir mes candidatures</a>

    <br><br>

    <?php if (!empty($offres)): ?>
        <?php foreach ($offres as $offre): ?>
            <?php
            $villeModel = new Ville($pdo);
            $implanterModel = new Implanter($pdo);
            $souhaiterModel = new Souhaiter($pdo);
            $inWish = $souhaiterModel->getnbrsouhait($offre['ID_Offre']);
            ?>

            <div class="offre-card">
                <h2><?= htmlspecialchars($offre['TitreO']) ?> - H/F</h2>
                <h3><?= htmlspecialchars($offre['entreprise']) ?></h3>
                <p>📍 <?= htmlspecialchars($offre['ville'] ?? '') ?></p>
                <p><?= htmlspecialchars($offre['DescOffre']) ?></p>
                <p>📅 <?= $offre['DateDebut'] ?> → <?= $offre['DateFin'] ?></p>
                <p>💸 <?= $offre['RemunerationO'] ?></p>

                <form style="display:inline;">
                    <button type="button" class="wishlist-btn" data-id="<?= $offre['ID_Offre'] ?>">
                        <?= $inWish ? '❤️' : '🤍' ?>
                    </button>
                </form>

                <form method="GET" action="../controllers/pageoffre.php">
                    <input type="hidden" name="action" value="postuler">
                    <input type="hidden" name="id" value="<?= $offre['ID_Offre'] ?>">
                    <button class="btn-postuler">Postuler</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune offre trouvée pour cette recherche.</p>
    <?php endif; ?>
</main>

<script src="/Xcelstage/public/JS/recherche.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
