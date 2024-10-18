
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('burger__menu');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', function() {
        menu.classList.toggle('overlay');
        menuToggle.classList.toggle('active');  // Ajoute/retire la classe 'active'
    });
});
