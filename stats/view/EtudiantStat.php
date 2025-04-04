<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/consult.css">
</head>
<body>
    <div class="container">
       <div class="profilex-card">
        <h2>Mes statistiques de candidatures</h2>
        <ul>
            <li><strong>Total de candidatures :</strong> <?= $candidatures_total ?></li>
            <li><strong>Candidatures en cours :</strong> <?= $candidatures_en_cours ?></li>
            <li><strong>Offres en wishlist :</strong> <?= $total_wishlist ?></li>
        </ul>
    </div>
<hr>

<h2>Historique de mes candidatures</h2>

<?php if (count($historique) > 0): ?>
    <div class="container">
        <?php foreach ($historique as $candidature): ?>
            <div class="profilex-card">
                <h3><?= htmlspecialchars($candidature['TitreO']) ?></h3>
                <div class="offer-info">
                    <p><strong>Entreprise :</strong> <?= htmlspecialchars($candidature['entreprise']) ?></p>
                    <p><strong>Date de candidature :</strong> <?= htmlspecialchars($candidature['date_candidature']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune candidature enregistrée.</p>
<?php endif; ?>
