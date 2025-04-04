<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Utilisateur.php';
require_once '../models/Role.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID_Utilisateur = $_GET['id'] ?? null;
    // Récupérer les données du formulaire
    $NomU = trim(htmlspecialchars($_POST['nom']));
    $PrenomU = trim(htmlspecialchars($_POST['prenom']));
    $DateNaissance = trim(htmlspecialchars($_POST['date_naissance']));
    $MdpU = trim(htmlspecialchars($_POST['password']));
    $EmailU = trim(htmlspecialchars($_POST['email']));
    $Role = trim(htmlspecialchars($_POST['role']));

    

    
    $utilisateurModel = new Utilisateur($pdo);


    
    try {
        if (filter_var($EmailE, FILTER_VALIDATE_EMAIL)) {
        $utilisateurModel->modifierUtilisateur($ID_Utilisateur, $NomU, $PrenomU, $DateNaissance, $MdpU, $EmailU, $Role);

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
    


 } elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET['id'] ?? null;

    
    $utilisateurModel = new Utilisateur($pdo);
    $utilisateur = $utilisateurModel->getUserByID($id);
    
    $roleModel = new Role($pdo);
    $roles = $roleModel->getAllRoles();
    $roleU = $roleModel->getRoleByID($utilisateur["ID_Utilisateur"]);
    //var_dump($entreprise);

    require "../views/edit_ut.php";

}

?>