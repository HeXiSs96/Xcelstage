<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Entreprise - <?= htmlspecialchars($entreprise['NomE']) ?></title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>

    <?php include 'header.php'; ?>

    <main>
        <div class="form">
            <a href="../views/index_entreprise.php" class="back_btn">
                <img src="/Xcelstage/public/image/arrow.png" alt="Retour">
            </a>

            <h2>Modifier l'Entreprise : <?= htmlspecialchars($entreprise['NomE']) ?> </h2>

            <p class="erreur_message">
                <?php if (isset($message)) echo htmlspecialchars($message); ?>
            </p>

            <form action="../controllers/editEntreprise.php?id=<?= htmlspecialchars($entreprise['ID_Entreprise']) ?>" method="POST">
                <label for="nom_entreprise">Nom de l'entreprise :</label>
                <input type="text" id="nom_entreprise" name="nom_entreprise" value="<?= htmlspecialchars($entreprise['NomE']) ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($entreprise['EmailE']) ?>" required>

                <label for="tel">Téléphone :</label>
                <input type="tel" id="tel" name="tel" value="<?= htmlspecialchars($entreprise['TelephoneE']) ?>" required>

                <label for="site">Site web :</label>
                <input type="url" id="site" name="site" value="<?= htmlspecialchars($entreprise['SiteWebE']) ?>" required>

                <label for="ville">Ville :</label>
                <select name="ville" id="ville">
    <?php foreach ($villes as $ville): ?>
        <option value="<?= htmlspecialchars($ville['NomV']); ?>" 
            <?= ($villeE !== null && htmlspecialchars($ville['NomV']) == htmlspecialchars($villeE)) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($ville['NomV']); ?>
        </option>
    <?php endforeach; ?>
</select>


                <label for="secteur">Secteur d'activité :</label>
                <select name="secteur" id="secteur">
    <?php foreach ($secteurs as $secteur): ?>
        <option value="<?= htmlspecialchars($secteur['NomS']) ?>"
            <?= ($secteurE !== null && htmlspecialchars($secteur['NomS']) == htmlspecialchars($secteurE)) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($secteur['NomS']); ?>
        </option>
    <?php endforeach; ?>
</select>


                <input type="submit" value="Modifier l'entreprise">
            </form>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
