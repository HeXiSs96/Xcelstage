<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
    <script src="../public/JS/script_ut.js"></script>
</head>
<body>
    <div class="container">
        <a href="create_ut.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
        <label for="sort">Trier par :</label>
        <select id="sort" onchange="sortTable(this.value)">
            <option value="0">Nom</option>
            <option value="1">Prénom</option>
            <option value="4">Rôle</option>
        </select>
        <input type="text" id="searchInput" placeholder="Rechercher..." onkeyup="searchTable()">

        
        <table id="employeeTable">
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php 
                include_once "connexion.php";
                $req = mysqli_query($con , "SELECT * FROM Employe");
                if(mysqli_num_rows($req) == 0){
                    echo "<tr><td colspan='7'>Il n'y a pas encore d'employé ajouté !</td></tr>";
                }else {
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['nom']?></td>
                            <td><?=$row['prenom']?></td>
                            <td><?=$row['age']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['role']?></td>
                            <td><a href="edit_ut.php?id=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                            <td><a href="delete_ut.php?id=<?=$row['id']?>"><img src="images/trash.png"></a></td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
