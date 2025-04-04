<?php
class Entreprise{
    private $pdo;

    public function __construct(){
        $servername = "localhost";
        $username = "root";
        $password = "ishimwe";
        $dbname = "web_project";

        try{
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname",  $username, $password);
        } catch (PDOException $e){
            die("Erreur de connexion: " . $e->getMessage());
        }
    }

    public function searchNameLocation($name, $location){
        $sql = "SELECT * FROM entreprises WHERE 1=1 ";
        $params=[];

        if(!empty($name)){
            $sql .="AND NomE LIKE ?";
            $params[] = "%$name%";
        }
    
        if(!empty($location)){
            $sql .="AND AdresseE LIKE ?";
            $params[] = "%$location%";
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        return $results;
    }

    public function getCompanyId($id){
        $sql = "SELECT * FROM entreprises WHERE ID_Entreprise = ?";
        //$params = [];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetch();
        return $results;
    }
}
?>