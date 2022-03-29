//Responsável pela navbar
const toggleButton = document.getElementsByClassName('toggle-button')[0];
const navbarLinks = document.getElementsByClassName('navbar-links')[0];

//Adiciona um evento e quando clicar ativa essa evento 
toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
});