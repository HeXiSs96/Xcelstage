<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Utilisateur.php';
require_once '../models/Role.php';

//var_dump($_SESSION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $EmailU = trim(htmlspecialchars($_POST['email']));
    $MdpU = trim(htmlspecialchars($_POST['password']));

    // Créer une instance du modèle Utilisateur
    $utilisateurModel = new Utilisateur($pdo);
    $roleModel = new Role($pdo);

    // Récupérer l'utilisateur par email
    $utilisateur = $utilisateurModel->getUserByEmail($EmailU);
    $role = $roleModel->getRolebyID($utilisateur['ID_Role']);

    if ($utilisateur && password_verify($MdpU, $utilisateur['MdpU'])) {
        // L'utilisateur est authentifié
        //echo $utilisateur['ID_Utilisateur'];
        $_SESSION['ID_Utilisateur'] = $utilisateur['ID_Utilisateur'];
        $_SESSION['Role'] = $role;
        
        //echo isset($_SESSION['user_id']);
        //var_dump($_SESSION);
        // Redirection vers la page d'accueil
        header("Location: /Xcelstage/public/");
        exit();
    } else {
        // Affichage d'un message d'erreur en cas de mauvaise connexion
        echo "Email ou mot de passe incorrect.";
    }
}

?>