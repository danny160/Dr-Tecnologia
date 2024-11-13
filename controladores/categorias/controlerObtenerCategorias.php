<?php
// Incluir el archivo de conexión
include('../conexion/conexionBD.php');

// Consulta para obtener las categorías
$sql = "SELECT idCategoria, nombreCategoria, descripcionCategoria, imagenCategoria FROM categoria";
$result = $conexion->query($sql);

$categorias = [];

if ($result->num_rows > 0) {
    // Guardar cada fila en un array
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

// Convertir los datos a JSON para que puedan ser usados en JavaScript
echo json_encode($categorias);

$conexion->close();