<?php
session_start();

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /xcelstage/public/");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de XcelStage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Gestion de XcelStage</h1>
    </header>
    
    <main>
        <p>Bienvenue dans l’espace d’administration de XcelStage. Sélectionnez une section à gérer.</p>
        
        <section>
            <h2>Gestion des Offres de Stage</h2>
            <a href="create_offre.php">➕ Ajouter une offre</a>
            <a href="offres.php">📋 Voir les offres</a>
            <a href="edit_offre.php">✏️ Modifier une offre</a>
            <a href="delete_offre.php">🗑️ Supprimer une offre</a>
        </section>
        
        <section>
            <h2>Gestion des Pilotes</h2>
            <a href="create_pilote.php">➕ Ajouter un pilote</a>
            <a href="pilotes.php">📋 Voir les pilotes</a>
            <a href="edit_pilote.php">✏️ Modifier un pilote</a>
            <a href="delete_pilote.php">🗑️ Supprimer un pilote</a>
        </section>
        
        <section>
            <h2>Gestion des Étudiants</h2>
            <a href="create_etudiant.php">➕ Ajouter un étudiant</a>
            <a href="etudiants.php">📋 Voir les étudiants</a>
            <a href="edit_etudiant.php">✏️ Modifier un étudiant</a>
            <a href="delete_etudiant.php">🗑️ Supprimer un étudiant</a>
        </section>
        
    </main>
</body>
</html>
