document.addEventListener("DOMContentLoaded", function () {
    fetch("check_session.php") // Vérifie la connexion côté serveur
        .then(response => response.json())
        .then(data => {
            const authButton = document.getElementById("authButton");
            if (data.loggedIn) {
                authButton.textContent = "Mon Compte";
                authButton.onclick = () => window.location.href = "mon_compte.php";
            } else {
                authButton.textContent = "Connexion";
                authButton.onclick = () => window.location.href = "login.php";
            }
        })
        .catch(error => console.error("Erreur :", error));
});


