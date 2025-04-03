<?php

class Utilisateur {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter une entrée dans la table Utilisateur
    public function createUtilisateur($NomU, $PrenomU, $DateNaissance, $MdpU, $EmailU, $Role){
        $hashedPassword = password_hash($MdpU, PASSWORD_DEFAULT);
        $requete = $this->pdo->prepare("INSERT INTO Utilisateur (NomU, PrenomU, DateNaissance, MdpU, EmailU, ID_Role) VALUES (?, ?, ?, ?, ?, (Select ID_Role FROM Role WHERE NomRole=?))");
        return $requete->execute([$NomU, $PrenomU, $DateNaissance, $hashedPassword, $EmailU, $Role]);
    }

    public function getAllUtilisateurs(){
        $requete = $this->pdo->prepare("SELECT * FROM Utilisateur");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les données de l'utilisateur à partir de son mail
    public function getUserByEmail($EmailU) {
        $stmt = $this->pdo->prepare("SELECT * FROM Utilisateur WHERE EmailU = ?");
        $stmt->execute([$EmailU]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByNom($NomU) {
        $stmt = $this->pdo->prepare("SELECT * FROM Utilisateur WHERE NomU = ?");
        $stmt->execute([$EmailU]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modifierUtilisateur($ID_Utilisateur, $NomU, $PrenomU, $DateNaissance, $MdpU, $EmailU, $Role){
        $hashedPassword = password_hash($MdpU, PASSWORD_DEFAULT);
        $requete = $this->pdo->prepare("UPDATE Utilisateur SET NomU = ?, PrenomU = ?, DateNaissance = ?, MdpU = ?, EmailU = ?, ID_Role = (Select ID_Role FROM Role WHERE NomRole=?) WHERE ID_Utilisateur = ?");
        return $requete->execute([$NomU, $PrenomU, $DateNaissance, $hashedPassword, $EmailU, $Role, $ID_Utilisateur]);
    }

    public function supprimerUtilisateur($ID_Utilisateur){
        $requete = $this->pdo->prepare("DELETE FROM Utilisateur WHERE ID_Utilisateur = ?");
        return $requete->execute([$ID_Utilisateur]);
    }
}

?>