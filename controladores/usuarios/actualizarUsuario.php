<?php
include('../../conexion/conexionBD.php');

// Verificar si los datos necesarios están disponibles
if (isset($_POST['idUsuario'], $_POST['nombreUsuarioEditar'], $_POST['apellidoUsuarioEditar'], $_POST['tipoDocumentoEditar'], $_POST['documentoUsuarioEditar'], $_POST['edadEditar'], $_POST['fechaNacimientoEditar'], $_POST['nombreUsuarioInicioEditar'], $_POST['contraseñaEditar'], $_POST['correoElectronicoEditar'], $_POST['rolUsuarioEditar'], $_POST['estadoCuentaEditar'])) {
    
    // Sanear los valores para evitar inyección SQL
    $idUsuario = mysqli_real_escape_string($conexion, $_POST['idUsuario']);
    $nombreUsuario = mysqli_real_escape_string($conexion, $_POST['nombreUsuarioEditar']);
    $apellidoUsuario = mysqli_real_escape_string($conexion, $_POST['apellidoUsuarioEditar']);
    $tipoDocumento = mysqli_real_escape_string($conexion, $_POST['tipoDocumentoEditar']);
    $cedulaUsuario = mysqli_real_escape_string($conexion, $_POST['documentoUsuarioEditar']);
    $edadUsuario = mysqli_real_escape_string($conexion, $_POST['edadEditar']);
    $fechaNacimiento = mysqli_real_escape_string($conexion, $_POST['fechaNacimientoEditar']);
    $nombreUsuarioInicio = mysqli_real_escape_string($conexion, $_POST['nombreUsuarioInicioEditar']);
    $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseñaEditar']);
    $correoElectronico = mysqli_real_escape_string($conexion, $_POST['correoElectronicoEditar']);
    $rolUsuario = mysqli_real_escape_string($conexion, $_POST['rolUsuarioEditar']);
    $estadoCuenta = mysqli_real_escape_string($conexion, $_POST['estadoCuentaEditar']);

    // Si la contraseña no está vacía, la hasheamos para seguridad
    if (!empty($contraseña)) {
        $contraseña = password_hash($contraseña, PASSWORD_BCRYPT); // Usamos bcrypt para hash de contraseña
    }

    // Preparar la consulta SQL con parámetros (sentencias preparadas)
    $queryActualizar = "UPDATE usuarios SET nombreUsuarioInicio = ?, contraseña = ?, correoElectronico = ?, estadoCuenta = ?, cedulaUsuario = ?, edadUsuario = ?, fechaNacimiento = ?, nombreUsuario = ?, apellidoUsuario = ?, tipoDocumento = ? WHERE idUsuario = ?";

    // Preparar la sentencia
    if ($stmt = mysqli_prepare($conexion, $queryActualizar)) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, 'ssssssssssi', $nombreUsuarioInicio, $contraseña, $correoElectronico, $estadoCuenta, $cedulaUsuario, $edadUsuario, $fechaNacimiento, $nombreUsuario, $apellidoUsuario, $tipoDocumento, $idUsuario);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['mensaje' => 'Usuario actualizado correctamente', 'estado' => 'exito']);
        } else {
            echo json_encode(['mensaje' => 'Error al actualizar el usuario', 'estado' => 'error']);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['mensaje' => 'Error al preparar la consulta', 'estado' => 'error']);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo json_encode(['mensaje' => 'Datos incompletos o incorrectos', 'estado' => 'error']);
}
