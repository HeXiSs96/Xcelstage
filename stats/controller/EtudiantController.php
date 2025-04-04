<?php
require_once __DIR__ . '/../model/EtudiantModel.php'; // Adjust path if needed

class StatistiquesController {
    public function etudiantStats() {
        session_start();

        $_SESSION['user'] = [
            'id' => 1,
            'role' => 'admin'];

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'pilote')) {
            echo "Accès refusé.";
            exit;
        }

        $etudiant_id = $_GET['id'] ?? null; // just for testing with a student ID
        
        if(!$etudiant_id){
            echo "ID etudiant manquant.";
            exit;
        }

        
        $model = new Etudiant();

        $candidatures_total = $model->getCandidatureTotal($etudiant_id);
        $candidatures_en_cours = $model->getCandidatureEnCours($etudiant_id);
        $historique = $model->getHistorique($etudiant_id);
        
        $total_wishlist ??= 0;

        
        require_once __DIR__ . '/../view/EtudiantStat.php';
    }
}

