<?php

require_once __DIR__ . '/../models/Database.php';

class PostulationController {
    public function postuler() {
        $pdo = Database::connect();

        $idOffre = $_GET['id'] ?? null;
        if (!$idOffre) {
            echo "Aucune offre sélectionnée.";
            return;
        }

        $stmt = $pdo->prepare("
            SELECT o.TitreO, e.NomE
            FROM Offres o
            JOIN Entreprises e ON o.ID_Entreprise = e.ID_Entreprise
            WHERE o.ID_Offre = :id
        ");
        $stmt->execute([':id' => $idOffre]);
        $offre = $stmt->fetch();

        if (!$offre) {
            echo "Offre introuvable.";
            return;
        }

        require_once __DIR__ . '/../views/postuler.php';
    }
}
