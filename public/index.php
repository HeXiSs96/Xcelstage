<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../controllers/OffreController.php';
require_once __DIR__ . '/../controllers/WishlistController.php';
require_once __DIR__ . '/../controllers/PostulationController.php';
require_once __DIR__ . '/../controllers/CandidatureController.php';



$action = $_GET['action'] ?? 'recherche';

$controller = new OffreController();

switch ($action) {
    case 'recherche':
        $controller->recherche();
        break;
    

    case 'wishlist':
        $controller = new WishlistController();
        $controller->index();
         break;

    case 'postuler':
        $controller = new PostulationController();
        $controller->postuler();
        break;
        
    
    
    case 'candidatures':
        $controller = new CandidatureController();
        $controller->index();
        break;
    

    default:
        echo "Page non trouvée.";
}
