<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Offre.php';
require_once '../models/Entreprise.php';




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $TitreO = trim(htmlspecialchars($_POST['titre']));
    $DateDebut = trim(htmlspecialchars($_POST['date_debut']));
    $DateFin = trim(htmlspecialchars($_POST['date_fin']));
    $EtatOffre = trim(htmlspecialchars($_POST['etat']));
    $DescOffre = trim(htmlspecialchars($_POST['description']));
    $RemunerationO = trim(htmlspecialchars($_POST['remuneration']));
    $ID_Entreprise = trim(htmlspecialchars($_POST['nom_entreprise']));
    
    
    $offreModel = new Offre($pdo);


    
    try {
        $offreModel->createOffre($TitreO, $DateDebut, $DateFin, $EtatOffre, $DescOffre, $RemunerationO, $ID_Entreprise);
        header("Location: ../views/admin_dashboard.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Code SQL pour violation d'unicité
            echo "Erreur";
        } else {
            throw $e; // Ré-échoue l'exception pour d'autres erreurs
        }
    }
}
?>