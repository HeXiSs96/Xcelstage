document.addEventListener("DOMContentLoaded", () => {
    const boutons = document.querySelectorAll('.wishlist-btn');

    boutons.forEach(bouton => {
        bouton.addEventListener('click', function () {
            const id = this.dataset.id;
            const action = this.textContent === '❤️' ? 'remove' : 'add';

            fetch("../handlers/wishlist.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id_offre=${id}&action=${action}`
            })
            .then(response => response.text())
            .then(result => {
                if (result === "added") {
                    this.textContent = "❤️";
                } else if (result === "removed") {
                    this.textContent = "🤍";
                }
            })
            .catch(err => console.error("Erreur:", err));
        });
    });
});
