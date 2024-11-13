<?php
// Incluyendo la conexión a la base de datos
include('../conexion/conexionBD.php');

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

    // Validaciones adicionales aquí si es necesario

    // Inserción en la base de datos
    $query = "INSERT INTO usuarios (rolUsuario, nombreUsuarioInicio, contraseña, correoElectronico, estadoCuenta, fechaCreacion, fechaModificacion, cedulaUsuario, edadUsuario, fechaNacimiento, nombreUsuario, apellidoUsuario, tipoDocumento) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia SQL
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ssssississsss", 
        $rolUsuario, $nombreUsuarioInicio, $contraseña, $correoElectronico, $estadoCuenta, $fechaCreacion, 
        $fechaModificacion, $cedulaUsuario, $edadUsuario, $fechaNacimiento, $nombreUsuario, $apellidoUsuario, 
        $tipoDocumento
    );
    
    // Verificación de ejecución
    if (mysqli_stmt_execute($stmt)) {
        // Redirigir con éxito
        header("Location: ../paginas/usuarios.php?estado=exito");
    } else {
        // Redirigir con error
        header("Location: ../paginas/usuarios.php?estado=error");
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}