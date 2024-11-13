// Evento para la barra lateral
document.addEventListener("DOMContentLoaded", function () {
    
    // Efecto para los enlaces de la barra lateral
    const links = document.querySelectorAll('.nav-links a');
    links.forEach((link, index) => {
        setTimeout(() => {
            link.classList.add('visible'); // Añade la clase visible
        }, index * 100); // Aumenta el retraso para cada enlace
    });

});

// -----------------------------------------Formulario de registro------------------------------------------
// para validar el formulario de registro
function validarFormulario() {
    const edad = document.getElementById("edad").value;
  
    // Validar la edad
    if (edad < 18 || edad > 100) {
      alert("La edad debe ser mayor o igual a 11 y menor o igual a 100.");
      return false;
    }
  
    // Aquí puedes añadir más validaciones si es necesario
  
    return true; // Permitir el envío del formulario
}

// Funcion para cerrar el modal
function cerrarModal() {
    document.getElementById("miModal").style.display = "none";
}
  
// Solo se ejecuta si el modal existe
var modalElement = document.getElementById('modalMensaje');
if (modalElement) {
    // Función para ocultar el modal después de 3 segundos
    setTimeout(function() {
        var modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
        modalInstance.hide();
        // Redirigir después de cerrar el modal
        window.location.href = '../paginas/usuarios.php';
    }, 3000); // 3000 milisegundos = 3 segundos
}

//-------------------------------------Tabla de datos------------------------------------------------------

// Para el cargue de la tabla de usuarios
let dataTable;
let dataTableInicializada = false;

const dataTableOptions = {
    lengthMenu: [3, 5, 10, 15, 20, 100, 200, 500],
    columnDefs: [
        { className: "centerend", targets: [0, 1, 2, 3, 4, 5, 6] },
        { orderable: false, targets: [0,1,2,3,4,5,6] }
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

//inicia la tabla de datos de los usuarios
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

const datosTabla = async () => {
    try {
        const response = await fetch('../controladores/controlUsuario.php');
        const data = await response.text();
        document.querySelector('tbody').innerHTML = data;
    } catch (error) {
        console.error('Error al cargar los datos:', error);
    }
};

// -----------------------------------------------cambio del estado------------------
function cambiarEstado(idUsuario, nuevoEstado) {
    // Enviamos la solicitud mediante AJAX para cambiar el estado de la cuenta
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controladores/controlUsuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Actualizamos la tabla o recargamos la página tras cambiar el estado
            alert("Estado Actualizado correctamente")
            location.reload(); // Recargar la página para ver los cambios
        }
    };
    xhr.send("idUsuario=" + idUsuario + "&estadoCuenta=" + nuevoEstado);
}

// Función para abrir el modal y cargar los datos del usuario en el modal
function abrirModalEditarUsuario(idUsuario) {
    fetch('../controladores/controlUsuario.php?idUsuario=' + idUsuario)
        .then(response => response.json())
        .then(data => {
            document.getElementById('idUsuarioEditar').value = data.idUsuario;
            document.getElementById('nombreUsuarioEditar').value = data.nombreUsuario;
            document.getElementById('apellidoUsuarioEditar').value = data.apellidoUsuario;
            document.getElementById('tipoDocumentoEditar').value = data.tipoDocumento;
            document.getElementById('documentoUsuarioEditar').value = data.cedulaUsuario;
            document.getElementById('edadEditar').value = data.edadUsuario;
            document.getElementById('fechaNacimientoEditar').value = data.fechaNacimiento;
            document.getElementById('nombreUsuarioInicioEditar').value = data.nombreUsuarioInicio;
            document.getElementById('contraseñaEditar').value = data.contraseña;
            document.getElementById('correoElectronicoEditar').value = data.correoElectronico;
            document.getElementById('rolUsuarioEditar').value = data.rolUsuario;
            document.getElementById('fechaCreacionEditar').value = data.fechaCreacion;
            document.getElementById('estadoCuentaEditar').value = data.estadoCuenta;
            
            var modalEditar = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
            modalEditar.show();
        })
        .catch(error => console.error('Error al cargar los datos del usuario:', error));
}

// Función para guardar los cambios
function guardarEdicionUsuario() {
    const form = document.getElementById('formEditarUsuario');
    const formData = new FormData(form);

    fetch('../controladores/controlUsuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
        location.reload(); // Recargar la página para ver los cambios
    })
    .catch(error => console.error('Error al guardar los cambios:', error));
}

// -------------------------------------------------------------

// Iniciar eventos
window.addEventListener("load", async () => {
    await inicializarDataTable();

});