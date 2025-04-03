<?php

class Souhaiter {

    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getnbrsouhait($ID_Offre){
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Souhaiter WHERE ID_Offre = ? AND ID_Utilisateur = ?");
        $stmt->execute([$ID_Offre, 1]);
        return $stmt->fetchColumn() > 0;
    }
}
?>