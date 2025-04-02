<?php
require_once __DIR__ . '/Database.php';

class Offre {
    public static function rechercher($motcle = '', $ville = '') {
        $pdo = Database::connect();
    
        $sql = "
            SELECT o.ID_Offre, o.TitreO, o.DescOffre, o.RemunerationO, o.DateDebut, o.DateFin,
                   o.Nb_postulantO, e.NomE AS entreprise,
    
                   -- On récupère une seule ville (la 1re)
                   (
                       SELECT v.NomV
                       FROM Implanter i
                       JOIN Ville v ON i.ID_Ville = v.ID_Ville
                       WHERE i.ID_Entreprise = e.ID_Entreprise
                       LIMIT 1
                   ) AS ville,
    
                   (
                       SELECT GROUP_CONCAT(DISTINCT c.NomCompetence SEPARATOR ', ')
                       FROM Demande d
                       JOIN Competence c ON d.ID_Competence = c.ID_Competence
                       WHERE d.ID_Offre = o.ID_Offre
                   ) AS competences
    
            FROM Offres o
            JOIN Entreprises e ON o.ID_Entreprise = e.ID_Entreprise
            WHERE 1=1
        ";
    
        $params = [];
    
        if (!empty($motcle)) {
            $sql .= " AND (o.TitreO LIKE :motcle OR e.NomE LIKE :motcle)";
            $params[':motcle'] = "%$motcle%";
        }
    
        if (!empty($ville)) {
            $sql .= " AND EXISTS (
                SELECT 1
                FROM Implanter i
                JOIN Ville v ON i.ID_Ville = v.ID_Ville
                WHERE i.ID_Entreprise = e.ID_Entreprise
                AND (v.NomV LIKE :ville OR v.CP LIKE :ville)
            )";
            $params[':ville'] = "%$ville%";
        }
    
        $sql .= " ORDER BY o.DateDebut DESC";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}    