<?php

require_once 'Entreprise.php';
require_once 'SecteurActivite.php';



class Appartenir {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"
    private $entrepriseModel;
    private $SecteurAModel;

    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->entrepriseModel = new Entreprise($pdo);
        $this->SecteurAModel = new SecteurActivite($pdo);
    }

    public function createAppartenir($EmailE, $NomS){
        $ID_Entreprise = $this->entrepriseModel->getID_Entreprisebyemail($EmailE);
        $ID_SecteurA = $this->SecteurAModel->getID_SecteurAbynom($NomS);
        $requete = $this->pdo->prepare("INSERT INTO Appartenir (ID_Entreprise, ID_SecteurA) VALUES (?, ?)");
        return $requete->execute([$ID_Entreprise, $ID_SecteurA]);
    }

    public function getbyID_Entreprise($ID_Entreprise){
        $requete = $this->pdo->prepare("SELECT ID_SecteurA FROM Appartenir WHERE ID_Entreprise = ?");
        $requete->execute([$ID_Entreprise]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat ? $resultat['ID_SecteurA'] : null;
    }

}

?>