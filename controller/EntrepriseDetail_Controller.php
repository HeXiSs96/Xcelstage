<?php
require_once __DIR__ . '/../model/EntrepriseModel.php';

$id = $_GET['id'] ?? null;
$entreprise =null ;

if ($id){
    $model = new Entreprise();
    $entreprise = $model->getCompanyId($id);
}
?>


