<?php


class Entreprise {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
        require_once '../models/Ville.php';
    }

    public function createEntreprise($NomE, $TelephoneE, $SiteWebE, $EmailE){
        $requete = $this->pdo->prepare("INSERT INTO Entreprises (NomE, TelephoneE, SiteWebE, EmailE) VALUES (?, ?, ?, ?)");
        return $requete->execute([$NomE, $TelephoneE, $SiteWebE, $EmailE]);
    }

    
    public function getAllNameEntreprises(){
        $requete = $this->pdo->prepare("SELECT NomE FROM Entreprises");
        return $requete->execute();
    }

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

    public function searchNameLocation($name, $location){
        $sql = "SELECT * FROM Entreprises WHERE 1=1 ";
        $params=[];

        if(!empty($name)){
            $sql .="AND NomE LIKE ?";
            $params[] = "%$name%";
        }
    
        if(!empty($location)){
            $villeModel = new Ville($this->pdo);
            $ville = $villeModel->getID_Villebynom("%$location%");
            $sql .="AND ID_Ville LIKE ?";
            $params[] = $ville;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        return $results;
    }

    public function getCompanyId($id){
        $sql = "SELECT * FROM Entreprises WHERE ID_Entreprise = ?";
        //$params = [];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetch();
        return $results;
    }
}

?>