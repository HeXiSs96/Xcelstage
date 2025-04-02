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

    <div class="form">
        <a href="index_ut.php" class="back_btn"><img src="../public/image/arrow.png"> Retour</a>
        <h2>Ajouter un utilisateur</h2>
        <p class="erreur_message">
            <?php if(isset($message)) echo $message; ?>
        </p>
        <form action="../controllers/createUtilisateur.php" method="POST">
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
