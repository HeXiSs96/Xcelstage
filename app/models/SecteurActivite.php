<?php

class SecteurActivite {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter une entrée dans la table Utilisateur
    public function getAllSecteurAs(){
        $requete = $this->pdo->prepare("SELECT NomS FROM SecteurA");
        return $requete->execute();
    }

    public function getID_SecteurAbynom($NomS){
        $requete = $this->pdo->prepare("SELECT ID_SecteurA FROM SecteurActivite WHERE NomS = ?");
        $requete->execute([$NomS]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat ? $resultat['ID_SecteurA'] : null;
    }
}

?>