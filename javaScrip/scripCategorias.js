document.addEventListener("DOMContentLoaded", function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });
});

function cargarCategorias() {
    fetch('../controladores/categorias/controlerObtenerCategorias.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('categorias-container');
            container.innerHTML = ''; // Limpiar el contenido antes de cargar nuevas categorías

            data.forEach((categoria, index) => {
                const categoriaDiv = document.createElement('div');
                categoriaDiv.classList.add('categoria-card');

                // Agregar contenido de cada categoría
                categoriaDiv.innerHTML = `
                    <div class="categoria-img" style="background-image: url('${categoria.imagenCategoria}')"></div>
                    <h3>${categoria.nombreCategoria}</h3>
                `;

                container.appendChild(categoriaDiv);
            });
        })
        .catch(error => console.error('Error al cargar las categorías:', error));
}

// Llamar a la función para cargar categorías cuando la página se cargue
window.onload = cargarCategorias;