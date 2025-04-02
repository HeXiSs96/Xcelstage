<?php

require_once __DIR__ . '/../models/Offre.php';
require_once __DIR__ . '/../models/Database.php';

class OffreController {

    public function recherche() {
        $motcle = $_GET['motcle'] ?? '';
        $ville = $_GET['ville'] ?? '';
        $pdo = Database::connect(); // 👈 ajoute cette ligne
        $offres = Offre::rechercher($motcle, $ville);

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
        $pdo = Database::connect(); // 💾 on récupère PDO
        $GLOBALS['pdo'] = $pdo;     // 📦 on le passe à la vue
    
        require_once __DIR__ . '/../views/wishlist.php';
    }
    
}
