<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';
require_once '../models/SecteurActivite.php';
require_once '../models/Ville.php';
require_once '../models/Appartenir.php';
require_once '../models/Implanter.php';

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /Xcelstage/public/");
    exit();
} else {
    $entrepriseModel = new Entreprise($pdo);
    $appartenirModel = new Appartenir($pdo);
    $secteurModel = new SecteurActivite($pdo);
    $implanterModel = new Implanter($pdo);
    $villeModel = new Ville($pdo);

    // Pagination
    $entreprisesParPage = 10;
    $pageActuelle = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($pageActuelle - 1) * $entreprisesParPage;

    // Total d'entreprises
    $totalEntreprises = $pdo->query("SELECT COUNT(*) FROM Entreprises")->fetchColumn();
    $totalPages = ceil($totalEntreprises / $entreprisesParPage);

    // Récupérer les entreprises
    $entreprises = $pdo->prepare("SELECT * FROM Entreprises LIMIT :limit OFFSET :offset");
    $entreprises->bindValue(':limit', $entreprisesParPage, PDO::PARAM_INT);
    $entreprises->bindValue(':offset', $offset, PDO::PARAM_INT);
    $entreprises->execute();
    $entreprises = $entreprises->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Entreprises</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
    <script src="script_entreprise.js" defer></script>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="container">
        <a href="create_entreprise.php" class="Btn_add"> <img src="/Xcelstage/public/image/plus.png"> Ajouter</a>

        <input type="text" id="search" placeholder="Rechercher une entreprise..." onkeyup="searchTable()">

        <label for="sort">Trier par :</label>
        <select id="sort" onchange="sortTable(this.value)">
            <option value="0">Nom</option>
            <option value="1">Secteur</option>
            <option value="2">Adresse</option>
            <option value="3">Téléphone</option>
            <option value="4">Email</option>
        </select>

        <table id="entrepriseTable">
            <tr id="items">
                <th>Nom</th>
                <th>Secteur</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Site Web</th>
                <th>Ville</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach ($entreprises as $entreprise): ?>
            <tr>
                <?php
                $appartenir = $appartenirModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
                $secteur = $secteurModel->getSecteurAbyID($appartenir);
                $implanter = $implanterModel->getbyID_Entreprise($entreprise['ID_Entreprise']);
                $ville = $villeModel->getNomVillebyID($implanter);
                ?>
                <td><?=$entreprise['NomE']?></td>
                <td><?=$secteur?></td>
                <td><?=$entreprise['TelephoneE']?></td>
                <td><?=$entreprise['EmailE']?></td>
                <td><a href="<?=$entreprise['SiteWebE']?>" target="_blank">Visiter</a></td>
                <td><?=$ville?></td>
                <td><a href="../controllers/EntrepriseDetail_Controller.php?id=<?=$entreprise['ID_Entreprise']?>"><button>Consulter</button></a></td>
                <td><a href="../controllers/editEntreprise.php?id=<?=$entreprise['ID_Entreprise']?>"><img src="/Xcelstage/public/image/pen.png"></a></td>
                <td><a href="../controllers/deleteEntreprise.php?id=<?php echo $entreprise['ID_Entreprise']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette entreprise ?');"><img src="/Xcelstage/public/image/trash.png"></a></td>
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
            let table = document.getElementById("entrepriseTable");
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
