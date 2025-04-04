<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = new PDO('mysql:host=localhost;dbname=site_stage;charset=utf8', 'root', 'iyas');

$idUser = 1;
$idOffre = $_POST['id_offre'] ?? null;
$action = $_POST['action'] ?? null;

if ($idOffre && $action) {
    if ($action === 'add') {
        $stmt = $pdo->prepare("INSERT IGNORE INTO Souhaiter (ID_Offre, ID_Utilisateur) VALUES (:offre, :user)");
        $stmt->execute([':offre' => $idOffre, ':user' => $idUser]);
        echo "added";
    } elseif ($action === 'remove') {
        $stmt = $pdo->prepare("DELETE FROM Souhaiter WHERE ID_Offre = :offre AND ID_Utilisateur = :user");
        $stmt->execute([':offre' => $idOffre, ':user' => $idUser]);
        echo "removed";
    }
}
