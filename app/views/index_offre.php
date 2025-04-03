<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Entreprise.php';
require_once '../models/Candidate.php';
require_once '../models/Offre.php';



if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /Xcelstage/public/");
    //echo $_SESSION['Role'];
    exit();

} else {
    $entrepriseModel = new Entreprise($pdo);
    $candidateModel = new Candidate($pdo);
    $offreModel = new Offre($pdo);
    
    $offres = $offreModel->getAllOffres();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Offres</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <script src="script_offre.js" defer></script>
</head>
<body>
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
            <tr id="items">
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
                        $nb_postulant = $entrepriseModel->getNameEntreprisebyID($offre['ID_Entreprise']); 
                        ?>
                            <td><?=$offre['TitreO']?></td>
                            <td><?=$offre['DateDebut']?></td>
                            <td><?=$offre['DateFin']?></td>
                            <td><?=$offre['EtatOffre']?></td>
                            <td><?=$offre['DescOffre']?></td>
                            <td><?=$offre['RemunerationO']?> €</td>
                            <td><?=$nb_postulant?></td>
                            <td><?=$NomE?></td>
                            <td><a href="../controllers/consult_offre.php?id=<?=$offre['ID_Offre']?>"><button>Consulter</button></a></td>
                            <td><a href="create_offre.php?id=<?=$offre['ID_Offre']?>"><img src="/Xcelstage/public/image/pen.png"></a></td>
                            <td><a href="../controllers/deleteOffre.php?id=<?php echo $offre['ID_Offre']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?');"><img src="/Xcelstage/public/image/trash.png"></a></td>
                        </tr>
            <?php endforeach; ?>
        </table>
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
</body>
</html>
