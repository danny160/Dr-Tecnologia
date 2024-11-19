document.addEventListener("DOMContentLoaded", function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (id) {
        fetch(`../controladores/producto/controlerProductoID.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                console.log("Datos del producto:", data);

                // muestra el contenidro retrocede
                document.getElementById("contenidoRetroceso").innerText = data.nombreCategoria + "/" + data.nombreProducto;

                // Mostrar los datos en los divs
                document.getElementById("descripcionProducto").innerText = data.descripcionProducto;
                document.getElementById("precioProducto").innerText = "Precio: " + data.precioProducto;
                document.getElementById("cantidadProducto").innerText = "Disponibilidad: "+ data.cantidadRegistrar;

                const imagenDiv = document.getElementById("imagenProducto");
                const imgElement = document.createElement("img");
                imgElement.src = `../imgProducto/${data.imagenProducto}`;
                imgElement.alt = "Imagen del producto";
                imagenDiv.appendChild(imgElement);

            })
            .catch(error => {
                console.error("Error al obtener el producto:", error);
            });
    } else {
        console.error("No se proporcionó un ID en el URL.");
    }
});


