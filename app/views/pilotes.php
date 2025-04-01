<?php
// Connexion à la base de données
include 'db_connection.php';

echo "<!DOCTYPE html>";
echo "<html lang='fr'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Liste des pilotes</title>";
echo "<link rel='stylesheet' href='styles.css'>"; // Lien vers ton fichier CSS
echo "</head>";
echo "<body>";

// Récupérer les pilotes existants
$sql = "SELECT * FROM pilotes";
$result = mysqli_query($conn, $sql);

echo "<h2>Liste des pilotes</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Nom</th><th>Actions</th></tr>";

while ($pilote = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $pilote['id'] . "</td><td>" . $pilote['nom'] . "</td>";
    echo "<td><a href='edit_pilote.php?id=" . $pilote['id'] . "'>Modifier</a> | <a href='delete_pilote.php?id=" . $pilote['id'] . "'>Supprimer</a></td></tr>";
}

echo "</table>";

echo "</body>";
echo "</html>";
?>
