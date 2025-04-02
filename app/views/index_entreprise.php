<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /Xcelstage/public/");
    //echo $_SESSION['Role'];
    exit();

} else {
    $entrepriseModel = new Entreprise($pdo);
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
        <a href="create_entreprise.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>

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
            <tr>
            <?php foreach ($entreprises as $entreprise): ?>
                <td><?=$row['NomE']?></td>
                <td><?=$villeModel->getNomVillebyID($row['ID_SecteurA'])?></td>
                <td><?=$row['Telephone']?></td>
                <td><?=$row['email']?></td>
                <td><a href="<?=$row['site_web']?>" target="_blank">Visiter</a></td>
                <td><?=$villeModel->getNomVillebyID($row['ID_Ville'])?></td>
        <?php endforeach; ?>
        <td><a href="view_entreprise.php?id=<?=$row['id']?>"><button>Consulter</button></a></td>
                <td><a href="edit_entreprise.php?id=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                <td><a href="delete_entreprise.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette entreprise ?');"><img src="images/trash.png"></a></td>
            </tr>
            
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
