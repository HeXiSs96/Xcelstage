<?php

class Entreprise {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function createEntreprise($NomE, $TelephoneE, $SiteWebE, $EmailE){
        $requete = $this->pdo->prepare("INSERT INTO Entreprises (NomE, TelephoneE, SiteWebE, EmailE) VALUES (?, ?, ?, ?)");
        return $requete->execute([$NomE, $TelephoneE, $SiteWebE, $EmailE]);
    }

    // Méthode pour ajouter une entrée dans la table Utilisateur
    public function getAllEntreprises(){
        $requete = $this->pdo->prepare("SELECT NomE FROM Entreprises");
        return $requete->execute();
    }

    public function getID_Entreprisebyemail($EmailE) {
        $requete = $this->pdo->prepare("SELECT ID_Entreprise FROM Entreprises WHERE EmailE = ?");
        $requete->execute([$EmailE]);
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat ? $resultat['ID_Entreprise'] : null;
    }

    public function getEntreprisebynom($NomE) {
        $requete = $this->pdo->prepare("SELECT * FROM Entreprises WHERE LOWER(NomE) LIKE LOWER('%?%');");
        return $requete->execute($NomE);
    }

    public function getEntreprisebysecteur($Secteur) {
        $requete = $this->pdo->prepare("SELECT * FROM Entreprises WHERE LOWER(NomE) LIKE LOWER('%?%');");
        return $requete->execute($NomE);
    }
}

?>