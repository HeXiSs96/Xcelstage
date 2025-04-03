<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/OffreController.php';
require_once __DIR__ . '/WishlistController.php';
require_once __DIR__ . '/PostulationController.php';
require_once __DIR__ . '/CandidatureController.php';



$action = $_GET['action'] ?? 'recherche';

$controller = new OffreController($pdo);

switch ($action) {
    case 'recherche':
        $controller->recherche();
        break;
    

    case 'wishlist':
        require __DIR__ . '/WishlistController.php';
        break;

    case 'postuler':
        $controller = new PostulationController($pdo);
        $controller->postuler();
        break;
        
    
    
    case 'candidatures':
        $controller = new CandidatureController($pdo);
        $controller->index();
        break;
    

    default:
        echo "Page non trouvée.";
}
?>