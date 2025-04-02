<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'] ?? null;

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';
require_once '../models/Implanter.php';
require_once '../models/Appartenir.php';

$entrepriseModel = new Entreprise($pdo);
$implanterModel = new Implanter($pdo);
$appartenirModel = new Appartenir($pdo);
$implanterModel->supprimerImplanter($id);
$appartenirModel->supprimerAppartenir($id);
$entrepriseModel->supprimerEntreprise($id);

header("Location: ../views/index_entreprise.php");
?>