<?php
include('../../conexion/conexionBD.php');

if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];
    $queryUsuario = "SELECT * FROM usuarios WHERE idUsuario = $idUsuario";
    $resultado = mysqli_query($conexion, $queryUsuario);

    if ($resultado) {
        $usuario = mysqli_fetch_assoc($resultado);
        echo json_encode($usuario);
    } else {
        echo json_encode(['error' => 'Error al obtener los datos del usuario: ']);
    }
    mysqli_close($conexion);
    exit();
}
