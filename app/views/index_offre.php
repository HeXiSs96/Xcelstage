<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';
require_once '../models/Candidate.php';
require_once '../models/Offre.php';

if ($_SESSION['Role'] != 'Administrateur' && $_SESSION['Role'] != 'Pilote') {
    header("Location: /Xcelstage/public/");
    exit();
}

// Pagination
$offresParPage = 10;
$pageActuelle = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($pageActuelle - 1) * $offresParPage;

$totalOffres = $pdo->query("SELECT COUNT(*) FROM Offres")->fetchColumn();
$totalPages = ceil($totalOffres / $offresParPage);

$offres = $pdo->prepare("SELECT * FROM Offres LIMIT :limit OFFSET :offset");
$offres->bindValue(':limit', $offresParPage, PDO::PARAM_INT);
$offres->bindValue(':offset', $offset, PDO::PARAM_INT);
$offres->execute();
$offres = $offres->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les entreprises et postulants
$entrepriseModel = new Entreprise($pdo);
$candidateModel = new Candidate($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Offres</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <a href="create_offre.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>

            <!-- Champ de recherche -->
            <input type="text" id="search" placeholder="Rechercher une offre..." onkeyup="searchTable()">

            <label for="sort">Trier par :</label>
            <select id="sort" onchange="sortTable(this.value)">
                <option value="0">Titre</option>
                <option value="1">Date de début</option>
                <option value="2">Date de fin</option>
                <option value="3">État</option>
                <option value="5">Rémunération</option>
                <option value="6">Nombre de postulants</option>
            </select>

            <table id="offreTable">
                <tr>
                    <th>Titre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>État</th>
                    <th>Description</th>
                    <th>Rémunération</th>
                    <th>Nombre de postulants</th>
                    <th>Entreprise</th>
                    <th>Consulter</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php foreach ($offres as $offre): ?>
                    <tr>
                        <?php 
                        $NomE = $entrepriseModel->getNameEntreprisebyID($offre['ID_Entreprise']);
                        $nb_postulant = $candidateModel->getNombreCandidaturesbyOffre($offre['ID_Offre']);
                        ?>
                        <td><?= htmlspecialchars($offre['TitreO']) ?></td>
                        <td><?= htmlspecialchars($offre['DateDebut']) ?></td>
                        <td><?= htmlspecialchars($offre['DateFin']) ?></td>
                        <td><?= htmlspecialchars($offre['EtatOffre']) ?></td>
                        <td><?= htmlspecialchars($offre['DescOffre']) ?></td>
                        <td><?= htmlspecialchars($offre['RemunerationO']) ?> €</td>
                        <td><?= htmlspecialchars($nb_postulant) ?></td>
                        <td><?= htmlspecialchars($NomE) ?></td>
                        <td><a href="../controllers/consult_offre.php?id=<?= $offre['ID_Offre'] ?>"><button>Consulter</button></a></td>
                        <td><a href="create_offre.php?id=<?= $offre['ID_Offre'] ?>"><img src="/Xcelstage/public/image/pen.png"></a></td>
                        <td><a href="../controllers/deleteOffre.php?id=<?= $offre['ID_Offre'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?');"><img src="/Xcelstage/public/image/trash.png"></a></td>
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
                let table = document.getElementById("offreTable");
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
