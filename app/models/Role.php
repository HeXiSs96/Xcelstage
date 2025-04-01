<?php

class Role {
    private $pdo; //Cet attribut contient la référence vers notre base de données définie dans "/config/database.php"

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer les données de l'utilisateur à partir de son mail
    public function getRolebyID($ID_Role) {
        $stmt = $this->pdo->prepare("SELECT NomRole FROM Role WHERE ID_Role = ?");
        $stmt->execute([$ID_Role]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
