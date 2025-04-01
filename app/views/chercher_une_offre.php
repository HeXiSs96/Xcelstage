<?php
// Inclure le header
include('header.php');
?>

<main>
    <div class="search-container">
        <input type="text" id="keywords" placeholder="Mots clés ou entreprise">
        <input type="text" id="location" placeholder="Où?">
        <button onclick="searchJobs()">Rechercher</button>
    </div>

    <section class="job-list">
        <!-- Offre de stage par défaut -->
        <article class="job-offer">
            <h2>Stage - DATA Engineer - H/F</h2>
            <p><strong>Cap Gemini</strong></p>
            <p>📍 PAU - 64000</p>
            <p>Vous serez chargé de développer et maintenir des pipelines de données pour des projets de Big Data.</p>
            <button class="apply-btn">Postuler</button>
        </article>
    </section>
</main>

<?php
// Inclure le footer
include('footer.php');
?>

<script src="RO.js"></script>
</body>
</html>
