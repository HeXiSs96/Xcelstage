<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="../entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <!-- Inclusion du header -->
    <?php include 'header.php'; ?>

    <main>
        <?php if (!empty($entreprise)): ?>
            <section class="entreprise-details">
                <h1><?= htmlspecialchars($entreprise['NomE']) ?></h1>

                <div class="details">
                    <p><strong>Email : </strong><?= htmlspecialchars($entreprise['EmailE']) ?></p>
                    <p><strong>Téléphone : </strong><?= htmlspecialchars($entreprise['TelephoneE']) ?></p>
                    <p><strong>Évaluation : </strong><?= htmlspecialchars($entreprise['Eval_E']) ?></p>
                    <p><strong>Secteur d'activité : </strong><?= htmlspecialchars($secteur) ?></p>
                    <p><strong>Ville : </strong><?= htmlspecialchars($ville) ?></p>

                    <p><strong>Site web : </strong>
                        <a href="<?= htmlspecialchars($entreprise['SiteWebE']) ?>" target="_blank">
                            <?= htmlspecialchars($entreprise['SiteWebE']) ?>
                        </a>
                    </p>
                </div>
            </section>
        <?php else: ?>
            <section class="no-results">
                <p>Aucune entreprise trouvée pour cette recherche.</p>
            </section>
        <?php endif; ?>
    </main>

    <!-- Inclusion du footer -->
    <?php include 'footer.php'; ?>

</body>
</html>
