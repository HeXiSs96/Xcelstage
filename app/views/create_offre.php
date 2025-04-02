<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
</head>
<body>
    <?php
       if(isset($_POST['button'])){
           extract($_POST);
           
           // Vérifier que tous les champs sont remplis
           if(isset($nom, $prenom, $email, $password, $date_naissance, $role, $titre, $date_debut, $date_fin, $etat, $description, $remuneration)) {
                include_once "connexion.php";

                // Hachage du mot de passe pour la sécurité
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Date de création automatique
                $date_creation = date("Y-m-d H:i:s");

                // Requête d'ajout
                $req = mysqli_query($con, "INSERT INTO Employe (nom, prenom, email, password, date_naissance, role, titre, date_debut, date_fin, etat, description, remuneration, date_creation) 
                                           VALUES ('$nom', '$prenom', '$email', '$hashed_password', '$date_naissance', '$role', '$titre', '$date_debut', '$date_fin', '$etat', '$description', '$remuneration', '$date_creation')");
                
                if($req){
                    header("location: index_offre.php");
                } else {
                    $message = "Employé non ajouté";
                }
           } else {
               $message = "Veuillez remplir tous les champs !";
           }
       }
    ?>

    <div class="form">
        <a href="index_offre.php" class="back_btn"><img src="images/arrow.png"> Retour</a>
        <h2>Ajouter une offre</h2>
        <p class="erreur_message">
            <?php if(isset($message)) echo $message; ?>
        </p>
        <form action="" method="POST">
            <label>Titre</label>
            <input type="text" name="titre" required>

            <label>Date de début</label>
            <input type="date" name="date_debut" required>

            <label>Date de fin</label>
            <input type="date" name="date_fin" required>

            <label>État</label>
            <select name="etat" required>
                <option value="Ouvert">Ouvert</option>
                <option value="Fermé">Fermé</option>
            </select>

            <label>Description</label>
            <textarea name="description" required></textarea>

            <label>Rémunération</label>
            <input type="number" name="remuneration" step="0.01" required>
            
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
