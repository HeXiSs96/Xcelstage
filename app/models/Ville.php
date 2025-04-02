<?php

class Ville {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter une entrée dans la table Utilisateur
    public function getAllVilles(){
        $requete = $this->pdo->prepare("SELECT NomV FROM Ville");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getID_Villebynom($NomV){
        $requete = $this->pdo->prepare("SELECT ID_Ville FROM Ville WHERE NomV = ?");
        $requete->execute([$NomV]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat ? $resultat['ID_Ville'] : null;
    }
}

?>