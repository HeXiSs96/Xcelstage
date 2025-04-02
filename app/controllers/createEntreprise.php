<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';
require_once '../models/Implanter.php';
require_once '../models/Appartenir.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $NomE = trim(htmlspecialchars($_POST['nom_entreprise']));
    $TelephoneE = trim(htmlspecialchars($_POST['tel']));
    $SiteWebE = trim(htmlspecialchars($_POST['site']));
    $EmailE = trim(htmlspecialchars($_POST['email']));
    $NomV = trim(htmlspecialchars($_POST['ville']));
    $NomS = trim(htmlspecialchars($_POST['secteur']));

    
    $EntrepriseModel = new Entreprise($pdo);
    $ImplanterModel = new Implanter($pdo);
    $AppartenirModel = new Appartenir($pdo);


    
    try {
        if (filter_var($EmailE, FILTER_VALIDATE_EMAIL)) {
        $EntrepriseModel->createEntreprise($NomE, $TelephoneE, $SiteWebE, $EmailE);
        $ImplanterModel->createImplanter($EmailE, $NomV);
        $AppartenirModel->createAppartenir($EmailE, $NomS);

        header("Location: ../views/admin_dashboard.php");
        exit();
        } else {
            echo "Erreur : format de l'adresse email invalide";
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Code SQL pour violation d'unicité
            echo "Erreur : cet email est déjà utilisé.";
        } else {
            throw $e; // Ré-échoue l'exception pour d'autres erreurs
        }
    }
    


}

?>