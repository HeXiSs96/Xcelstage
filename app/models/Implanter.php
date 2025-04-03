<?php

require_once 'Entreprise.php';
require_once 'Ville.php';



class Implanter {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"
    private $entrepriseModel;
    private $villeModel;

    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->entrepriseModel = new Entreprise($pdo);
        $this->villeModel = new Ville($pdo);
    }

    public function createImplanter($EmailE, $NomV){
        $ID_Entreprise = $this->entrepriseModel->getID_Entreprisebyemail($EmailE);
        $ID_Ville = $this->villeModel->getID_Villebynom($NomV);
        $requete = $this->pdo->prepare("INSERT INTO Implanter (ID_Entreprise, ID_Ville) VALUES (?, ?)");
        return $requete->execute([$ID_Entreprise, $ID_Ville]);
    }

    public function supprimerImplanter($ID_Entreprise){
        $requete = $this->pdo->prepare("DELETE FROM Implanter WHERE ID_Entreprise = ?");
        return $requete->execute([$ID_Entreprise]);
    }

    public function modifierImplanter($ID_Entreprise, $NomV){
        $ID_Ville = $this->villeModel->getID_Villebynom($NomV);
        $requete = $this->pdo->prepare("UPDATE Implanter SET ID_Ville = ? WHERE ID_Entreprise = ?");
        return $requete->execute([$ID_Ville, $ID_Entreprise]);
    }

    public function getbyID_Entreprise($ID_Entreprise){
        $requete = $this->pdo->prepare("SELECT ID_Ville FROM Implanter WHERE ID_Entreprise = ?");
        $requete->execute([$ID_Entreprise]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat ? $resultat['ID_Ville'] : null;
    }


}

?>