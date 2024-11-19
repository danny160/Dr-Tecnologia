<?php
include('../../conexion/conexionBD.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener el producto
    $sqlProducto = "SELECT * FROM productos WHERE idProducto = ?";
    $stmtProducto = $conexion->prepare($sqlProducto);
    $stmtProducto->bind_param("i", $id);
    $stmtProducto->execute();
    $resultadoProducto = $stmtProducto->get_result();

    if ($resultadoProducto->num_rows > 0) {
        $producto = $resultadoProducto->fetch_assoc();
        
        // Obtener el nombre de la categoría usando idCategoria
        $idCategoria = $producto['idCategoria'];
        $sqlCategoria = "SELECT nombreCategoria FROM categoria WHERE idCategoria = ?";
        $stmtCategoria = $conexion->prepare($sqlCategoria);
        $stmtCategoria->bind_param("i", $idCategoria);
        $stmtCategoria->execute();
        $resultadoCategoria = $stmtCategoria->get_result();

        if ($resultadoCategoria->num_rows > 0) {
            $categoria = $resultadoCategoria->fetch_assoc();
            $producto['nombreCategoria'] = $categoria['nombreCategoria'];
        } else {
            $producto['nombreCategoria'] = "Categoría no encontrada";
        }

        echo json_encode($producto); // Enviar los datos del producto con la categoría
    } else {
        echo json_encode(["error" => "Producto no encontrado."]);
    }

    // Cerrar los statements y la conexión
    $stmtProducto->close();
    $stmtCategoria->close();
    $conexion->close();
} else {
    echo json_encode(["error" => "No se proporcionó un ID."]);
}

