
// Evento para la barra lateral
document.addEventListener("DOMContentLoaded", async function () {
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });

    // Inicializa la tabla de datos automáticamente
    await inicializarDataTable();
});

//-------------------------------------Tabla de datos------------------------------------------------------

// Para el cargue de la tabla de usuarios
let dataTable;
let dataTableInicializada = false;

const dataTableOptions = {
    lengthMenu: [3, 5, 10, 15, 20, 100, 200, 500],
    columnDefs: [
        { className: "centerend", targets: [0, 1, 2, 3, 4, 5, 6] },
        { orderable: false, targets: [0, 1, 2, 3, 4, 5, 6] }
    ],
    pageLength: 10,
    destroy: true,
    language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "Ningún usuario encontrado",
        info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
        infoEmpty: "Ningún usuario encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        loadingRecords: "Cargando...",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior"
        }
    }
};

// Inicializa la tabla de datos de los usuarios
const inicializarDataTable = async () => {
    // Cargar los datos de la tabla primero
    await datosTabla();

    // Destruye DataTable si ya está inicializado
    if (dataTableInicializada) {
        dataTable.destroy();
    }

    // Inicializa DataTable una vez que los datos estén cargados
    dataTable = $("#dataTableUsuarios").DataTable(dataTableOptions);
    dataTableInicializada = true;
};

// Carga los datos de la tabla
const datosTabla = async () => {
    try {
        const response = await fetch('../controladores/usuarios/listarUsuarios.php'); // Asegúrate de que el endpoint sea correcto
        const data = await response.text();
        document.querySelector('tbody').innerHTML = data;
    } catch (error) {
        console.error('Error al cargar los datos:', error);
        mostrarMensaje('Error al cargar los datos', 'error');
    }
};

//cuando precione añadir usuario cargue las configuraciones del modal
document.getElementById("btnAñadirUsuario").addEventListener("click", function () {
    // Control del tipo de documento
    const tipoDocumentoSelect = document.getElementById('tipoDocumento');
    const documentoInput = document.getElementById('documento');

    // Controla el cambio del tipo de documento
    tipoDocumentoSelect.addEventListener('change', function () {
        const tipo = this.value;
        if (tipo === 'cc' || tipo === 'otro') {
            documentoInput.maxLength = 11;
        } else if (tipo === 'Pasaporte') {
            documentoInput.maxLength = 9;
        }
    });

    // Control de la fecha de nacimiento
    const fechaNacimientoInput = document.getElementById('fechaNacimiento');
    const today = new Date();
    const year = today.getFullYear() - 18; // Año mínimo para ser mayor de edad
    const month = today.getMonth() + 1; // Mes actual
    const day = today.getDate(); // Día actual

    // Establecer el máximo (18 años atrás)
    const maxDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    fechaNacimientoInput.setAttribute('max', maxDate);

    // Establecer fecha actual
    establecerFechaActual();

    // Mostrar/ocultar contraseña
    const togglePasswordButton = document.getElementById('togglePassword');
    const contraseñaInput = document.getElementById('contraseña');
    togglePasswordButton.addEventListener('click', function () {
        contraseñaInput.type = contraseñaInput.type === 'password' ? 'text' : 'password';
    });

    // Generar contraseña aleatoria
    const generatePasswordButton = document.getElementById('generatePassword');
    generatePasswordButton.addEventListener('click', function () {
        const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let contraseñaAleatoria = '';
        for (let i = 0; i < 11; i++) {
            const randomIndex = Math.floor(Math.random() * caracteres.length);
            contraseñaAleatoria += caracteres[randomIndex];
        }
        contraseñaInput.value = contraseñaAleatoria;
    });
});

// Evento cuando se hace clic en el botón de registro
document.getElementById("btnRegistrar").addEventListener("click", function (event) {
    // Evitar el envío del formulario por defecto
    event.preventDefault();

    // Obtener todos los campos del formulario
    const form = document.getElementById("formRegistrarUsuario");
    const inputs = form.querySelectorAll("input, select"); // Incluye todos los campos de entrada y selectores

    // Verificar si todos los campos están llenos
    let camposVacios = false; // Bandera para detectar campos vacíos
    inputs.forEach(input => {
        if (input.value.trim() === "") { // Campo vacío
            camposVacios = true;
        }
    });

    // Si hay campos vacíos, mostrar un mensaje y detener el proceso
    if (camposVacios) {
        mostrarMensaje("Por favor, completa todos los campos del formulario.", "informacion");
        return;
    }

    // Crear el objeto FormData a partir del formulario
    const formData = new FormData(form);

    // Enviar el formulario con fetch
    fetch("../controladores/usuarios/controlerRegistrarUsuario.php", {
        method: "POST",
        body: formData,
    })
        .then(response => response.json()) // Esperar la respuesta en JSON
        .then(result => {
            // Mostrar el mensaje en el modal según el estado
            mostrarMensaje(result.mensaje, result.estado);

            // Si el estado es "exito", recargar la página después de un pequeño retraso
            if (result.estado === "exito") {
                setTimeout(function () {
                    location.reload();  // Recargar la página después de 4 segundos
                }, 4000);  // Espera 4 segundos antes de recargar
            }
        })
        .catch(error => {
            console.error("Error al registrar el usuario", error);
            mostrarMensaje("Error al registrar el usuario. Intenta nuevamente.", "error");
        });
});

//cambiar el esto del usuario
function cambiarEstado(idUsuario, estadoCuenta) {
    // Crear los datos para enviar al servidor
    const formData = new FormData();
    formData.append('idUsuario', idUsuario);
    formData.append('estadoCuenta', estadoCuenta);

    // Hacer la solicitud AJAX al servidor
    fetch('../controladores/usuarios/cambiarEstado.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json()) // Parsear la respuesta como JSON
        .then(data => {
            // Usar la función mostrarMensaje con el mensaje y el tipo
            mostrarMensaje(data.mensaje, data.tipo);
            inicializarDataTable();

        })
        .catch(error => {
            // Mostrar mensaje de error si ocurre algún problema con la solicitud
            mostrarMensaje('Error al cambiar el estado: ' + error, 'error');
        });
}

// Función para abrir el modal edicion y rellenar los datos
function abrirModalEditarUsuario(idUsuario) {
    fetch(`../controladores/usuarios/obtenerUsuario.php?idUsuario=${idUsuario}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            // Rellenar los campos del formulario con los datos del usuario
            document.getElementById('idUsuarioEditar').value = data.idUsuario;
            document.getElementById('tipoDocumentoEditar').value = data.tipoDocumento;
            document.getElementById('documentoUsuarioEditar').value = data.cedulaUsuario;
            document.getElementById('nombreUsuarioEditar').value = data.nombreUsuario;
            document.getElementById('apellidoUsuarioEditar').value = data.apellidoUsuario;
            document.getElementById('edadEditar').value = data.edadUsuario;
            document.getElementById('fechaNacimientoEditar').value = data.fechaNacimiento;
            document.getElementById('nombreUsuarioInicioEditar').value = data.nombreUsuarioInicio;
            document.getElementById('contraseñaEditar').value = data.contraseña;
            document.getElementById('correoElectronicoEditar').value = data.correoElectronico;
            document.getElementById('rolUsuarioEditar').value = data.rolUsuario;
            document.getElementById('estadoCuentaEditar').value = data.estadoCuenta;

            // Mostrar el modal
            const modalEditar = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
            modalEditar.show();
        })
        .catch(error => {
            console.error('Error al obtener los datos del usuario:', error);
        });

    // Control del tipo de documento
    const tipoDocumentoSelect = document.getElementById('tipoDocumentoEditar');
    const documentoInput = document.getElementById('documentoUsuarioEditar');

    // Controla el cambio del tipo de documento
    tipoDocumentoSelect.addEventListener('change', function () {
        const tipo = this.value;
        if (tipo === 'cc' || tipo === 'otro') {
            documentoInput.maxLength = 11;
        } else if (tipo === 'Pasaporte') {
            documentoInput.maxLength = 9;
        }
    });

    // Control de la fecha de nacimiento
    const fechaNacimientoInput = document.getElementById('fechaNacimientoEditar');
    const today = new Date();
    const year = today.getFullYear() - 18; // Año mínimo para ser mayor de edad
    const month = today.getMonth() + 1; // Mes actual
    const day = today.getDate(); // Día actual

    // Establecer el máximo (18 años atrás)
    const maxDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    fechaNacimientoInput.setAttribute('max', maxDate);

    // Mostrar/ocultar contraseña
    const togglePasswordButton = document.getElementById('togglePasswordEditar');
    const contraseñaInput = document.getElementById('contraseñaEditar');
    togglePasswordButton.addEventListener('click', function () {
        contraseñaInput.type = contraseñaInput.type === 'password' ? 'text' : 'password';
    });

    // Generar contraseña aleatoria
    const generatePasswordButton = document.getElementById('generatePasswordEditar');
    generatePasswordButton.addEventListener('click', function () {
        const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
        let contraseñaAleatoria = '';
        for (let i = 0; i < 11; i++) {
            const randomIndex = Math.floor(Math.random() * caracteres.length);
            contraseñaAleatoria += caracteres[randomIndex];
        }
        contraseñaInput.value = contraseñaAleatoria;
    });
}

// Función para actualizar el usuario
document.getElementById('formEditarUsuario').addEventListener('submit', function (event) {
    event.preventDefault(); // Evitar el envío tradicional del formulario

    const form = document.getElementById("formEditarUsuario");
    const formData = new FormData(form); // Recoger los datos del formulario

    // Enviar la solicitud de actualización con Fetch
    fetch('../controladores/usuarios/actualizarUsuario.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())  // Convertir la respuesta en JSON
        .then(data => {
            // Llamar a la función mostrarMensaje con los datos del servidor
            mostrarMensaje(data.mensaje, data.estado);  // 'exito' o 'error'
        })
        .catch(error => {
            console.error('Error al actualizar el usuario:', error);
            mostrarMensaje('Error al actualizar el usuario. Intenta nuevamente.', 'error');
        });
});

// funcion de los mensajes
function mostrarMensaje(mensaje, tipo = 'exito') {
    const modal = new bootstrap.Modal(document.getElementById('mensajeModal'));
    const modalTitle = document.getElementById('mensajeModalLabel');
    const modalBody = document.getElementById('modalBody');
    const modalHeader = document.getElementById('modalHeader');

    // Establecer el mensaje en el cuerpo del modal
    modalBody.innerHTML = mensaje;

    // Cambiar el título y el color de fondo del encabezado según el tipo de mensaje
    if (tipo === 'exito') {
        modalTitle.innerHTML = "Éxito";
        modalHeader.className = "modal-header exito"; // Cambia el color a verde
    } else if (tipo === 'error') {
        modalTitle.innerHTML = "Error";
        modalHeader.className = "modal-header error"; // Cambia el color a rojo
    } else if (tipo === 'informacion') {
        modalTitle.innerHTML = "Información";
        modalHeader.className = "modal-header info"; // Cambia el color a azul
    }

    // Mostrar el modal
    modal.show();

    // Lógica de cierre según el tipo de mensaje
    const btnCerrarModal = document.getElementById('btnCerrarModalMensaje');

    // Si el tipo es "informacion", solo cerrar el modal sin recargar
    if (tipo === 'informacion') {
        btnCerrarModal.onclick = function () {
            modal.hide(); // Solo cerrar el modal
        };

        // Evitar recargar si se hace clic fuera del modal
        window.onclick = function (event) {
            if (event.target === modal._element) {
                modal.hide(); // Solo cerrar el modal
            }
        };

        // Evitar cierre automático después de 4 segundos
        return;
    }

    // Para otros tipos de mensajes (éxito, error)
    btnCerrarModal.onclick = function () {
        modal.hide();
        location.reload(); // Recargar la página
    };

    // Cerrar automáticamente después de 4 segundos y recargar la página
    setTimeout(function () {
        modal.hide();
        location.reload(); // Recargar la página
    }, 4000); // Espera 4 segundos antes de cerrar
}