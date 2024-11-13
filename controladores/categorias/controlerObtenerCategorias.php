<?php
include('../../conexion/conexionBD.php');

$query = "SELECT * FROM categoria";
$result = $conexion->query($query);

$categorias = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

echo json_encode($categorias);

$conexion->close();
