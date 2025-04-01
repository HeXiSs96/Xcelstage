<?php

$entreprises = [
    ['id' => 1, 'nom' => 'TechCorp', 'secteur' => 'Informatique', 'ville' => 'Paris'],
    ['id' => 2, 'nom' => 'GreenEnergy', 'secteur' => 'Énergie', 'ville' => 'Lyon'],
    ['id' => 3, 'nom' => 'MediHealth', 'secteur' => 'Santé', 'ville' => 'Marseille']
];

$offres = [
    ['id' => 1, 'titre' => 'Développeur Web', 'entreprise_id' => 1, 'description' => 'Développement de sites web en PHP.', 'lieu' => 'Paris'],
    ['id' => 2, 'titre' => 'Ingénieur Énergie', 'entreprise_id' => 2, 'description' => 'Optimisation de consommation énergétique.', 'lieu' => 'Lyon'],
    ['id' => 3, 'titre' => 'Technicien Biotech', 'entreprise_id' => 3, 'description' => 'Recherche et développement en biotechnologie.', 'lieu' => 'Marseille']
];

$comptes = [
    ['id' => 1, 'nom' => 'Admin', 'email' => 'admin@example.com', 'role' => 'Administrateur'],
    ['id' => 2, 'nom' => 'Pilote', 'email' => 'pilote@example.com', 'role' => 'Pilote'],
    ['id' => 3, 'nom' => 'Étudiant', 'email' => 'etudiant@example.com', 'role' => 'Étudiant']
];

function afficherDonnees($tableau, $titre) {
    echo "<h2>$titre</h2><table border='1'><tr>";
    foreach (array_keys($tableau[0]) as $colonne) {
        echo "<th>$colonne</th>";
    }
    echo "</tr>";
    foreach ($tableau as $ligne) {
        echo "<tr>";
        foreach ($ligne as $valeur) {
            echo "<td>$valeur</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Données de Test</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <?php 
    afficherDonnees($entreprises, 'Entreprises');
    afficherDonnees($offres, 'Offres de Stage');
    afficherDonnees($comptes, 'Comptes Utilisateurs');
    ?>
</body>
</html>
