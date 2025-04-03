<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Postuler à une offre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Xcelstage/public/CSS/postuler.css">
</head>
<body>

    <!-- Inclusion du header -->
    <?php include '/Xcelstage/app/views/header.php'; ?>

    <!-- Contenu principal -->
    <main>
        <div class="form-container">
            <h2>Postuler à l'offre : <?= htmlspecialchars($offre['TitreO']) ?> chez <?= htmlspecialchars($offre['NomE']) ?></h2>

            <form method="POST" action="../handlers/valider_postulation.php" enctype="multipart/form-data">
                <input type="hidden" name="id_offre" value="<?= $idOffre ?>">

                <label for="lettre_motivation">Lettre de motivation (PDF uniquement) :</label>
                <input type="file" name="lettre_motivation" id="lettre_motivation" accept=".pdf" required>

                <label for="motivation">Motivation :</label>
                <textarea name="motivation" id="motivation" rows="8" required></textarea>

                <label for="cv">Votre CV (PDF uniquement) :</label>
                <input type="file" name="cv" id="cv" accept=".pdf" required>

                <button type="submit">Envoyer la candidature</button>
            </form>
        </div>
    </main>

    <!-- Inclusion du footer -->
    <?php include '/Xcelstage/app/views/footer.php'; ?>

</body>
</html>
