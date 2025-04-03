<h1>📨 Mes candidatures en cours</h1>
<a href="pageoffre.php?action=recherche">🔙 Retour à la recherche</a>
<br><br>

<?php if (!empty($candidatures)): ?>
    <?php foreach ($candidatures as $c): ?>
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
            <h2><?= htmlspecialchars($c['TitreO']) ?> - H/F</h2>
            <h3><?= htmlspecialchars($c['entreprise']) ?></h3>
            <p><strong>Date de candidature :</strong> <?= date('d/m/Y à H\hi', strtotime($c['Date_Candidature'])) ?></p>
            <p><strong>Statut :</strong> <?= htmlspecialchars($c['statut']) ?></p>
            <p><strong>Lettre de motivation :</strong><br>
            <?php
            $lettre = basename($c['Lettre_Motivation'] ?? '');
            if ($lettre):
            ?>
                <a href="uploads/<?= urlencode($lettre) ?>" target="_blank">📄 Voir la lettre</a>
            <?php else: ?>
                <em>Non fournie</em>
            <?php endif; ?>
            </p>
            <p><?= htmlspecialchars($c['DescOffre']) ?></p>
            <p><strong>Période :</strong> <?= $c['DateDebut'] ?> → <?= $c['DateFin'] ?></p>
            <p><strong>Rémunération :</strong> <?= $c['RemunerationO'] ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Vous n'avez pas encore postulé à une offre.</p>
<?php endif; ?>


