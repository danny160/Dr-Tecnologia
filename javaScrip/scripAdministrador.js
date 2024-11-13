document.addEventListener("DOMContentLoaded", function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });

    // Efecto para los divs de opciones
    const opciones = document.querySelectorAll('.div-opciones');
    opciones.forEach((opcion, index) => {
        setTimeout(() => {
            opcion.classList.add('visible'); // Añade la clase visible
        }, index * 200); // Aumenta el retraso para cada div
    });

});
