<<<<<<< HEAD
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '/var/www/html/Xcelstage/config/database.php';
require_once '../models/Ville.php';
require_once '../models/SecteurActivite.php';

if ($_SESSION['Role'] != 'Administrateur' && ($_SESSION['Role'] != 'Pilote')) {
    //header("Location: /Xcelstage/public/");
    echo $_SESSION['Role'];
    exit();

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_entreprise = $_POST['nom_entreprise'];
    $adresse = $_POST['adresse'];
    $secteur = $_POST['secteur'];

    $sql = "INSERT INTO entreprises (nom, adresse, secteur) VALUES ('$nom_entreprise', '$adresse', '$secteur')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Entreprise ajoutée avec succès.";
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
} else {
    $villeModel = new Ville($pdo);
    $secteurModel = new SecteurActivite($pdo);

    $villes = $villeModel->getAllVilles();
    $secteurs = $secteurModel->getAllSecteurAs();
}

?>
=======
>>>>>>> 8bdd5e1 (admin dashboard)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une entreprise</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_ut.css">
</head>
<body>
    <?php
       if(isset($_POST['button'])){
           extract($_POST);
           
           // Vérifier que tous les champs sont remplis
           if(isset($nom) && isset($email) && isset($adresse) && isset($telephone) && isset($secteur) && isset($site_web)) {
                include_once "connexion.php";

                // Date de création automatique
                $date_creation = date("Y-m-d H:i:s");

                // Requête d'ajout
                $req = mysqli_query($con, "INSERT INTO Entreprise (nom, email, adresse, telephone, secteur, site_web, date_creation) 
                                           VALUES ('$nom', '$email', '$adresse', '$telephone', '$secteur', '$site_web', '$date_creation')");
                
                if($req){
                    header("location: index_entreprise.php");
                } else {
                    $message = "Entreprise non ajoutée";
                }
           } else {
               $message = "Veuillez remplir tous les champs !";
           }
       }
    ?>

    <div class="form">
        <a href="index_entreprise.php" class="back_btn"><img src="images/arrow.png"> Retour</a>
        <h2>Ajouter une entreprise</h2>
        <p class="erreur_message">
            <?php if(isset($message)) echo $message; ?>
        </p>
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Adresse</label>
            <input type="text" name="adresse" required>
            
            <label>Téléphone</label>
            <input type="tel" name="telephone" required>
            
            <label>Secteur d'activité</label>
            <input type="text" name="secteur" required>
            
            <label>Site Web</label>
            <input type="url" name="site_web" required>
            
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>