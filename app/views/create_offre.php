<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style_offre.css">
</head>
<body>
    <?php
       if(isset($_POST['button'])){
           extract($_POST);
           
           // Vérifier que tous les champs sont remplis
           if(isset($nom) && isset($prenom) && isset($email) && isset($password) && isset($date_naissance) && isset($role)) {
                include_once "connexion.php";

                // Hachage du mot de passe pour la sécurité
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Date de création automatique
                $date_creation = date("Y-m-d H:i:s");

                // Requête d'ajout
                $req = mysqli_query($con, "INSERT INTO Employe (nom, prenom, email, password, date_naissance, role, date_creation) 
                                           VALUES ('$nom', '$prenom', '$email', '$hashed_password', '$date_naissance', '$role', '$date_creation')");
                
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
        <h2>Ajouter un utilisateur</h2>
        <p class="erreur_message">
            <?php if(isset($message)) echo $message; ?>
        </p>
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" required>
            
            <label>Prénom</label>
            <input type="text" name="prenom" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe</label>
            <input type="password" name="password" required>
            
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" required>
            
            <label>Rôle</label>
            <select name="role" required>
                <option value="Pilote">Pilote</option>
                <option value="Étudiant">Étudiant</option>
            </select>
            
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
