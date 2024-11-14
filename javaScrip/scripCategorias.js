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
        
        // Verificar si no hay categorías
        if (data.length === 0) {
            const noCategoriesMessage = document.createElement('h6');
            noCategoriesMessage.textContent = 'No hay categorías añadidas';
            container.appendChild(noCategoriesMessage);
        } else {
            let rowDiv = null;

            // Cargar categorías
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
                img.src = '../imgCategoria/' + categoria.imagenCategoria;  // Ajusta el path de las imágenes
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
        }
    })
    .catch(error => console.error('Error al cargar categorías:', error));

});

// para guardar la categoria cuando se quiere añadir una nueva
document.getElementById('guardarCategoria').addEventListener('click', function (event) {
    event.preventDefault(); // Prevenir la recarga de la página

    const nombreCategoria = document.getElementById('nombreCategoria').value;
    const descripcionCategoria = document.getElementById('descripcionCategoria').value;
    const imagenCategoria = document.getElementById('imagenCategoria').files[0];

    // Validar que todos los campos estén llenos
    if (nombreCategoria && descripcionCategoria && imagenCategoria) {
        // Validar el tipo de archivo de imagen (solo imágenes permitidas)
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(imagenCategoria.type)) {
            mostrarMensaje('advertencia', "Por favor, selecciona una imagen válida (JPG, PNG, GIF).");
            return;
        }

        // Crear un FormData para enviar los datos al servidor
        const formData = new FormData();
        formData.append('nombreCategoria', nombreCategoria);
        formData.append('descripcionCategoria', descripcionCategoria);
        formData.append('imagenCategoria', imagenCategoria);

        // Enviar los datos al servidor usando Fetch API
        fetch('../controladores/categorias/controlerAñadirCategoria.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensaje('exito', 'Categoría añadida exitosamente!');
                // Limpiar los campos del formulario y mostrar el modal
                document.getElementById('formAñadirCategoria').reset();
                var modal = bootstrap.Modal.getInstance(document.getElementById('modalAñadirCategoria'));
                modal.hide(); // No se cierra inmediatamente, solo cuando termine el timeout
            } else {
                mostrarMensaje('error', 'Error al guardar la categoría: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('error', 'Ocurrió un error al guardar la categoría.');
        });
    } else {
        mostrarMensaje('advertencia', "Por favor, completa todos los campos.");
    }
});

// para buscar la categoria
document.getElementById('buscarCategoria').addEventListener('click', function () {
    const nombreCategoria = document.getElementById('buscarNombreCategoria').value;

    if (nombreCategoria) {
        fetch('../controladores/categorias/controlerBuscarCategoria.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombreCategoria: nombreCategoria })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                
                
                // Cerrar el modal de búsqueda
                var modalBusqueda = bootstrap.Modal.getInstance(document.getElementById('modalBusqueda'));
                modalBusqueda.hide();

                // Llamar la función para cargar el modal de edición con los datos de la categoría encontrada
                cargarModalEdicion(data.categoria);

                // Mostrar el modal de edición
                var modalEdicion = new bootstrap.Modal(document.getElementById('modalEdicion'));
                modalEdicion.show();

            } else {
                // Si no se encuentra, mostrar el mensaje de error
                mostrarMensaje('advertencia', 'Categoría no encontrada');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('error', 'Error al realizar la búsqueda');
        });
    } else {
        mostrarMensaje('advertencia', 'Por favor, ingresa un nombre de categoría');
    }
});

// Evento para guardar cambios en la categoría
document.getElementById('guardarCategoriaEditar').addEventListener('click', function () {
    const idCategoria = document.getElementById('categoriaId').value;
    const nombreCategoria = document.getElementById('nombreCategoriaEditar').value;
    const descripcionCategoria = document.getElementById('descripcionCategoriaEditar').value;
    const imagenCategoria = document.getElementById('imagenCategoriaEditar').files[0];
    const imagenAnterior = document.getElementById('imgVistaPrevia').src.split('/').pop(); // Obtiene el nombre de la imagen actual

    if (nombreCategoria && descripcionCategoria) {
        const formData = new FormData();
        formData.append('idCategoria', idCategoria);
        formData.append('nombreCategoria', nombreCategoria);
        formData.append('descripcionCategoria', descripcionCategoria);
        formData.append('imagenAnterior', imagenAnterior); // Enviar la imagen anterior para eliminarla después

        if (imagenCategoria) {
            formData.append('imagenCategoria', imagenCategoria);
        }

        fetch('../controladores/categorias/controlerEditarCategoria.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensaje('exito', 'Categoría actualizada correctamente');
                var modalEdicion = new bootstrap.Modal(document.getElementById('modalEdicion'));
                modalEdicion.hide();
            } else {
                mostrarMensaje('error', 'Error al actualizar la categoría');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje('error', 'Error al guardar los cambios');
        });
    } else {
        mostrarMensaje('advertencia', 'Por favor, completa todos los campos');
    }
});

// Función para cargar el modal de edición con los datos de la categoría
function cargarModalEdicion(categoria) {
    document.getElementById('categoriaId').value = categoria.idCategoria;
    document.getElementById('nombreCategoriaEditar').value = categoria.nombreCategoria;
    document.getElementById('descripcionCategoriaEditar').value = categoria.descripcionCategoria;

    // Mostrar la imagen actual en el modal de edición
    const vistaPrevia = document.getElementById('imgVistaPrevia');
    vistaPrevia.src = '../imgCategoria/' + categoria.imagenCategoria;
    document.getElementById('imagenCategoriaEditar').value = ""; // Limpiar el campo de imagen para evitar problemas con la validación
}

// para mostrar los mensajes de erro, exito, advertencia
function mostrarMensaje(tipo, mensaje) {
    // Referencias a los elementos dentro del modal
    const modalHeader = document.getElementById('modalHeader');
    const modalBody = document.getElementById('modalBody');
    
    // Cambiar el contenido del modal según el tipo de mensaje
    modalBody.textContent = mensaje;

    // Cambiar los estilos según el tipo de mensaje
    if (tipo === 'exito') {
        modalHeader.classList.remove('bg-danger', 'bg-warning');
        modalHeader.classList.add('bg-success');
        modalHeader.querySelector('h5').textContent = 'Éxito';
    } else if (tipo === 'error') {
        modalHeader.classList.remove('bg-success', 'bg-warning');
        modalHeader.classList.add('bg-danger');
        modalHeader.querySelector('h5').textContent = 'Error';
    } else if (tipo === 'advertencia') {
        modalHeader.classList.remove('bg-success', 'bg-danger');
        modalHeader.classList.add('bg-warning');
        modalHeader.querySelector('h5').textContent = 'Advertencia';
    }

    // Mostrar el modal
    const myModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
    myModal.show();

    // Configurar el cierre automático después de 4 segundos
    const timeout = setTimeout(() => {
        myModal.hide(); // Cierra el modal automáticamente después de 4 segundos
        location.reload(); // Actualiza la página inmediatamente
    }, 4000);

    // Agregar un evento al botón de cerrar
    const closeButton = document.querySelector('.btn-close');
    if (closeButton) {
        closeButton.addEventListener('click', () => {
            clearTimeout(timeout);  // Cancelar el timeout si el usuario cierra manualmente
            myModal.hide();  // Cerrar el modal
            location.reload(); // Actualiza la página inmediatamente
        });
    }
}

