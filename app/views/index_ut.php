<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Role.php';
require_once '../models/Utilisateur.php';


if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    header("Location: /Xcelstage/public/");
    //echo $_SESSION['Role'];
    exit();

} else {
    $utilisateurModel = new Utilisateur($pdo);
    $roleModel = new Role($pdo);

    $utilisateurs = $utilisateurModel->getAllUtilisateurs();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <script src="/Xcelstage/public/JS/script_ut.js" defer></script>
</head>
<body>
    <div class="container">
        <a href="create_ut.php" class="Btn_add"> <img src="/Xcelstage/public/image/plus.png"> Ajouter</a>

        <!-- Champ de recherche -->
        <input type="text" id="search" placeholder="Rechercher une utilisateur..." onkeyup="searchTable()">

        <label for="sort">Trier par :</label>
        <select id="sort" onchange="sortTable(this.value)">
            <option value="0">Nom</option>
            <option value="1">Prenom</option>
            <option value="2">Date de naissance</option>
            <option value="3">Email</option>
            <option value="5">Role</option>
        </select>

        <table id="utilisateurTable">
            <tr id="items">
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Role</th>
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <?php $role = $roleModel->getRolebyID($utilisateur['ID_Role']); ?>
                <tr>
                    <td><?=$utilisateur['NomU']?></td>
                    <td><?=$utilisateur['PrenomU']?></td>
                    <td><?=$utilisateur['DateNaissance']?></td>
                    <td><?=$utilisateur['EmailU']?></td>
                    <td><?=$role?></td>
                    <td><a href="../views/consult_ut.php?id=<?=$utilisateur['ID_Utilisateur']?>"><button>Consulter</button></a></td>
                    <td><a href="../controllers/editUt.php?id=<?=$utilisateur['ID_Utilisateur']?>"><img src="/Xcelstage/public/image/pen.png"></a></td>
                    <td><a href="../controllers/deleteUt.php?id=<?php echo $utilisateur['ID_Utilisateur']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');"><img src="/Xcelstage/public/image/trash.png"></a></td>
                </tr>
            <?php endforeach; ?>
        </table>
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
</body>
</html>
