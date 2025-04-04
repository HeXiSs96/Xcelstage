<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes offres en favoris</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/wishlist.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h1>❤️ Mes offres en favoris</h1>
    <a href="pageoffre.php?action=recherche" class="back-link">🔙 Retour à la recherche</a>
    <br><br>

    <div id="favoris-container">
        <?php if (!empty($offres)): ?>
            <?php foreach ($offres as $offre): ?>
                <div class="offre-card">
                    <h2><?= htmlspecialchars($offre['TitreO']) ?> - H/F</h2>
                    <h3><?= htmlspecialchars($offre['entreprise']) ?></h3>
                    <p>📍 <?= htmlspecialchars($offre['ville']) ?></p>
                    <p>📎 <strong>Compétences :</strong> <?= htmlspecialchars($offre['competences'] ?? '') ?></p>
                    <p><?= htmlspecialchars($offre['DescOffre']) ?></p>
                    <p>📅 <?= $offre['DateDebut'] ?> → <?= $offre['DateFin'] ?></p>
                    <p>💸 <?= $offre['RemunerationO'] ?></p>

                    <button type="button" class="wishlist-btn" data-id="<?= $offre['ID_Offre'] ?>">
                        ❌ Retirer des favoris
                    </button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune offre dans vos favoris pour l'instant.</p>
        <?php endif; ?>
    </div>
</main>

<script src="/Xcelstage/public/JS/wishlist.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>
