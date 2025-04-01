<?php
require_once 'Utilisateur.php';

// Gestion de l'inscription d'un nouvel utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new Utilisateur();
    $success = $user->inscrire($_POST['nom'], $_POST['email'], $_POST['mot_de_passe'], $_POST['role']);

    // Redirige vers la page de connexion après une inscription réussie
    if ($success) {
        header("Location: connexion.php");
        exit();
    } else {
        // Affiche un message d'erreur si l'inscription échoue
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        
        <label>Email :</label>
        <input type="email" name="email" required>
        
        <label>Mot de passe :</label>
        <input type="password" name="mot_de_passe" required>
        
        <label>Rôle :</label>
        <select name="role">
            <option value="etudiant">Étudiant</option>
            <option value="pilote">Pilote</option>
            <option value="admin">Administrateur</option>
        </select>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
