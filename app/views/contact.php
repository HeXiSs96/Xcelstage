<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs soumises par le formulaire
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $message = $_POST['message'];

    // Validation et traitement des données (par exemple, envoi d'email ou stockage en base de données)
    // Ici, on affiche simplement les données pour vérifier
    echo "Prénom: " . htmlspecialchars($prenom) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Téléphone: " . htmlspecialchars($telephone) . "<br>";
    echo "Message: " . nl2br(htmlspecialchars($message)) . "<br>";

    // Ici, tu peux ajouter ton code pour envoyer l'email ou enregistrer dans une base de données si besoin.
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>XcelStage - Contact</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/contact.css" />
    <link rel="icon" type="image/png" href="/Xcelstage/public/image/logo-png.png">
  </head>
  <body>

    <?php include 'header.php'; ?>

    <main>
      <form method="POST" action="">
        <h1>Contactez-nous</h1>
        <div class="separation"></div>
        <div class="corps-formulaire">
          <div class="gauche">
            <div class="groupe">
              <label for="prenom">Votre Prénom</label>
              <input type="text" name="prenom" id="prenom" autocomplete="off" required />
              <i class="fas fa-user"></i>
            </div>
            <div class="groupe">
              <label for="email">Votre adresse e-mail</label>
              <input type="email" name="email" id="email" autocomplete="off" required />
              <i class="fas fa-envelope"></i>
            </div>
            <div class="groupe">
              <label for="telephone">Votre téléphone</label>
              <input type="text" name="telephone" id="telephone" autocomplete="off" required />
              <i class="fas fa-mobile"></i>
            </div>
          </div>

          <div class="droite">
            <div class="groupe">
              <label for="message">Message</label>
              <textarea name="message" id="message" placeholder="Saisissez ici..." required></textarea>
            </div>
          </div>
        </div>

        <div class="pied-formulaire" align="center">
          <button type="submit">Envoyer le message</button>
        </div>
      </form>
    </main>

    <?php include 'footer.php'; ?>

  </body>
</html>

