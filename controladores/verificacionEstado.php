<?php
session_start(); // Esto asegura que se gestiona la sesión del usuario correctamente

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["estado" => "no_autenticado"]);
    exit();
}

// Conexión a la base de datos
include('../conexion/conexionBD.php');

// Consultamos el estado de la cuenta en la base de datos
$idUsuario = $_SESSION['usuario_id']; // Usuario específico
$estadoQuery = "SELECT estadoCuenta FROM usuarios WHERE idUsuario = '$idUsuario'";
$estadoResult = mysqli_query($conexion, $estadoQuery);

if (mysqli_num_rows($estadoResult) > 0) {
    $estadoRow = mysqli_fetch_assoc($estadoResult);
    $estadoCuenta = $estadoRow['estadoCuenta'];

    if ($estadoCuenta == 1) {
        // Cerrar sesión del usuario bloqueado
        session_unset();
        session_destroy();
        echo json_encode(["estado" => "bloqueado"]);
    } else {
        echo json_encode(["estado" => "activo"]);
    }
} else {
    echo json_encode(["estado" => "error"]);
}
