<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes candidatures</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/candidatures.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>📨 Mes candidatures en cours</h1>
        <a href="index.php?action=recherche">🔙 Retour à la recherche</a>
        <br><br>
        <?php if (!empty($candidatures)): ?>
            <?php foreach ($candidatures as $c): ?>
                <div>
                    <h2><?= htmlspecialchars($c['TitreO']) ?> - H/F</h2>
                    <h3><?= htmlspecialchars($c['entreprise']) ?></h3>
                    <p>
                        <strong>Date de candidature :</strong> 
                        <?= date('d/m/Y à H\hi', strtotime($c['Date_Candidature'])) ?>
                    </p>
                    <p>
                        <strong>Statut :</strong> 
                        <?= htmlspecialchars($c['statut']) ?>
                    </p>
                    <p>
                        <strong>Lettre de motivation :</strong><br>
                        <?php if (!empty($c['Lettre_Motivation'])): ?>
                            <a href="uploads/<?= urlencode(basename($c['Lettre_Motivation'])) ?>" target="_blank">📄 Voir la lettre</a>
                        <?php else: ?>
                            <em>Non fournie</em>
                        <?php endif; ?>
                    </p>
                    <p><?= htmlspecialchars($c['DescOffre']) ?></p>
                    <p>
                        <strong>Période :</strong> 
                        <?= htmlspecialchars($c['DateDebut']) ?> → <?= htmlspecialchars($c['DateFin']) ?>
                    </p>
                    <p>
                        <strong>Rémunération :</strong> 
                        <?= htmlspecialchars($c['RemunerationO']) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Vous n'avez pas encore postulé à une offre.</p>
        <?php endif; ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
