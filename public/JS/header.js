document.addEventListener("DOMContentLoaded", function () {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector("nav ul");

    burger.addEventListener("click", function () {
        nav.classList.toggle("active");
    });
});

document.addEventListener("DOMContentLoaded", async () => {
    try {
        let response = await fetch("api/check-login.php");
        let data = await response.json();

        let menu = document.querySelector("#menu"); // Ton menu
        let loginBtn = document.querySelector("#login-btn");

        if (data.logged_in) {
            loginBtn.innerHTML = `<a href="mon-compte.php">${data.username}</a>`;
        }
    } catch (error) {
        console.error("Erreur de connexion :", error);
    }
});
