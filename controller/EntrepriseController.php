<?php
require_once __DIR__ . '/../model/EntrepriseModel.php';

$name = $_GET['name'] ?? '';
$location = $_GET['location'] ?? '';

$model = new Entreprise();
$results = $model->searchNameLocation($name,$location);

require __DIR__ . '/../view/EntrepriseView.php';
?>

