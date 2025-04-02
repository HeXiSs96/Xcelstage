<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '../models/Entreprise.php';
require_once '/var/www/html/Xcelstage/config/database.php';

$id = $_GET['id'] ?? null;

if ($id){
    $model = new Entreprise($pdo);
    $entreprise = $model->getCompanyId($id);
}

require "../views/EntrepriseDetail_view.php";
?>


