<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/SecteurActivite.php';
require_once '../models/Ville.php';
require_once '../models/Appartenir.php';
require_once '../models/Implanter.php';
require_once '/var/www/html/Xcelstage/config/database.php';

$appartenirModel = new Appartenir($pdo);
$appartenir = $appartenirModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
$secteurModel = new SecteurActivite($pdo);
$secteur = $secteurModel->getSecteurAbyID($appartenir);
$implanterModel = new Implanter($pdo);
$implanter = $implanterModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
$villeModel = new Ville($pdo);
$ville = $villeModel->getNomVillebyID($implanter);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="../entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>


<main>
<?php if(!empty($entreprise)): ?>

         
            <h1><?= htmlspecialchars($entreprise['NomE']) ?></h1>
              <p><strong>Email : </strong><?=htmlspecialchars($entreprise['EmailE'])?></p>
              <p><strong>Telephone : </strong><?=htmlspecialchars($entreprise['TelephoneE'])?></p>
              <p><strong>Evaluation : </strong><?=htmlspecialchars($entreprise['Eval_E'])?></p>
              <p><strong>Secteur d'activité : </strong><?=htmlspecialchars($secteur)?></p>
              <p><strong>Ville : </strong><?=htmlspecialchars($ville)?></p>
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