<?php
include('../conexion/conexionBD.php');

// Consulta para obtener las categorías
$queryCategorias = "SELECT idCategoria, nombreCategoria FROM categoria";
$resultCategorias = mysqli_query($conexion, $queryCategorias);

$opcionesCategorias = [];
if (mysqli_num_rows($resultCategorias) > 0) {
    while ($rowCat = mysqli_fetch_assoc($resultCategorias)) {
        $opcionesCategorias[] = [
            'id' => $rowCat['idCategoria'],
            'nombre' => $rowCat['nombreCategoria']
        ];
    }
}

// Cierra la conexión
mysqli_close($conexion);

// Devuelve las categorías en formato JSON
echo json_encode($opcionesCategorias);
