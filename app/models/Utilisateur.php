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

    // Méthode pour récupérer les données de l'utilisateur à partir de son mail
    public function getUserByEmail($EmailU) {
        $stmt = $this->pdo->prepare("SELECT Utilisateur.ID_Utilisateur, Utilisateur.NomU, Utilisateur.EmailU, Utilisateur.MdpU, Role.NomRole 
    FROM Utilisateur
    INNER JOIN Role ON Utilisateur.ID_Role = Role.ID_Role
    WHERE Utilisateur.EmailU = ?");
        $stmt->execute([$EmailU]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   
}

?>