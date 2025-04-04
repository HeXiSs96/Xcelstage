<?php
class Etudiant{
    private $pdo;

    public function __construct(){
        $servername = "localhost";
        $username = "root";
        $password = "ishimwe";
        $dbname = "web_project";

        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname",  $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die("Erreur de connexion: " . $e->getMessage());
        }
    }

    public function getCandidatureTotal($id){
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM candidate WHERE ID_Utilisateur = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function getCandidatureEnCours($id){
        $stmt = $this->pdo->prepare("
        SELECT COUNT(*) 
        FROM candidate c 
        JOIN EtatC e ON c.ID_Etatc = e.ID_EtatC
        WHERE c.ID_Utilisateur = ? AND e.Etat = 'en cours'
        ");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function getHistorique($id){
        $stmt = $this->pdo->prepare("
        SELECT o.TitreO, o.ID_Offre,e.NomE AS entreprise, c.date_candidature
            FROM candidate c
            JOIN offres o ON o.ID_Offre = c.ID_Offre
            JOIN entreprises e ON o.ID_Entreprise = e.ID_Entreprise
            WHERE c.ID_Utilisateur = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>