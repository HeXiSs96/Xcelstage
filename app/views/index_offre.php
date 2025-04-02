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
                <th>Consulter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php 
                include_once "connexion.php";

                // Vérifier si une recherche a été effectuée
                $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

                // Requête SQL avec recherche si un terme est saisi
                $sql = "SELECT * FROM Offre";
                if (!empty($search)) {
                    $sql .= " WHERE titre LIKE '%$search%' 
                              OR etat LIKE '%$search%' 
                              OR description LIKE '%$search%'";
                }

                $req = mysqli_query($con, $sql);
                if(mysqli_num_rows($req) == 0){
                    echo "<tr><td colspan='10'>Aucune offre trouvée !</td></tr>";
                } else {
                    while($row = mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['titre']?></td>
                            <td><?=$row['date_debut']?></td>
                            <td><?=$row['date_fin']?></td>
                            <td><?=$row['etat']?></td>
                            <td><?=$row['description']?></td>
                            <td><?=$row['remuneration']?> €</td>
                            <td><?=$row['nb_postulants']?></td>
                            <td><a href="view_offre.php?id=<?=$row['id']?>"><img src="images/view.png"></a></td>
                            <td><a href="edit_offre.php?id=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                            <td><a href="delete_offre.php?id=<?=$row['id']?>" onclick="return confirm('Voulez-vous vraiment supprimer cette offre ?');"><img src="images/trash.png"></a></td>
                        </tr>
                        <?php
                    }
                }
            ?>
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
