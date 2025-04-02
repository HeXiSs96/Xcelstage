<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="../entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
        <nav class="navbar">
            <ul class="navbar">
                <li>
                    <a href="#">Accueil</a>
                </li>
                <li>
                    <a href="#">Offres</a>
                </li>
                <li class="active">
                    <a href="#">Entreprises</a>
                </li>
                <li>
                    <a href="contact.html">A propos de nous</a>
                </li>
                <li>
                    <a href="connexion.html">Connexion</a>
                </li>
            </ul>
        </nav>

        <ul class = "breadcrumb">
            <li><a href="#">Accueil</a></li>
            <li>Entreprise</li>
        </ul>
</header>

<main>
<?php if(!empty($entreprise) > 0): ?>

         
            <h1><?= htmlspecialchars($entreprise['NomE']) ?></h1>
              <p><strong>Adresse : </strong><?=htmlspecialchars($entreprise['AdresseE'])?></p>
              <p><strong>Email : </strong><?=htmlspecialchars($entreprise['EmailE'])?></p>
              <p><strong>Telephone : </strong><?=htmlspecialchars($entreprise['TelephoneE'])?></p>
              <p><strong>Evaluation : </strong><?=htmlspecialchars($entreprise['Eval_E'])?></p>
              <p><strong>Secteur d'activité : </strong><?=htmlspecialchars($entreprise['SecteurA'])?></p>
              <p><strong>Site web : </strong>
                  <a href="<?=htmlspecialchars($entreprise['SiteWebE'])?>" target ="_blank" >
                  <?=htmlspecialchars($entreprise['SiteWebE'])?>
                </a>
              </p>
        
<?php else: ?>
    <p>Aucune entreprise trouvée.</p>
<?php endif; ?>
</main>
</body>
</html>