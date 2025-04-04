<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Role.php';
require_once '../models/Utilisateur.php';

if ($_SESSION['Role'] != 'Administrateur' && $_SESSION['Role'] != 'Pilote') {
    header("Location: /Xcelstage/public/");
    exit();
}

$utilisateurModel = new Utilisateur($pdo);
$roleModel = new Role($pdo);

// Pagination
$utilisateursParPage = 10;
$pageActuelle = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($pageActuelle - 1) * $utilisateursParPage;

$totalUtilisateurs = $pdo->query("SELECT COUNT(*) FROM Utilisateur")->fetchColumn();
$totalPages = ceil($totalUtilisateurs / $utilisateursParPage);

$utilisateurs = $pdo->prepare("SELECT * FROM Utilisateur LIMIT :limit OFFSET :offset");
$utilisateurs->bindValue(':limit', $utilisateursParPage, PDO::PARAM_INT);
$utilisateurs->bindValue(':offset', $offset, PDO::PARAM_INT);
$utilisateurs->execute();
$utilisateurs = $utilisateurs->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="container">
        <a href="create_ut.php" class="Btn_add"> <img src="/Xcelstage/public/image/plus.png"> Ajouter</a>
        
        <!-- Champ de recherche -->
        <input type="text" id="search" placeholder="Rechercher un utilisateur..." onkeyup="searchTable()">

        <table id="utilisateurTable">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur['NomU']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['PrenomU']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['DateNaissance']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['EmailU']) ?></td>
                    <td><?= htmlspecialchars($roleModel->getRolebyID($utilisateur['ID_Role'])) ?></td>
                    <td><a href="../views/consult_ut.php?id=<?= $utilisateur['ID_Utilisateur'] ?>"><button>Consulter</button></a></td>
                    <td><a href="../controllers/editUt.php?id=<?= $utilisateur['ID_Utilisateur'] ?>"><img src="/Xcelstage/public/image/pen.png"></a></td>
                    <td><a href="../controllers/deleteUt.php?id=<?= $utilisateur['ID_Utilisateur'] ?>" onclick="return confirm('Supprimer ?');"><img src="/Xcelstage/public/image/trash.png"></a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($pageActuelle > 1): ?>
                <a href="?page=<?= $pageActuelle - 1 ?>">Précédent</a>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= ($i === $pageActuelle) ? 'style="font-weight:bold;"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
            
            <?php if ($pageActuelle < $totalPages): ?>
                <a href="?page=<?= $pageActuelle + 1 ?>">Suivant</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function searchTable() {
            let input = document.getElementById("search").value.toLowerCase();
            let table = document.getElementById("utilisateurTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let rowText = rows[i].textContent.toLowerCase();
                rows[i].style.display = rowText.includes(input) ? "" : "none";
            }
        }
    </script>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
