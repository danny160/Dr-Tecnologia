<?php
// Incluyendo la conexión a la base de datos
include('../../conexion/conexionBD.php');

// Establecer la cabecera para respuestas JSON
header('Content-Type: application/json');

// Verifica si se han enviado datos a través del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $rolUsuario = $_POST['rolUsuario'];
    $nombreUsuarioInicio = $_POST['nombreUsuario'];  // Cambié el nombre de la variable
    $contraseña = $_POST['contraseña'];
    $correoElectronico = $_POST['correoElectronico'];
    $estadoCuenta = $_POST['estadoCuenta'];
    $fechaCreacion = $_POST['fechaCreacion'];
    $fechaModificacion = $_POST['fechaCreacion']; // Aquí estás usando la misma fecha
    $cedulaUsuario = $_POST['documento'];  // Cambié el nombre para reflejar la estructura
    $edadUsuario = $_POST['edad'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $nombreUsuario = $_POST['nombre'];  
    $apellidoUsuario = $_POST['apellido'];
    $tipoDocumento = $_POST['tipoDocumento'];

    // Validar si el nombre de usuario ya existe
    $queryCheckName = "SELECT COUNT(*) FROM usuarios WHERE nombreUsuario = ?";
    $stmtCheckName = mysqli_prepare($conexion, $queryCheckName);

    if ($stmtCheckName) {
        mysqli_stmt_bind_param($stmtCheckName, "s", $nombreUsuario);
        mysqli_stmt_execute($stmtCheckName);
        mysqli_stmt_bind_result($stmtCheckName, $count);
        mysqli_stmt_fetch($stmtCheckName);
        mysqli_stmt_close($stmtCheckName);

        // Si el nombre de usuario ya existe
        if ($count > 0) {
            echo json_encode([
                'estado' => 'error',
                'mensaje' => 'El nombre de usuario ya está registrado.'
            ]);
            exit;  // Salir para no continuar con la inserción
        }
    }

    // Si el nombre de usuario no existe, proceder con la inserción
    $query = "INSERT INTO usuarios (rolUsuario, nombreUsuarioInicio, contraseña, correoElectronico, estadoCuenta, fechaCreacion, fechaModificacion, cedulaUsuario, edadUsuario, fechaNacimiento, nombreUsuario, apellidoUsuario, tipoDocumento) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia SQL
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular los parámetros
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssississsss", 
            $rolUsuario, $nombreUsuarioInicio, $contraseña, $correoElectronico, $estadoCuenta, $fechaCreacion, 
            $fechaModificacion, $cedulaUsuario, $edadUsuario, $fechaNacimiento, $nombreUsuario, $apellidoUsuario, 
            $tipoDocumento
        );

        // Ejecutar la sentencia
        if (mysqli_stmt_execute($stmt)) {
            // Si la inserción fue exitosa, devolver un mensaje de éxito
            echo json_encode([
                'estado' => 'exito',
                'mensaje' => '¡Usuario registrado con éxito!'
            ]);
        } else {
            // Si ocurrió un error al ejecutar la consulta
            echo json_encode([
                'estado' => 'error',
                'mensaje' => 'Error al registrar el usuario. Intenta nuevamente.'
            ]);
        }

        // Cerrar la declaración y la conexión
        mysqli_stmt_close($stmt);
    } else {
        // Si hubo un error al preparar la consulta
        echo json_encode([
            'estado' => 'error',
            'mensaje' => 'Error al preparar la consulta. Intenta nuevamente.'
        ]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si no es una solicitud POST
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Método no permitido.'
    ]);
}
