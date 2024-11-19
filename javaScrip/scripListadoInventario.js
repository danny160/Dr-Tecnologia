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

    
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    let mensaje = "";
    if (msg === "success") {
        mensaje = "Producto registrado exitosamente.";
    }else if(msg == "succes-Edit"){
        mensaje = "Producto Editado exitosamente";
    }else if (msg === "error_tipo") {
        mensaje = "Error: Solo se permiten archivos en formato PNG, JPG o JPEG.";
    } else if (msg === "error_bd") {
        mensaje = "Error al guardar el producto en la base de datos.";
    } else if (msg === "error_mover") {
        mensaje = "Error al mover la imagen al directorio.";
    } else if (msg === "error_archivo") {
        mensaje = "No se ha seleccionado ninguna imagen o ocurrió un error.";
    }else if(msg=="error_actualización"){
        mensaje="error en actualizar el prodcuto";
    }else if(msg == "solicnot"){
        mensaje = "Solicitud no valida";
    }

    if (mensaje) {
        // Mostrar el mensaje en el modal
        const mensajeModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
        document.getElementById('mensajeModalBody').innerText = mensaje;
        mensajeModal.show();

        // Cerrar el modal y limpiar la URL después de 4 segundos
        setTimeout(function() {
            // Cerrar el modal
            mensajeModal.hide();
            
            // Limpiar el parámetro de la URL (eliminando el 'msg')
            history.pushState({}, "", window.location.pathname);
        }, 4000); // 4 segundos
    }

});


//-------------------------------------Tabla de datos------------------------------------------------------

// Para el cargue de la tabla de productos
let dataTable;
let dataTableInicializada = false;

const dataTableOptions = {
    lengthMenu: [1, 3, 5, 10, 15, 20, 100, 200, 500],
    columnDefs: [
        { className: "centerend", targets: [0, 1, 2, 3, 4, 5, 6] },
        { orderable: false, targets: [0, 1, 2, 3, 4, 5, 6] }
    ],
    pageLength: 8,
    destroy: true,
    searching: true,  // Habilitamos la búsqueda global de DataTables
    info: false,  // Ocultar información de registros mostrados
    dom: "tripl",  // Coloca el selector de longitud de registros al final
    language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "Ningún producto encontrado",
        infoEmpty: "Ningún producto encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        loadingRecords: "Cargando...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
    }
};

// Inicializa la tabla de productos
const inicializarDataTable = async () => {
    await datosTabla();  // Cargar datos

    if (dataTableInicializada) {
        dataTable.destroy();
    }

    // Inicializa DataTable
    dataTable = $("#dataTableProductos").DataTable(dataTableOptions);
    dataTableInicializada = true;
};

// Conexión con el controlador de productos
const datosTabla = async () => {
    try {
        const response = await fetch('../controladores/producto/controlerListadoInventario.php');
        const data = await response.text();
        document.querySelector('tbody').innerHTML = data;
    } catch (error) {
        console.error('Error al cargar los datos:', error);
    }
};

// Filtrar resultados en tiempo real al escribir en el input
$('#productoBuscar').on('keyup', function() {
    // Obtener el valor del input
    const searchTerm = this.value;
    
    // Aplicar el filtro de búsqueda a la tabla
    dataTable.search(searchTerm).draw();
});

// Iniciar eventos
window.addEventListener("load", async () => {
    await inicializarDataTable();
});


// Cargar opciones de categorías cuando el modal se abre
document.getElementById('addProducto').addEventListener('show.bs.modal', function () {
    fetch('../controladores/categorias/obtenerCategoria.php')
        .then(response => response.json())
        .then(data => {
            const selectCategoria = document.getElementById('categoria');
            selectCategoria.innerHTML = '<option value="">Seleccione una categoría</option>'; // Limpia las opciones anteriores
            data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id;
                option.textContent = categoria.nombre;
                selectCategoria.appendChild(option);
            });
        });
});

// Función para obtener y mostrar la fecha actual
function establecerFechaActual() {
    const campoFecha = document.getElementById("fechaIngreso");
    const hoy = new Date();
    
    // Formatear la fecha en formato AAAA-MM-DD
    const año = hoy.getFullYear();
    const mes = String(hoy.getMonth() + 1).padStart(2, '0');
    const dia = String(hoy.getDate()).padStart(2, '0');
    
    // Establecer el valor en el campo
    campoFecha.value = `${año}-${mes}-${dia}`;
}

// Agregar el evento al botón para cargar la fecha al hacer clic
document.getElementById("btn-agregar").addEventListener("click", establecerFechaActual);

// -------------------------------Para la modificacion de producto o eliminar---------------------------------------------------------------------------

// Enviar los datos editados al modal 
document.getElementById('formEditarProducto').addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(document.getElementById('formEditarProducto'));
    formData.append('idProducto', document.getElementById('productoBuscarIdNombre').value);

    try {
        const response = await fetch('../controladores/producto/controlerActualizarProducto.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json(); // El controlador devuelve JSON con éxito o error

        // Mostrar el mensaje en el modal de mensaje
        const mensajeModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
        document.getElementById('mensajeModalBody').innerText = result.message; // Insertar mensaje en el body del modal

        // Si la operación es exitosa, cerrar el modal de edición y mostrar el modal de mensaje
        if (result.success) {
            // Cerrar el modal de edición
            const modalEditarProducto = bootstrap.Modal.getInstance(document.getElementById('modalEditarProducto'));
            modalEditarProducto.hide();

            // Mostrar el modal de mensaje
            mensajeModal.show();

            // Opcional: Recargar la página o realizar alguna otra acción después de 4 segundos
            setTimeout(() => {
                mensajeModal.hide(); // Cerrar el modal de mensaje
                location.reload(); // Recargar la página si la operación fue exitosa
            }, 4000); // 4 segundos de espera para cerrar el modal
        } else {
            // Si la operación fue errónea, solo cerrar el modal de mensaje y mantener el modal de edición abierto
            mensajeModal.show();
        }
    } catch (error) {
        console.error('Error al actualizar el producto:', error);
    }
});


// Variable global para definir la acción (editar o eliminar)
let accionActual = "";

// Configura el botón de "Modificar" para abrir el modal de búsqueda
document.getElementById('btnModificar').addEventListener('click', () => {
    accionActual = "modificar"; // Define la acción como "modificar"
    const modalBuscarProducto = new bootstrap.Modal(document.getElementById('modalBuscarProducto'));
    modalBuscarProducto.show(); // Abre el modal de búsqueda
});

// Configura el botón de "Eliminar" para abrir el modal de búsqueda
document.getElementById('btnEliminarProducto').addEventListener('click', () => {
    accionActual = "eliminar"; // Define la acción como "eliminar"
    const modalBuscarProducto = new bootstrap.Modal(document.getElementById('modalBuscarProducto'));
    modalBuscarProducto.show(); // Abre el modal de búsqueda
});

// Maneja el botón de "Buscar" dentro del modal de búsqueda
document.getElementById('btnBuscarProducto').addEventListener('click', async () => {
    const query = document.getElementById('productoBuscarIdNombre').value;
    if (!query) return;

    try {
        // Realiza la solicitud de búsqueda del producto
        const response = await fetch(`../controladores/producto/controlerObtenerProducto.php?query=${query}`);
        const result = await response.json();

        if (result.success) {
            // Si el producto fue encontrado, cerrar el modal de búsqueda
            const modalBuscarProducto = bootstrap.Modal.getInstance(document.getElementById('modalBuscarProducto'));
            modalBuscarProducto.hide();

            // Acción según la acción actual
            if (accionActual === "modificar") {
                // Poblar el modal de edición con los datos del producto
                document.getElementById('idProductoEditar').value = result.producto.idProducto;
                document.getElementById('nombreProductoEditar').value = result.producto.nombreProducto;
                document.getElementById('descripcionProductoEditar').value = result.producto.descripcionProducto;
                document.getElementById('precioProductoEditar').value = result.producto.precioProducto;
                document.getElementById('cantidadRegistrarEditar').value = result.producto.cantidadRegistrar;
                document.getElementById('fechaIngresoEditar').value = result.producto.fechaIngreso;
                document.getElementById('imagenProductoActual').innerHTML = `<img src="${result.producto.imagenProducto}" alt="Imagen del producto" style="width: 100px;">`;

                // Configura la categoría en el modal de edición
                const categoriaSelect = document.getElementById('categoriaEditar');
                categoriaSelect.innerHTML = '<option value="">Seleccione una categoría</option>';
                const categoriasResponse = await fetch('../controladores/categorias/obtenerCategoria.php');
                const categorias = await categoriasResponse.json();
                categorias.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.id;
                    option.textContent = categoria.nombre;
                    if (categoria.id == result.producto.idCategoria) {
                        option.selected = true;
                    }
                    categoriaSelect.appendChild(option);
                });

                // Mostrar el modal de edición
                const modalEditarProducto = new bootstrap.Modal(document.getElementById('modalEditarProducto'));
                modalEditarProducto.show();

            } else if (accionActual === "eliminar") {
                // Configura y muestra el modal de confirmación de eliminación
                const mensajeModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
                document.getElementById('mensajeModalBody').innerText = `¿Estás seguro de que deseas eliminar el producto "${result.producto.nombreProducto}"?`;
                document.getElementById('mensajeModalFooter').innerHTML = ` 
                    <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                `;
                mensajeModal.show();

                // Configura el botón de confirmación de eliminación
                document.getElementById('confirmarEliminar').addEventListener('click', async () => {
                    try {
                        const idProductoEliminar = result.producto.idProducto;
                        const response = await fetch('../controladores/producto/controlerEliminarProducto.php', {
                            method: 'POST',
                            body: new URLSearchParams({ 'idProducto': idProductoEliminar })
                        });
                        const resultEliminar = await response.json();
                
                        // Mostrar el mensaje en el modal de mensaje
                        const mensajeModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
                        document.getElementById('mensajeModalBody').innerText = resultEliminar.message;
                        
                        // Limpiar los botones (eliminar y cancelar)
                        document.getElementById('mensajeModalFooter').innerHTML = ''; 
                
                        // Mostrar el mensaje de éxito
                        mensajeModal.show();
                
                        // Si la eliminación fue exitosa, recargar la página después de un breve retraso
                        if (resultEliminar.success) {
                            setTimeout(() => {
                                mensajeModal.hide();
                                location.reload(); // Recargar la página si la operación fue exitosa
                            }, 4000); // Esperar 4 segundos antes de recargar
                        } else {
                            // Si la eliminación falló, también eliminar los botones y mostrar el mensaje
                            setTimeout(() => {
                                mensajeModal.hide(); // Cerrar el modal si no fue exitosa
                            }, 4000);
                        }
                
                    } catch (error) {
                        console.error('Error al eliminar el producto:', error);
                    }
                });
                
            }
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error al buscar el producto:', error);
    }
});


// control de transparencia
document.querySelectorAll('.modal').forEach((modal) => {
    // Escucha el cierre de cada modal
    modal.addEventListener('hidden.bs.modal', () => {
        // Comprueba si hay otros modales abiertos
        if (!document.querySelector('.modal.show')) {
            // Elimina el fondo opaco si no hay otros modales abiertos
            document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open'); // Restablece el scroll del cuerpo
            document.body.style.paddingRight = ''; // Elimina cualquier ajuste de padding
        }
    });
});

