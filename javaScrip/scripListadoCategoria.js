document.addEventListener("DOMContentLoaded", function () {

    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añadir clase visible
        }, index * 100);
    });

    // Obtener el input de búsqueda y el botón de aplicar
    const busquedaPC = document.querySelector('.busquedaPC');
    const btnAplicar = document.querySelector('.btnAplicar');
    let productosFiltrados = []; // Almacenar los productos filtrados


    // Obtener parámetro 'id' de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idCategoria = urlParams.get('id');

    

    // Obtener productos de la categoría al cargar la página
    if (idCategoria) {
        fetch(`../controladores/categorias/controlerObtenerCategoriaURL.php?id=${idCategoria}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const productos = data.productos;
                    productosFiltrados = productos; // Guardar los productos originales

                    // Actualizar la información de la categoría
                    document.getElementById('nombreCategoria').textContent = data.categoria.nombreCategoria;
                    document.getElementById('cantidadDatos').textContent = data.totalProductos;

                    // Mostrar nombre de la categoría en el filtro
                    document.getElementById('nombreIzquierda').textContent = 'Filtrado de ' + data.categoria.nombreCategoria;

                    // Mostrar productos por defecto
                    actualizarContenidoCategoria(productos);
                    actualizarContenedorDerecha(productos);

                    // Evento para actualizar búsqueda mientras se escribe
                    busquedaPC.addEventListener('input', function () {
                        const query = busquedaPC.value;
                        const productosFiltradosPorBusqueda = filtrarProductos(query, productos);
                        actualizarContenidoCategoria(productosFiltradosPorBusqueda);
                    });

                    // Evento para aplicar los productos filtrados en el contenedor derecho
                    btnAplicar.addEventListener('click', function () {
                        const query = busquedaPC.value;
                        const productosFiltradosPorBusqueda = filtrarProductos(query, productos);
                        actualizarContenedorDerecha(productosFiltradosPorBusqueda);
                    });

                } else {
                    // Si no se encuentran productos, mostrar mensaje
                    const container = document.querySelector('.derecha');
                    container.innerHTML = '<p>No se encontraron productos para esta categoría.</p>';
                }
            })
            .catch(error => {
                console.error('Error al obtener los productos:', error);
                const container = document.querySelector('.derecha');
                container.innerHTML = '<p>Error al cargar los productos.</p>';
            });
    } else {
        const container = document.querySelector('.derecha');
        container.innerHTML = '<p>ID de categoría no proporcionado.</p>';
    }
});

// Función para actualizar el contenido en el div de productos
function actualizarContenidoCategoria(productos) {
    const contenidoCategoria = document.getElementById('contenidoCategoria');
    contenidoCategoria.innerHTML = ''; // Limpiar contenido previo

    if (productos.length === 0) {
        contenidoCategoria.innerHTML = '<p>No se encontraron productos.</p>';
    } else {
        productos.forEach(producto => {
            const nombreProductoDiv = document.createElement('div');
            nombreProductoDiv.classList.add('producto-nombre');
            nombreProductoDiv.textContent = producto.nombreProducto;
            contenidoCategoria.appendChild(nombreProductoDiv);
        });
    }
}

// Función para filtrar productos por búsqueda
function filtrarProductos(query, productos) {
    return productos.filter(producto => 
        producto.nombreProducto.toLowerCase().includes(query.toLowerCase())
    );
}

// Función para actualizar los productos en el contenedor derecho
function actualizarContenedorDerecha(productos) {
    const container = document.querySelector('.derecha');
    container.innerHTML = ''; // Limpiar contenido previo

    if (productos.length === 0) {
        container.innerHTML = '<p>No se encontraron productos.</p>';
    } else {
        productos.forEach(producto => {
            const productoDiv = document.createElement('div');
            productoDiv.classList.add('producto-general');

            const imagenDiv = document.createElement('div');
            imagenDiv.classList.add('producto-imagen');
            const img = document.createElement('img');
            img.src = '../imgProducto/' + producto.imagenProducto;
            img.alt = producto.nombreProducto;
            img.classList.add('producto-img');
            imagenDiv.appendChild(img);

            const infoDiv = document.createElement('div');
            infoDiv.classList.add('producto-info');
            const nombreProducto = document.createElement('p');
            nombreProducto.textContent = producto.nombreProducto;
            nombreProducto.classList.add('producto-nombre');

            const boton = document.createElement('button');
            boton.textContent = 'Aplicar';
            boton.classList.add('producto-boton');
            
            // Asignamos el id del producto al botón con data-id
            boton.setAttribute('data-id', producto.idProducto);

            // Evento click en el botón para mostrar el id del producto en consola
            boton.addEventListener('click', function () {
                // Redirigir a una nueva página con el id del producto como parámetro en la URL
                window.location.href = `../paginas/producto.php?id=${producto.idProducto}`;
            });

            infoDiv.appendChild(nombreProducto);
            infoDiv.appendChild(boton);

            productoDiv.appendChild(imagenDiv);
            productoDiv.appendChild(infoDiv);
            container.appendChild(productoDiv);
        });
    }
}
