<?php



class OffreController {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
        require_once '../models/Offre.php';
    }

    public function recherche() {
        $motcle = $_GET['motcle'] ?? '';
        $ville = $_GET['ville'] ?? '';
        $offreModel = new Offre($this->pdo);
        $offres = $offreModel->rechercher($motcle, $ville);

        // On passe aussi $motcle et $ville à la vue pour pré-remplir les champs
        require_once __DIR__ . '/../views/recherche.php';
    }

    public function postuler() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID de l'offre manquant.";
            return;
        }

        // Ici tu peux aussi aller chercher les infos de l'offre si tu veux l'afficher dynamiquement

        require_once __DIR__ . '/../views/postuler.php';
    }

    public function candidatures() {
        require_once __DIR__ . '/../views/candidatures.php';
    }
    

    public function wishlist() {
        
        require_once __DIR__ . '/../views/wishlist.php';
    }
    
}
