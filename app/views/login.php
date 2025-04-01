<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: accueil.php"); // Rediriger si déjà connecté
    exit();
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connexion à la base de données
    $db_host = "localhost";
    $db_user = "root";  // Modifie en fonction de ta configuration
    $db_pass = "";      // Modifie en fonction de ta configuration
    $db_name = "xcelstage"; // Modifie en fonction de ta base de données

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Récupérer les informations du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête SQL pour vérifier l'email et le mot de passe
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['mot_de_passe'])) {
            // Si la connexion est réussie, enregistrer l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            // Rediriger l'utilisateur vers la page d'accueil ou autre
            header("Location: accueil.php");
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Aucun utilisateur trouvé avec cet email.";
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
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
                    <a href="#">Mots de passe / Adresse Email oublié.</a>
                </div>
                <input type="submit" value="Connexion">
            </form>
        </div>
    </div>
</body>
</html>
