<?php

require_once 'Entreprise.php';
require_once 'Utilisateur.php';



class Evaluer {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"
    private $entrepriseModel;
    private $utilisateurModel;

    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->entrepriseModel = new Entreprise($pdo);
        $this->utilisateurModel = new Utilisateur($pdo);
    }

    public function createEval($EmailE, $EmailU, $Note){
        $ID_Entreprise = $this->entrepriseModel->getID_Entreprisebyemail($EmailE);
        $ID_Utilisateur = $this->utilisateurModel->getID_Utilisateurbyemail($EmailU);
        $requete = $this->pdo->prepare("INSERT INTO Evaluer (ID_Entreprise, ID_Utilisateur, Note) VALUES (?, ?, ?)");
        return $requete->execute([$ID_Entreprise, $ID_Utilisateur, $Note]);
    }

}

?>