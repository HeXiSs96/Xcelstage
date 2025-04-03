<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: /Xcelstage/public/"); // Rediriger si déjà connecté
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/style_co.css">
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
</head>
<body>
    <div class="container">
        <div class="img">
            <img src="/Xcelstage/public/image/training.png" alt="">
        </div>

        <div class="login">
            <h2 class="title">Connexion</h2>
            <h1>Salut , Amis!</h1>
            <p>Entre tes identifiants personnels et commence ton aventure avec nous.</p>
            
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            
            <form method="POST" action="../controllers/loginController.php">
                <div class="identifiants">
                    <input type="email" name="email" placeholder="Adresse Email" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                <input type="submit" value="Connexion">
            </form>
        </div>
    </div>
</body>
</html>
