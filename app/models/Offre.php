<?php

class Offre {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter une entrée dans la table Offre
    public function createOffre($TitreO, $DateDebut, $DateFin, $EtatOffre, $DescOffre, $RemunerationO, $EmailE){
        $requete = $this->pdo->prepare("INSERT INTO Offres (TitreO, DateDebut, DateFin, EtatOffre, DescOffre, RemunerationO, ID_Entreprise) VALUES (?, ?, ?, ?, ?, ?, (Select ID_Entreprise FROM Entreprises WHERE EmailE=?))");
        return $requete->execute([$TitreO, $DateDebut, $DateFin, $EtatOffre, $DescOffre, $RemunerationO, $EmailE]);
    }

    // Méthode pour récupérer les données de l'utilisateur à partir de son mail
    public function getOffreBykeyword($mot_clé) {
        $stmt = $this->pdo->prepare("SELECT * FROM Offres WHERE LOWER(DescOffre) LIKE LOWER('%?%')?");
        $stmt->execute([$EmailU]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modifierOffre($TitreO, $DateDebut, $DateFin, $EtatOffre, $DescOffre, $RemunerationO, $EmailE){
        $hashedPassword = password_hash($MdpU, PASSWORD_DEFAULT);
        $requete = $this->pdo->prepare("UPDATE Offres SET TitreO, DateDebut, DateFin, EtatOffre, DescOffre, RemunerationO, ID_Entreprise");
        return $requete->execute([$TitreO, $DateDebut, $DateFin, $EtatOffre, $DescOffre, $RemunerationO, $EmailE]);
    }

    public function supprimerUtilisateur($ID_Utilisateur){
        $requete = $this->pdo->prepare("DELETE FROM Utilisateur WHERE ID_Utilisateur = ?");
        return $requete->execute([$ID_Utilisateur]);
    }
}

?>