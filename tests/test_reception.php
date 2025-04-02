<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";

if (isset($_FILES['cv']) && $_FILES['cv']['error'] === 0) {
    echo "<p>Fichier bien reçu ✅</p>";
} else {
    echo "<p>⚠️ Aucun fichier reçu</p>";
}
