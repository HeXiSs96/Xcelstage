<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <title>Mes offres en favoris</title>
</head>
<body>

<h1>❤️ Mes offres en favoris</h1>
<a href='pageoffre.php?action=recherche'>🔙 Retour à la recherche</a>
<br><br>

<?php if (!empty($offres)): ?>
    <?php foreach ($offres as $offre): ?>
        <div style='border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;'>
            <h2><?= htmlspecialchars($offre['TitreO']) ?> - H/F</h2>
            <h3><?= htmlspecialchars($offre['entreprise']) ?></h3>
            <p>📍 <?= htmlspecialchars($offre['ville']) ?></p>
            <p>📎 <strong>Compétences :</strong> <?= htmlspecialchars($offre['competences'] ?? '') ?></p>
            <p><?= htmlspecialchars($offre['DescOffre']) ?></p>
            <p>📅 <?= $offre['DateDebut'] ?> → <?= $offre['DateFin'] ?></p>
            <p>💸 <?= $offre['RemunerationO'] ?></p>

            <form>
                <button type='button' class='wishlist-btn' data-id='<?= $offre['ID_Offre'] ?>' style='font-size: 18px; background: none; border: none; cursor: pointer;'>
                    ❌ Retirer des favoris
                </button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune offre dans vos favoris pour l'instant.</p>
<?php endif; ?>

<!-- ✅ SCRIPT SIMPLIFIÉ -->
<script>
    const boutons = document.querySelectorAll('.wishlist-btn');

    boutons.forEach(function(bouton) {
        bouton.addEventListener('click', function () {
            const id = this.dataset.id;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../handlers/wishlist.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id_offre=" + id + "&action=remove");

            xhr.onload = () => {
                if (xhr.status === 200 && xhr.responseText === "removed") {
                    this.closest("div").remove();
                }
            };
        });
    });
</script>

</body>
</html>
