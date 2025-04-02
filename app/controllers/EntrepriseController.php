<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/Entreprise.php';
require_once '/var/www/html/Xcelstage/config/database.php';

$name = $_GET['name'] ?? '';
$location = $_GET['location'] ?? '';

$model = new Entreprise($pdo);
$results = $model->searchNameLocation($name,$location);

require '../views/EntrepriseView.php';
?>

