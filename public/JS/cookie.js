const cookieBox = document.querySelector(".wrapper"),
  buttons = document.querySelectorAll(".button");

// Fonction pour exécuter les actions liées aux cookies
const executeCodes = () => {
  // Si le cookie contient "codinglab", la fonction retourne et le reste du code ne s'exécute pas
  if (document.cookie.includes("codinglab")) return;
  cookieBox.classList.add("show");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      cookieBox.classList.remove("show");
      // Si le bouton a l'ID acceptBtn
      
    });
  });
};

// Exécution de la fonction au chargement de la page
window.addEventListener("load", executeCodes);

if (button.id == "acceptBtn") {
    //set cookies for 1 month. 60 = 1 min, 60 = 1 hours, 24 = 1 day, 30 = 30 days
    document.cookie = "cookieBy= codinglab; max-age=" + 60 * 60 * 24 * 30;
  }