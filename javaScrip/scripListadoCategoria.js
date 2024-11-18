document.addEventListener("DOMContentLoaded", function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });


    // Obtener el parámetro 'id' de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idCategoria = urlParams.get('id');

    if (idCategoria) {

       // Llamar al controlador para obtener los productos de la categoría
       fetch(`../controladores/categorias/controlerObtenerCategoriaURL.php?id=${idCategoria}`)
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               const container = document.querySelector('.derecha');
               document.getElementById('nombreCategoria').textContent = data.categoria.nombreCategoria;
               document.getElementById('cantidadDatos').textContent = data.totalProductos;
   
               container.innerHTML = ''; // Limpia el contenedor
   
               data.productos.forEach(producto => {
                   // Div general del producto
                   const productoDiv = document.createElement('div');
                   productoDiv.classList.add('producto-general');
   
                   // Div para la imagen
                   const imagenDiv = document.createElement('div');
                   imagenDiv.classList.add('producto-imagen');
   
                   const img = document.createElement('img');
                   img.src = '../imgProducto/' + producto.imagenProducto;
                   img.alt = producto.nombreProducto;
                   img.classList.add('producto-img');
   
                   imagenDiv.appendChild(img);
   
                   // Div para la información
                   const infoDiv = document.createElement('div');
                   infoDiv.classList.add('producto-info');
   
                   const nombreProducto = document.createElement('p');
                   nombreProducto.textContent = producto.nombreProducto;
                   nombreProducto.classList.add('producto-nombre');
   
                   const boton = document.createElement('button');
                   boton.textContent = 'Aplicar';
                   boton.classList.add('producto-boton');
   
                   infoDiv.appendChild(nombreProducto);
                   infoDiv.appendChild(boton);
   
                   // Agregar sub-divs al div general
                   productoDiv.appendChild(imagenDiv);
                   productoDiv.appendChild(infoDiv);
   
                   // Agregar el div general al contenedor principal
                   container.appendChild(productoDiv);
               });
           } else {
               const container = document.querySelector('.derecha');
               container.innerHTML = '<p>No se encontraron productos para esta categoría</p>';
           }
       })
       .catch(error => {
           console.error('Error al obtener los productos:', error);
           const container = document.querySelector('.derecha');
           container.innerHTML = '<p>Error al cargar los productos</p>';
       });
   

    } else {
        // Si no se proporciona un ID de categoría, mostrar un mensaje
        const container = document.querySelector('.derecha');
        container.innerHTML = '<p>ID de categoría no proporcionado</p>';
    }
});
