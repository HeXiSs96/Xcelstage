<?php
require_once __DIR__ . '/../models/Database.php';

class WishlistController {
    public function index() {
        $pdo = Database::connect();
        $idUser = 1; // À remplacer par $_SESSION['id'] plus tard

        $stmt = $pdo->prepare("
            SELECT o.ID_Offre, o.TitreO, o.DescOffre, o.RemunerationO, o.DateDebut, o.DateFin,
                   e.NomE AS entreprise,
                   (
                       SELECT v.NomV
                       FROM Implanter i
                       JOIN Ville v ON i.ID_Ville = v.ID_Ville
                       WHERE i.ID_Entreprise = e.ID_Entreprise
                       LIMIT 1
                   ) AS ville,
                   (
                       SELECT GROUP_CONCAT(DISTINCT c.NomCompetence SEPARATOR ', ')
                       FROM Demande d
                       JOIN Competence c ON d.ID_Competence = c.ID_Competence
                       WHERE d.ID_Offre = o.ID_Offre
                   ) AS competences
            FROM Offres o
            JOIN Entreprises e ON o.ID_Entreprise = e.ID_Entreprise
            JOIN Souhaiter s ON o.ID_Offre = s.ID_Offre
            WHERE s.ID_Utilisateur = :user
            ORDER BY o.DateDebut DESC
        ");
        $stmt->execute([':user' => $idUser]);
        $offres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/wishlist.php';
    }
}
