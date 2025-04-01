<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '/var/www/html/xcelstage/config/database.php';
require_once '../models/Utilisateur.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $EmailU = trim(htmlspecialchars($_POST['EmailU']));
    $MdpU = trim(htmlspecialchars($_POST['MdpU']));

    // Créer une instance du modèle Utilisateur
    $utilisateurModel = new Utilisateur($pdo);

    // Récupérer l'utilisateur par email
    $utilisateur = $utilisateurModel->getUserByEmail($EmailU);

    if ($utilisateur && password_verify($MdpU, $utilisateur['MdpU'])) {
        // L'utilisateur est authentifié
        $_SESSION['ID_Utilisateur'] = $utilisateur['ID_Utilisateur'];
        $_SESSION['Role'] = $utilisateur['NomRole'];
        
        echo "réussi";

        // Redirection vers la page d'accueil
        header("Location: /xcelstage/public/");
        exit();
    } else {
        // Affichage d'un message d'erreur en cas de mauvaise connexion
        echo "Email ou mot de passe incorrect.";
    }
}

?>