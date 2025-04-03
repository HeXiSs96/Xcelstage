<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Postuler à une offre</title>
</head>
<body>

<h2>Postuler à l'offre : <?= htmlspecialchars($offre['TitreO']) ?> chez <?= htmlspecialchars($offre['NomE']) ?></h2>

<form method="POST" action="../handlers/valider_postulation.php" enctype="multipart/form-data">

    <input type="hidden" name="id_offre" value="<?= $idOffre ?>">

    <label for="lettre_motivation">Lettre de motivation (PDF uniquement) :</label>
    <input type="file" name="lettre_motivation" id="lettre_motivation" accept=".pdf" required><br><br>
    <textarea name="motivation" id="motivation" rows="8" cols="50" required></textarea><br><br>

    <label for="cv">Votre CV (PDF uniquement) :</label>
    <input type="file" name="cv" id="cv" accept=".pdf" required><br><br>

    <button type="submit">Envoyer la candidature</button>
</form>

</body>
</html>
