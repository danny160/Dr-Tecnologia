<?php
// Incluyendo la conexión a la base de datos
include('../../conexion/conexionBD.php');

// Verificamos si se ha enviado una solicitud para cambiar el estado de la cuenta
if (isset($_POST['idUsuario']) && isset($_POST['estadoCuenta'])) {
    // Capturamos el ID del usuario y el nuevo estado de la cuenta
    $idUsuario = $_POST['idUsuario'];
    $nuevoEstado = $_POST['estadoCuenta']; // 0 para activar, 1 para bloquear

    // Actualizamos el estado de la cuenta en la base de datos
    $queryActualizar = "UPDATE usuarios SET estadoCuenta = $nuevoEstado WHERE idUsuario = $idUsuario";
    if (mysqli_query($conexion, $queryActualizar)) {
        echo "Estado de la cuenta actualizado correctamente";
    } else {
        echo "Error al actualizar el estado de la cuenta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión y detener el script
    mysqli_close($conexion);
    exit();
}

// Si se envía un ID de usuario, obtenemos sus datos
if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];
    $queryUsuario = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexion, $queryUsuario);
    
    if ($resultado) {
        $usuario = mysqli_fetch_assoc($resultado);
        echo json_encode($usuario);
    } else {
        echo json_encode(['error' => 'Error al obtener los datos del usuario: ' . mysqli_error($conexion)]);
    }
    mysqli_close($conexion);
    exit();
}

// Si se envía un formulario con datos para actualizar un usuario
if (isset($_POST['idUsuario'])) {
    $idUsuario = $_POST['idUsuario'];
    $nombreUsuario = $_POST['nombreUsuarioEditar'];
    $apellidoUsuario = $_POST['apellidoUsuarioEditar'];
    $tipoDocumento = $_POST['tipoDocumentoEditar'];
    $cedulaUsuario = $_POST['documentoUsuarioEditar'];
    $edadUsuario = $_POST['edadEditar'];
    $fechaNacimiento = $_POST['fechaNacimientoEditar'];
    $nombreUsuarioInicio = $_POST['nombreUsuarioInicioEditar'];
    $contraseña = $_POST['contraseñaEditar'];
    $correoElectronico = $_POST['correoElectronicoEditar'];
    $rolUsuario = $_POST['rolUsuarioEditar'];
    $fechaCreacion = $_POST['fechaCreacionEditar'];
    $estadoCuenta = $_POST['estadoCuentaEditar'];

    // Actualizamos el usuario en la base de datos
    $queryActualizar = "UPDATE usuarios SET nombreUsuarioInicio = '$nombreUsuarioInicio', contraseña = '$contraseña',
    correoElectronico = '$correoElectronico', estadoCuenta = '$estadoCuenta', fechaCreacion = '$fechaCreacion',
    cedulaUsuario = '$cedulaUsuario', edadUsuario = '$edadUsuario', fechaNacimiento = '$fechaNacimiento' ,
    nombreUsuario = '$nombreUsuario' , apellidoUsuario = '$apellidoUsuario', tipoDocumento = '$tipoDocumento' WHERE idUsuario = $idUsuario";
    
    if (mysqli_query($conexion, $queryActualizar)) {
        echo "Usuario actualizado correctamente";
    } else {
        echo "Error al actualizar el usuario: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
    exit();
}

// Consulta para obtener los datos de la tabla usuarios
$query = "SELECT idUsuario, cedulaUsuario, nombreUsuario, apellidoUsuario, rolUsuario, estadoCuenta FROM usuarios";
$result = mysqli_query($conexion, $query);

// Verifica si la consulta devolvió resultados
if (mysqli_num_rows($result) > 0) {
    // Inicializa una variable para almacenar las filas de la tabla
    $tablaUsuarios = '';

    // Itera sobre los resultados y genera las filas de la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        $tablaUsuarios .= '<tr>';
        $tablaUsuarios .= '<td class="centerend">' . $row['idUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['cedulaUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['nombreUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['apellidoUsuario'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['rolUsuario'] . '</td>';

        // Agregamos el icono según el estadoCuenta
        if ($row['estadoCuenta'] == 0) {
            // Si el estadoCuenta es 0, muestra el icono de check (activo)
            $tablaUsuarios .= '<td class="centerend"><i class="fa-solid fa-check" style="color: green;"></i></td>';
        } else {
            // Si el estadoCuenta es 1, muestra el icono de usuario bloqueado
            $tablaUsuarios .= '<td class="centerend"><i class="fa-solid fa-user-lock" style="color:red;"></i></td>';
        }

        // Dependiendo del estado de la cuenta, cambiar el color del botón de acción
        if ($row['estadoCuenta'] == 0) {
            // Si el estadoCuenta es 0 (activo), el botón de bloqueo es verde
            $tablaUsuarios .= '<td class="centerend">
                <button class="btn btn-sm btn-primary" onclick="abrirModalEditarUsuario(' . $row['idUsuario'] . ')"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-success" onclick="cambiarEstado(' . $row['idUsuario'] . ', 1)"><i class="fa-solid fa-ban"></i></button>
            </td>';
        } else {
            // Si el estadoCuenta es 1 (bloqueado), el botón de desbloqueo es rojo
            $tablaUsuarios .= '<td class="centerend">
                <button class="btn btn-sm btn-primary" onclick="abrirModalEditarUsuario(' . $row['idUsuario'] . ')"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-danger" onclick="cambiarEstado(' . $row['idUsuario'] . ', 0)"><i class="fa-solid fa-ban"></i></button>
            </td>';
        }

        $tablaUsuarios .= '</tr>';
    }
} else {
    // En caso de que no haya registros en la tabla
    $tablaUsuarios = '<tr><td colspan="6" class="text-center">No hay usuarios registrados</td></tr>';
}

// Cierra la conexión
mysqli_close($conexion);

// Devuelve el contenido para insertarlo en la tabla
echo $tablaUsuarios;
