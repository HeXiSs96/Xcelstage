<h1>Offres de Stage</h1>

<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <input type="hidden" name="action" value="recherche">
    <input type="text" name="motcle" placeholder="🔍 Mot-clé ou entreprise" value="<?= htmlspecialchars($motcle) ?>">
    <input type="text" name="ville" placeholder="📍 Ville" value="<?= htmlspecialchars($ville) ?>">
    <button type="submit">Rechercher</button>
</form>

<a href="index.php?action=wishlist" style="text-decoration: none; font-size: 18px; background: #f0f0f0; padding: 8px 12px; border-radius: 8px; display: inline-block; color: #800080; margin-right: 10px;">
    ❤️ Voir mes favoris
</a>

<a href="index.php?action=candidatures" style="text-decoration: none; font-size: 18px; background: #f0f0f0; padding: 8px 12px; border-radius: 8px; display: inline-block; color: #800080;">
    📨 Voir mes candidatures
</a>

<br><br>

<?php if (!empty($offres)): ?>
    <?php foreach ($offres as $offre): ?>
        <?php
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Souhaiter WHERE ID_Offre = ? AND ID_Utilisateur = ?");
        $stmt->execute([$offre['ID_Offre'], 1]);
        $inWish = $stmt->fetchColumn() > 0;
        ?>

        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
            <h2><?= htmlspecialchars($offre['TitreO']) ?> - H/F</h2>
            <h3><?= htmlspecialchars($offre['entreprise']) ?></h3>

            <form style="display:inline;">
                <button type="button" class="wishlist-btn" data-id="<?= $offre['ID_Offre'] ?>" style="font-size: 22px; background: none; border: none; cursor: pointer;">
                    <?= $inWish ? '❤️' : '🤍' ?>
                </button>
            </form>

            <p>📍 <?= htmlspecialchars($offre['ville']) ?></p>
            <p>📎 <strong>Compétences :</strong> <?= htmlspecialchars($offre['competences'] ?? '') ?></p>
            <p><?= htmlspecialchars($offre['DescOffre']) ?></p>
            <p>📅 <?= $offre['DateDebut'] ?> → <?= $offre['DateFin'] ?></p>
            <p>💸 <?= $offre['RemunerationO'] ?></p>

            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="postuler">
                <input type="hidden" name="id" value="<?= $offre['ID_Offre'] ?>">
                <button>Postuler</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune offre trouvée pour cette recherche.</p>
<?php endif; ?>

<!-- SCRIPT SIMPLIFIÉ POUR GÉRER LES COEURS -->
<script>
    const boutons = document.querySelectorAll('.wishlist-btn');

    boutons.forEach(function(bouton) {
        bouton.addEventListener('click', function () {
            const id = this.dataset.id;
            const action = this.textContent === '❤️' ? 'remove' : 'add';

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../handlers/wishlist.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id_offre=" + id + "&action=" + action);

            xhr.onload = () => {
                if (xhr.status === 200) {
                    if (xhr.responseText === "added") {
                        this.textContent = "❤️";
                    } else if (xhr.responseText === "removed") {
                        this.textContent = "🤍";
                    }
                }
            };
        });
    });
</script>
