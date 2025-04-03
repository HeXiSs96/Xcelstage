<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'] ?? null;

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Utilisateur.php';
require_once '../models/Candidate.php';

$candidateModel = new Candidate($pdo);
$utilisateurModel = new Utilisateur($pdo);
$candidateModel->supprimerCandidatebyUt($id);
$utilisateurModel->supprimerUtilisateur($id);


header("Location: ../views/index_ut.php");
?>