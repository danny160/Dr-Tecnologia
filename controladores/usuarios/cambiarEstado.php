<?php
include('../../conexion/conexionBD.php');

// Validar que existan los parámetros necesarios
if (isset($_POST['idUsuario']) && isset($_POST['estadoCuenta'])) {
    $idUsuario = $_POST['idUsuario'];
    $nuevoEstado = $_POST['estadoCuenta'];

    $queryActualizar = "UPDATE usuarios SET estadoCuenta = $nuevoEstado WHERE idUsuario = $idUsuario";

    if (mysqli_query($conexion, $queryActualizar)) {
        // Respuesta en caso de éxito
        $response = [
            'tipo' => 'exito',
            'mensaje' => 'Estado de la cuenta actualizado correctamente.'
        ];
    } else {
        // Respuesta en caso de error
        $response = [
            'tipo' => 'error',
            'mensaje' => 'Error al actualizar el estado de la cuenta: ' . mysqli_error($conexion)
        ];
    }
    mysqli_close($conexion);
} else {
    // Respuesta si faltan parámetros
    $response = [
        'tipo' => 'informacion',
        'mensaje' => 'No se recibieron los parámetros necesarios.'
    ];
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
