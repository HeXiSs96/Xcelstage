<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pdo = new PDO('mysql:host=localhost;dbname=site_stage;charset=utf8', 'root', 'iyas');

// ---------------------------
// 1. Récupérer les données du formulaire
// ---------------------------

$idOffre = $_POST['id_offre'] ?? null;
$lettreFile = $_FILES['lettre_motivation'];
$cheminLettre = '';
$date = date('Y-m-d H:i:s'); // format complet avec heure


if ($lettreFile['error'] === 0) {
    $nomLettre = basename($lettreFile['name']);
    $ext = strtolower(pathinfo($nomLettre, PATHINFO_EXTENSION));
    if ($ext !== 'pdf') {
        die("La lettre doit être au format PDF.");
    }
    $nomUniqueLettre = uniqid() . '-' . $nomLettre;
    $cheminLettre = __DIR__ . '/../public/uploads/' . $nomUniqueLettre;
    if (!move_uploaded_file($lettreFile['tmp_name'], $cheminLettre)) {
        die("Erreur lors de l'envoi de la lettre de motivation.");
    }
} else {
    die("Aucune lettre reçue ou erreur.");
}

$idUser = 1; // temporaire (à remplacer plus tard par $_SESSION['id'])

// ---------------------------
// 2. Gérer le fichier CV
// ---------------------------

$cv = $_FILES['cv'];
$cheminCV = '';

if ($cv['error'] === 0) {
    $nomFichier = basename($cv['name']);
    $extension = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));

    if ($extension !== 'pdf') {
        die("Le CV doit être au format PDF.");
    }

    $nomUnique = uniqid() . '-' . $nomFichier;
    $cheminCVServeur = __DIR__ . '/../public/uploads/' . $nomUnique;
    $cheminCV = 'uploads/' . $nomUnique; // Chemin relatif enregistré en base

    if (!move_uploaded_file($cv['tmp_name'], $cheminCVServeur)) {
        die("Erreur lors de l'envoi du fichier.");
    }
} else {
    die("Aucun fichier envoyé ou erreur.");
}




$check = $pdo->prepare("
    SELECT COUNT(*) FROM Candidate
    WHERE ID_Offre = :offre AND ID_Utilisateur = :user
");
$check->execute([':offre' => $idOffre, ':user' => $idUser]);
$count = $check->fetchColumn();

if ($count > 0) {
    die("⚠️ Vous avez déjà postulé à cette offre.");
}



// ---------------------------
// 3. Insertion dans la base de données
// ---------------------------

$stmt = $pdo->prepare("
    INSERT INTO Candidate (ID_Offre, ID_Utilisateur, CV, Lettre_Motivation, ID_EtatC, Date_Candidature)
    VALUES (:offre, :user, :cv, :lettre, :etat, :date)
");

$stmt->execute([
    ':offre' => $idOffre,
    ':user' => $idUser,
    ':cv' => $cheminCV,
    ':lettre' => $cheminLettre,
    ':etat' => 1,
    ':date' => $date
]);




echo "<h2>🎉 Candidature envoyée avec succès !</h2>";
echo "<a href='../public/index.php?action=recherche'>Retour à la recherche</a>";