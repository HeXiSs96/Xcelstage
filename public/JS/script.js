// Fonction pour ouvrir et fermer le menu burger
function toggleMenu() {
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('ul');
    
    burger.classList.toggle('open');
    menu.classList.toggle('open');
}
