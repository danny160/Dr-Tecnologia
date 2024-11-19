<?php
// Incluyendo la conexión a la base de datos
include('../../conexion/conexionBD.php');

// Consulta para obtener los datos de la tabla productos y el nombre de la categoría
$query = "SELECT p.idProducto, p.nombreProducto, p.descripcionProducto, p.precioProducto, p.cantidadRegistrar,
                 p.idCategoria, p.fechaIngreso, c.nombreCategoria
          FROM productos p
          LEFT JOIN categoria c ON p.idCategoria = c.idCategoria"; // Usamos LEFT JOIN para obtener la categoría

$result = mysqli_query($conexion, $query);

// Verifica si la consulta devolvió resultados
if (mysqli_num_rows($result) > 0) {
    // Inicializa una variable para almacenar las filas de la tabla
    $tablaUsuarios = '';

    // Itera sobre los resultados y genera las filas de la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        $tablaUsuarios .= '<tr>';
        $tablaUsuarios .= '<td class="centerend">' . $row['idProducto'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['nombreProducto'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['descripcionProducto'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['cantidadRegistrar'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['precioProducto'] . '</td>';
        $tablaUsuarios .= '<td class="centerend">' . $row['nombreCategoria'] . '</td>';  // Mostramos el nombre de la categoría
        $tablaUsuarios .= '<td class="centerend">' . $row['fechaIngreso'] . '</td>';
        $tablaUsuarios .= '</tr>';
    }
} else {
    // En caso de que no haya registros en la tabla
    $tablaUsuarios = '<tr><td colspan="6" class="centerend text-center">No hay productos Registrados</td></tr>';
}

// Cierra la conexión
mysqli_close($conexion);

// Devuelve el contenido para insertarlo en la tabla
echo $tablaUsuarios;
