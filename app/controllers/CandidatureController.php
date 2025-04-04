<?php


class CandidatureController {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
        require_once '../models/Offre.php';
    }

    public function index() {
        
        $idUser = 1;

        $stmt = $this->pdo->prepare("
            SELECT o.TitreO, o.DescOffre, o.RemunerationO, o.DateDebut, o.DateFin,
                   e.NomE AS entreprise,
                   c.Date_Candidature, c.Lettre_Motivation,
                   et.Etat AS statut
            FROM Candidate c
            JOIN Offres o ON c.ID_Offre = o.ID_Offre
            JOIN Entreprises e ON o.ID_Entreprise = e.ID_Entreprise
            JOIN EtatC et ON c.ID_EtatC = et.ID_EtatC
            WHERE c.ID_Utilisateur = :user
        ");
        $stmt->execute([':user' => $idUser]);
        $candidatures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/candidatures.php';
    }
}
