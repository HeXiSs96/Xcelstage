<?php


class Candidate {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
        require_once '../models/Ville.php';
    }

    public function supprimerCandidate($ID_Offre){
        $requete = $this->pdo->prepare("DELETE FROM Candidate WHERE ID_Offre = ?");
        return $requete->execute([$ID_Offre]);
    }

    public function supprimerCandidatebyUt($ID_Utilisateur){
        $requete = $this->pdo->prepare("DELETE FROM Candidate WHERE ID_Utilisateur = ?");
        return $requete->execute([$ID_Utilisateur]);
    }

    public function getNombreCandidaturesbyOffre($ID_Offre) {
        $requete = $this->pdo->prepare("SELECT COUNT(*) as total FROM Candidatures WHERE ID_Offre = ?");
        $requete->execute([$ID_Offre]);
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['total'] : 0;
    }

}

?>