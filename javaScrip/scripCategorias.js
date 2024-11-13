document.addEventListener("DOMContentLoaded", function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });

    // Cargar categorías dinámicamente
    fetch('../controladores/categorias/controlerObtenerCategorias.php')  // Asegúrate de ajustar el path al archivo
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('categorias-container');
            let rowDiv = null;

            data.forEach((categoria, index) => {
                // Crear un nuevo row cada 4 elementos
                if (index % 4 === 0) {
                    rowDiv = document.createElement('div');
                    rowDiv.classList.add('row');
                    container.appendChild(rowDiv);
                }

                // Crear la estructura del div de cada categoría
                const colDiv = document.createElement('div');
                colDiv.classList.add('col-md-3', 'text-center', 'contenido');

                // Contenedor para la imagen con color de fondo alternado
                const imagenDiv = document.createElement('div');
                imagenDiv.classList.add('imagen');
                const bgColor = index % 2 === 0 ? 'bg-azul1' : 'bg-azul2';
                imagenDiv.classList.add(bgColor);  // Clase de color de fondo

                const img = document.createElement('img');
                img.src = '../imgProducto/' + categoria.imagenCategoria;  // Ajusta el path de las imágenes
                img.alt = categoria.nombreCategoria;
                img.classList.add('categoria-img');

                // Añadir la imagen al div de imagen
                imagenDiv.appendChild(img);

                const nombre = document.createElement('p');
                nombre.textContent = categoria.nombreCategoria;
                nombre.classList.add('categoria-nombre');  // Clase CSS para el estilo de texto

                // Agregar imagenDiv y nombre al div principal de la categoría
                colDiv.appendChild(imagenDiv);
                colDiv.appendChild(nombre);

                // Agregar el div de categoría a la fila actual
                rowDiv.appendChild(colDiv);
            });
        })
        .catch(error => console.error('Error al cargar categorías:', error));
});

