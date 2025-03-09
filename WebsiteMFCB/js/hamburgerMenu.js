// Seleccionar elementos del DOM
const hamburgerMenu = document.getElementById('hamburger-menu');
const navegacion = document.getElementById('navegacion');

// Función para alternar la visibilidad del menú y la animación del ícono
hamburgerMenu.addEventListener('click', () => {
    hamburgerMenu.classList.toggle('active'); // Alternar clase en el ícono
    navegacion.classList.toggle('active');    // Alternar clase en el menú
});

// Cerrar el menú al hacer clic en un enlace
navegacion.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        navegacion.classList.remove('active');
        hamburgerMenu.classList.remove('active'); // También quita la clase del ícono
    });
});