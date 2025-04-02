<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '../models/Entreprise.php';
require_once '../models/SecteurActivite.php';
require_once '../models/Ville.php';
require_once '../models/Appartenir.php';
require_once '../models/Implanter.php';
require_once '/var/www/html/Xcelstage/config/database.php';

$id = $_GET['id'] ?? null;

if ($id){
    $model = new Entreprise($pdo);
    $entreprise = $model->getCompanyId($id);
}
$appartenirModel = new Appartenir($pdo);
$appartenir = $appartenirModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
$secteurModel = new SecteurActivite($pdo);
$secteur = $secteurModel->getSecteurAbyID($appartenir);
$implanterModel = new Implanter($pdo);
$implanter = $implanterModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
$villeModel = new Ville($pdo);
$ville = $villeModel->getNomVillebyID($implanter);
require "../views/EntrepriseDetail_view.php";
?>


