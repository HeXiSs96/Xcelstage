<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="/Xcelstage/public/CSS/entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header>
        <nav class="navbar">
            <ul class="navbar">
                <li>
                    <a href="#">Accueil</a>
                </li>
                <li>
                    <a href="#">Offres</a>
                </li>
                <li class="active">
                    <a href="#">Entreprises</a>
                </li>
                <li>
                    <a href="contact.html">A propos de nous</a>
                </li>
                <li>
                    <a href="connexion.html">Connexion</a>
                </li>
            </ul>
        </nav>

        <ul class = "breadcrumb">
            <li><a href="#">Accueil</a></li>
            <li>Entreprise</li>
        </ul>
    
    <h1 class="main-title">Découvrez les entreprises</h1>
    </header>
    <div class="page content">
    <form action="../controllers/EntrepriseController.php" method="get">
        <div class="searchbar">
            <div class="search-input">
                <i class="fas fa-bars"></i>
                <input type ="text"  name ="name" placeholder="Mots clés ou entreprise" >
                <i class="fas fa-search"></i>
            </div>
        
            <div class="search-input">
                <i class="fas fa-bars"></i>
                <input type ="text"  name ="location"placeholder="Ou?">
                <i class="fas fa-search"></i>
            </div>
            <button type="submit">Rechercher</button>
    </form>
</div>
<div class="grid">
      <?php if(!empty($results)): ?>
        <?php foreach($results as $entreprise):?>
            <a href = "../controllers/EntrepriseDetail_Controller.php?id=<?= $entreprise['ID_Entreprise'] ?>" class="company-card">
                <div class="logo-circle">
                <img src="images/capgemini.png" alt="<?= htmlspecialchars($entreprise['NomE']) ?> Logo">
                </div>
                <p class="company-name"><?=htmlspecialchars($entreprise['NomE']) ?></p>
            </a>
            <?php endforeach;?>
        <?php else: ?>
             <p>Aucune entreprise trouvée.</p>
       <?php endif; ?>
</div>
</body>
</html>