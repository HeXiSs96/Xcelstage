<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'] ?? null;

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Candidate.php';
require_once '../models/Offre.php';

$candidateModel = new Candidate($pdo);
$offreModel = new Offre($pdo);
$candidateModel->supprimerCandidate($id);
$offreModel->supprimerOffre($id);


header("Location: ../views/index_offre.php");
?>