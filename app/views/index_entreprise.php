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
    //echo $_SESSION['Role'];
    exit();

} else {
    $entrepriseModel = new Entreprise($pdo);
    $appartenirModel = new Appartenir($pdo);
    $secteurModel = new SecteurActivite($pdo);
    $implanterModel = new Implanter($pdo);
    $villeModel = new Ville($pdo);

    $entreprises = $entrepriseModel->getAllEntreprises();
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
    <script src="script_entreprise.js" defer></script>
</head>
<body>
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
            <br/>
            <?php foreach ($entreprises as $entreprise): ?>
            <tr>
            
                <?php
                //var_dump($entreprise);
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
</body>
</html>
