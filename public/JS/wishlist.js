document.addEventListener("DOMContentLoaded", function () {
    const boutons = document.querySelectorAll(".wishlist-btn");

    boutons.forEach(bouton => {
        bouton.addEventListener("click", function () {
            const id = this.dataset.id;

            fetch("../handlers/wishlist.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id_offre=${id}&action=remove`
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "removed") {
                    this.closest(".offre-card").remove();
                }
            })
            .catch(error => console.error("Erreur :", error));
        });
    });
});
